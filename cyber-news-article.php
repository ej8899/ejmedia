<?php include "./header.php"; ?>

<?php
// Get article ID from URL parameter
$article_id = isset($_GET['article_id']) ? $_GET['article_id'] : '';

if (!empty($article_id)) {
    // API URL to fetch article data
    $api_url = "https://ejmedia.ca/cgi-bin/get-news.py?article_id=" . urlencode($article_id);

    // Fetch and decode JSON response
    $response = file_get_contents($api_url);
    $article_data = json_decode($response, true);

    if ($article_data && isset($article_data['headline'])) {
        $headline = htmlspecialchars($article_data['headline']);
        $description = htmlspecialchars($article_data['description']);
        $image_url = htmlspecialchars($article_data['image_url']);
        $source_name = htmlspecialchars($article_data['source_name']);
        $source_icon = htmlspecialchars($article_data['source_icon']);
        $source_url = htmlspecialchars($article_data['source_url']);
        $retrieved_date = htmlspecialchars($article_data['retrieved_date']);
        $impact_smb = nl2br(htmlspecialchars($article_data['impact_smb'] ?? ''));
        $impact_cyber = nl2br(htmlspecialchars($article_data['impact_cyber'] ?? ''));
        $keywords = $article_data['keywords'] ?? [];
    } else {
        $headline = "Article Not Found";
        $description = "The requested article could not be found. It may have been removed or the article ID is incorrect.";
        $image_url = "";
        $source_name = "";
        $source_icon = "";
        $source_url = "";
        $retrieved_date = "";
        $impact_smb = "";
        $impact_cyber = "";
        $keywords = [];
    }
} else {
    $headline = "No Article Selected";
    $description = "Please provide a valid article ID in the URL.";
    $image_url = "";
    $source_name = "";
    $source_icon = "";
    $source_url = "";
    $retrieved_date = "";
    $impact_smb = "";
    $impact_cyber = "";
    $keywords = [];
}

$clean_keywords = [];
if (!empty($keywords)) {
    foreach ($keywords as $keyword) {
        // Trim spaces and remove leading slash if present
        $cleaned = ltrim(trim($keyword), '/');
        if (!in_array($cleaned, $clean_keywords)) {
            $clean_keywords[] = $cleaned;
        }
    }
}


// Function to check if an image URL is valid and accessible
function is_valid_image($url) {
    $headers = @get_headers($url);
    return ($headers && strpos($headers[0], '200') !== false);
}


?>

<script>
  updatePageTitle("<?php echo addslashes($headline); ?>");
</script>

<style>
  .article-container {
    max-width: 800px;
    margin: auto;
    padding: 20px;
    font-family: Arial, sans-serif;
    margin-top: 4rem;
  }
  .article-header {
    display: flex;
    align-items: center;
  }
  .article-header img {
    width: 32px;
    height: 32px;
    margin-right: 10px;
    border-radius: 50%;
  }
  .article-image {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
    border-radius: 10px;
    margin: 15px 0;
  }
  .article-meta {
    font-size: 0.9em;
    color: #666;
  }
  .impact-section {
    margin-top: 20px;
    padding: 15px;
    background-color:var(--nord3);
    border-radius: 5px;
  }
  .impact-section h3 {
    margin-top: 0;
  }
  .keyword-container {
    margin-top: 10px;
  }
  .keyword-pill {
    display: inline-block;
    background-color:var(--nord10);
    color: white;
    padding: 5px 10px;
    margin: 5px 5px 0 0;
    border-radius: 15px;
    font-size: 0.9em;
  }
  .article-container h3 {
    color: var(--nord7);
    margin-bottom: 0px;
  }
  .ai-disclaimer {
    background-color: var(--nord1);
    color: var(--nord4);
    font-size: 0.75em;
    padding: 8px;
    border-left: 4px solid var(--nord10);
    margin-bottom: 10px;
    border-radius: 4px;
}

</style>


<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
  <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
      <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
          <header class="mb-4 lg:mb-6 not-format">
              <div><a href="https://ejmedia.ca/cyber-news.html"><i class="fa-solid fa-arrow-left"></i> Back to News Feed</a></div>
              <address class="flex items-center mb-6 mt-4 not-italic">
                  <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                      <div>
                           <?php if ($source_url): ?>
                            <a href="<?php echo $source_url; ?>" target="_blank">
                              source: <?php echo $source_name; ?>
                            </a>
                          <?php endif; ?>
                          <p class="text-base text-gray-500 dark:text-gray-400">
                              Retrieved on: <?php echo $retrieved_date; ?>
                          </p>
                      </div>
                  </div>
              </address>
              <?php if (!empty($clean_keywords)): ?>
                  <div class="keyword-container">
                    <strong>Keywords:</strong>
                    <?php foreach ($clean_keywords as $keyword): ?>
                      <span class="bg-primary-100 text-primary-800 text-sm font-medium mr-3 px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800 mb-3"><?php echo htmlspecialchars($keyword); ?></span>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white"><?php echo $headline; ?></h1>
          </header>
          <?php if (!empty($image_url) && is_valid_image($image_url)): ?>
                <figure><img src="<?php echo $image_url; ?>" alt="Article Image" class="article-image" /></figure>
            <?php endif; ?>
            
                

    <p class="mb-4"><?php echo $description; ?></p>
    <?php if (!empty($article_data['url'])): ?>
      <p><a href="<?php echo htmlspecialchars($article_data['url']); ?>" target="_blank">Read full article here...</a></p>
    <?php endif; ?>



    <?php if (!empty($impact_smb)): ?>
      <div class="impact-section">
        <div class="ai-disclaimer">
          This summary is AI-generated.<br>While we strive for accuracy, please verify critical details independently.
        </div>
        <h3>Impact on Small/Medium Businesses</h3>
        <hr>
        <p><?php echo $impact_smb; ?></p>
      </div>
    <?php endif; ?>

    <?php if (!empty($impact_cyber)): ?>
      <div class="impact-section">
        <div class="ai-disclaimer">
          This summary is AI-generated.<br>While we strive for accuracy, please verify critical details independently.
        </div>
        <h3> Impacts for Cybersecurity Specialists</h3>
        <hr>
        <p><?php echo $impact_cyber; ?></p>
      </div>
    <?php endif; ?>
</div>
            
        </article>
    </div>
</main>
     
          
          



    
    
    


<?php include "./footer.php"; ?>
