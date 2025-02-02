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

# NEWS API configuration
API_KEY = os.getenv("NEWSDATA_API_KEY", "YOUR_KEY_HERE")

# AI API Configuration
AI_API_URL = "https://api.openai.com/v1/chat/completions"
AI_API_KEY = os.getenv("AI_API_KEY", "YOUR_AI_KEY_HERE")

CACHE_FILE = "./news_cache.json"  # Adjust path as needed
CACHE_EXPIRY = 12 * 60 * 60  # 12 hours in seconds

DEBUG_LOG_FILE = "./debug.log"  # Adjust this path if needed

def log_debug(message):
    """Appends debug messages to a log file without breaking JSON output."""
    with open(DEBUG_LOG_FILE, "a", encoding="utf-8") as log:
        log.write(f"{datetime.datetime.now()} - {message}\n")

def generate_impact_analysis(headline, description):
    """Fetches two AI impact analyses separately: one for SMBs, one for cybersecurity professionals."""

    if not description.strip():
        return "", ""  # ✅ Skip AI if no valid description

    # Combine headline + description for better AI context
    article_text = f"Headline: {headline}\n\nDescription: {description}"

    def fetch_ai_response(prompt):
        """Helper function to make an OpenAI request for a single prompt."""
        payload = {
            "model": "gpt-4",
            "messages": [
                {"role": "system", "content": "You are an AI assistant analyzing news articles."},
                {"role": "user", "content": prompt}
            ],
            "temperature": 0.7
        }

        headers = {
            "Authorization": f"Bearer {AI_API_KEY}",
            "Content-Type": "application/json"
        }

        try:
            response = requests.post(AI_API_URL, json=payload, headers=headers)
            ai_data = response.json()

            # ✅ Log the AI response
            log_debug(f"AI API Response: {ai_data}")

            # Extract response text
            return ai_data.get("choices", [{}])[0].get("message", {}).get("content", "").strip()

        except requests.exceptions.RequestException as e:
            log_debug(f"⚠️ OpenAI API request failed: {e}")  # ✅ Log failure but continue
            return ""

    # ✅ Call OpenAI twice: once for SMBs, once for cybersecurity professionals
    impact_smb = fetch_ai_response(f"How does this news impact small/medium businesses and the general population?\n{article_text}")
    impact_cyber = fetch_ai_response(f"How does this news impact cybersecurity professionals?\n{article_text}")

    return impact_smb, impact_cyber


import time

import time

