#!/usr/bin/env python3

import cgi
import cgitb
import json
import requests
import os



print("Content-Type: application/json\n")

# Enable CGI error reporting
cgitb.enable()

# Get API key (use an environment variable for security)
API_KEY = os.getenv("NEWSDATA_API_KEY", "YOUR_KEY_HERE")

def get_query_param(param_name):
    """Extracts query parameters from the URL."""
    form = cgi.FieldStorage()
    return form.getvalue(param_name, "").strip()

def search_news(keyword, category="technology", language="en"):
    """
    Searches NewsData.io API for a keyword and returns relevant articles.
    """
    url = f"https://newsdata.io/api/1/news?apikey={API_KEY}&q={keyword}&language={language}&category={category}"

    try:
        response = requests.get(url)
        data = response.json()

        if data.get("status") != "success":
            return {"error": "Failed to fetch news", "details": data}

        articles = [
            {
                "headline": article.get("title", "No Title"),
                "description": article.get("description", "No Description"),
                "url": article.get("link", "#"),
            }
            for article in data.get("results", [])
        ]

        return {"keyword": keyword, "articles": articles}
    
    except requests.exceptions.RequestException as e:
        return {"error": "Request to news API failed", "details": str(e)}

def main():
    # CGI response headers
    print("Content-Type: application/json")
    print()

    # Get the keyword from the request
    keyword = get_query_param("keyword")
    
    if not keyword:
        print(json.dumps({"error": "Missing required parameter: keyword"}))
        return

    # Fetch news articles
    response_data = search_news(keyword)

    # Print JSON response
    print(json.dumps(response_data, indent=2))

if __name__ == "__main__":
    main()
