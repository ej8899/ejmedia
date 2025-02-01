#!/usr/bin/env python3

import cgi
import cgitb
import json
import requests
import os
import time
import datetime

# Enable CGI error reporting
cgitb.enable()

# Get API key from environment variable
API_KEY = os.getenv("NEWSDATA_API_KEY", "YOUR_KEY_HERE")

CACHE_FILE = "./news_cache.json"  # Adjust path as needed
CACHE_EXPIRY = 12 * 60 * 60  # 12 hours in seconds

def load_cache():
    """Loads cached data if it exists and is fresh."""
    if os.path.exists(CACHE_FILE):
        try:
            with open(CACHE_FILE, "r", encoding="utf-8") as f:
                cache_data = json.load(f)
                if time.time() - cache_data.get("timestamp", 0) < CACHE_EXPIRY:
                    return cache_data["data"]  # ✅ Return only cached articles
        except (json.JSONDecodeError, IOError):
            pass  # Ignore corrupt cache
    return []  # ❌ Cache is missing or expired

def save_cache(new_articles):
    """Saves new articles to cache while preserving retrieval dates."""
    if not os.path.exists(CACHE_FILE):
        with open(CACHE_FILE, "w", encoding="utf-8") as f:
            json.dump({"timestamp": 0, "data": []}, f, indent=2)

    existing_articles = load_cache()
    
    # Get today's date to ensure new articles are grouped correctly
    today = datetime.datetime.now().strftime("%Y-%m-%d")

    # Separate existing articles into two groups: today's articles & older ones
    today_articles = [a for a in existing_articles if a["retrieved_date"].startswith(today)]
    old_articles = [a for a in existing_articles if not a["retrieved_date"].startswith(today)]

    # Prevent duplicates (check by URL)
    existing_urls = {article["url"] for article in today_articles}
    new_unique_articles = [a for a in new_articles if a["url"] not in existing_urls]

    # Prepend today's new articles to the existing ones for today
    updated_today_articles = new_unique_articles + today_articles

    # Combine today's updated articles with older articles
    updated_articles = updated_today_articles + old_articles

    # Save merged cache with timestamp
    cache_data = {"timestamp": time.time(), "data": updated_articles}
    with open(CACHE_FILE, "w", encoding="utf-8") as f:
        json.dump(cache_data, f, indent=2)


def get_query_param(param_name):
    """Extracts query parameters from the URL."""
    form = cgi.FieldStorage()
    return form.getvalue(param_name, "").strip()

import datetime

def fetch_news(keyword, category="technology", language="en"):
    """Fetches fresh news data for the given keyword."""
    url = f"https://newsdata.io/api/1/news?apikey={API_KEY}&q={keyword}&language={language}&category={category}"

    try:
        response = requests.get(url)
        data = response.json()

        if data.get("status") != "success":
            return {"error": "Failed to fetch news", "details": data}

        current_date = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")  # Store the retrieval date

        articles = [
            {
                "headline": article.get("title", "No Title"),
                "description": article.get("description", "No Description"),
                "url": article.get("link", "#"),
                "retrieved_date": current_date,  # ✅ Add date
            }
            for article in data.get("results", [])
        ]

        save_cache(articles)  # ✅ Merge with existing cache instead of overwriting
        return articles

    except requests.exceptions.RequestException as e:
        return {"error": "Request to news API failed", "details": str(e)}


def main():
    """Handles CGI request and returns cached or fresh news."""
    print("Content-Type: application/json")
    print()

    # Get the keyword from the request
    keyword = get_query_param("keyword")

    if not keyword:
        print(json.dumps({"error": "Missing required parameter: keyword"}))
        return

    # Load cache
    cache = load_cache()

    if cache:
        print(json.dumps({"status": "Using cached data", "articles": cache}, indent=2))
        return

    # If cache is expired, fetch fresh data
    fresh_data = fetch_news(keyword)
    print(json.dumps({"status": "Fetched fresh data", "articles": fresh_data}, indent=2))

if __name__ == "__main__":
    main()