def load_cache(article_id=None):
    """Loads cached news data, updates missing AI summaries, and ensures everything is saved properly.
       If AI processing fails or times out, it will return the cached data instead of stopping execution.
    """
    if os.path.exists(CACHE_FILE):
        try:
            with open(CACHE_FILE, "r", encoding="utf-8") as f:
                cache_data = json.load(f)
                articles = cache_data.get("data", [])

                log_debug(f"🔍 Loaded {len(articles)} articles from cache.")  # ✅ Log total articles
                needs_update = False
                processed_articles = set()  # ✅ Track which articles are processed to prevent loops

                start_time = time.time()  # ✅ Track script runtime to detect timeouts

                for idx, article in enumerate(articles):
                    if time.time() - start_time > 300:  # ✅ If script runs for 5+ minutes, return cached data
                        log_debug(f"⏳ WARNING: Script running too long, returning cached data instead of continuing.")
                        return articles  # ✅ Return cached data instead of stopping execution

                    log_debug(f"🔎 Processing article {idx+1}/{len(articles)} - ID: {article.get('article_id', 'UNKNOWN')}")  

                    # ✅ Prevent duplicate processing of the same article
                    if article["article_id"] in processed_articles:
                        log_debug(f"⚠️ SKIPPING DUPLICATE: Article {article['article_id']} is being reprocessed.")
                        continue
                    processed_articles.add(article["article_id"])

                    if article_id and article["article_id"] == article_id:
                        log_debug(f"✅ Returning single article {article_id}")
                        return article  # ✅ Return single article immediately

                    impact_smb = article.get("impact_smb", "").strip()
                    impact_cyber = article.get("impact_cyber", "").strip()
                    description = (article.get("description") or "").strip()

                    if description and (not impact_smb or not impact_cyber):
                        headline = article.get("headline", "No Title")

                        try:
                            log_debug(f"📡 Sending AI request for article {article['article_id']}.")
                            impact_smb, impact_cyber = generate_impact_analysis(headline, description)
                            log_debug(f"✅ AI Summary received for article {article['article_id']}.")

                            # ✅ Save AI response immediately
                            article["impact_smb"] = impact_smb
                            article["impact_cyber"] = impact_cyber

                            log_debug(f"🚀 Saving news_cache.json after updating article {article['article_id']}...")
                            with open(CACHE_FILE, "w", encoding="utf-8") as f:
                                json.dump({"timestamp": cache_data.get("timestamp", time.time()), "data": articles}, f, indent=2)
                            log_debug(f"✅ Successfully saved news_cache.json!")

                        except Exception as e:
                            log_debug(f"❌ ERROR: Failed to get AI summary for article {article['article_id']}: {e}")
                            return articles  # ✅ Return cached data even if AI request fails

                log_debug(f"🏁 Completed processing all articles.")
                return articles  # ✅ Always return cached data, even if AI updates fail

        except (json.JSONDecodeError, IOError) as e:
            log_debug(f"⚠️ JSON Error: {e}")
            return []  # ✅ If cache file is corrupted, return an empty list instead of crashing

    return []









def save_cache(new_articles):
    """Saves new articles to cache while preserving retrieval dates, ensuring newest articles appear first."""
    
    if not os.path.exists(CACHE_FILE):  # Create cache if missing
        with open(CACHE_FILE, "w", encoding="utf-8") as f:
            json.dump({"timestamp": 0, "data": []}, f, indent=2)

    existing_articles = load_cache()

    # Get today's date for grouping
    today = datetime.datetime.now().strftime("%Y-%m-%d")

    # Separate existing articles into today's and older ones
    today_articles = [a for a in existing_articles if a["retrieved_date"].startswith(today)]
    old_articles = [a for a in existing_articles if not a["retrieved_date"].startswith(today)]

    # Prevent duplicates (check by article ID)
    existing_article_ids = {article["article_id"] for article in today_articles}
    new_unique_articles = [a for a in new_articles if a["article_id"] not in existing_article_ids]

    # Prepend today's new articles to existing ones
    updated_today_articles = new_unique_articles + today_articles

    # Combine today's updated articles with older ones
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
    # 🚨 SECURITY CHECK: Only allow 'cybersecurity' as the keyword
    if keyword.lower() != "cybersecurity":
        # print("⚠️ WARNING: Invalid keyword attempt detected. Returning cached data.")  # Log the attempt
        return load_cache()  # ✅ Return cached data instead of making an API call
    
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
                "article_id": article.get("article_id", ""),  # Unique identifier
                "headline": article.get("title", "No Title"),
                "description": article.get("description", "No Description"),
                "url": article.get("link", "#"),
                "keywords": article.get("keywords", []),  # List of keywords
                "source_name": article.get("source_id", ""),  # Source name
                "source_url": article.get("source_url", ""),  # Source URL
                "source_icon": article.get("source_icon", ""),  # Source logo/icon
                "image_url": article.get("image_url", ""),  # Article image
                "retrieved_date": current_date,  # Timestamp for sorting
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
    keyword = get_query_param("keyword").strip().lower()
    article_id = get_query_param("article_id").strip()
    
    # ✅ If an `article_id` is provided, return only that specific article
    if article_id:
        result = load_cache(article_id=article_id)
        print(json.dumps(result, indent=2))
        return

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
