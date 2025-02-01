<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJMEDIA.CA - Cybersecurity & App Development</title>
    
    <link rel="stylesheet" href="https://ejmedia.ca/styles.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    
    <script>
        function updatePageTitle(newTitle) {
            document.title = newTitle + " - EJMEDIA.CA";
        }

        // Function to close the banner
        function closeBanner() {
            document.getElementById('update-banner').style.display = 'none';
        }

        const asciiArt = `
░█▀▀░▀▀█░█▄█░█▀▀░█▀▄░▀█▀░█▀█░░░░█▀▀░█▀█
░█▀▀░░░█░█░█░█▀▀░█░█░░█░░█▀█░░░░█░░░█▀█
░▀▀▀░▀▀░░▀░▀░▀▀▀░▀▀░░▀▀▀░▀░▀░▀░░▀▀▀░▀░▀
(C) 2025 ernie@erniejohnson.ca`;

        console.log(`%c${asciiArt}`, 'color: teal; font-family: monospace; font-size: 16px;');
    </script>

</head>
<body>

    <div id="update-banner">
        We're updating our website for a consistent experience across all pages and tools. Please bear with us.
        <button id="close-banner" onclick="closeBanner()">X</button>
    </div>

    <div class="main-container">
