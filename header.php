<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJMEDIA.CA - Cybersecurity & App Development</title>
    
    <link rel="stylesheet" href="https://ejmedia.ca/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    
    <script>
    
        function toggleMenu() {
            document.getElementById('nav-links').classList.toggle('active');
        }
        
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
    
    <style>
     .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
   
            padding: 0.2rem;
            box-sizing: border-box;
            padding-left: 50px;
            padding-right: 50px;
            position: fixed; width: 100%;
            top: 0;
            background-color: rgb(36,41,51);
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .logo {
            
            
        }
        .logo-image {
            width: 200px;
        }
        .nav-links {
            display: flex;
            gap: 15px;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .nav-links li {
            display: inline;
        }
        .nav-links a {
            text-decoration: none;
        }
        @media (min-width: 768px) {
            .menu-toggle {
                display: none;
            }
            .nav-links {
                justify-content: flex-end;
            }
        }
    </style>

</head>
<body>

    <div id="update-banner">
        We're updating our website for a consistent experience across all pages and tools. Please bear with us.
        <button id="close-banner" onclick="closeBanner()">X</button>
    </div>
    
     <header>
        <nav class="navbar">
            <div class="logo"><img src="/graphics/logo-ejmedia.webp" alt="EJMEDIA.CA" class="logo-image"></div>
            <button class="menu-toggle" onclick="toggleMenu()">&#9776;</button>
            <ul id="nav-links" class="nav-links">
                <li><i class="fas fa-home"></i> <a href="/">Home</a></li>
                <li><i class="fas fa-blog"></i> <a href="/blog-main.html">Blog</a></li>
                <li><i class="fas fa-wrench"></i> <a href="/tools.html">Tools</a></li>
                <li><i class="fas fa-info-circle"></i> <a href="#">About</a></li>
                <li><i class="fas fa-envelope"></i> <a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="page-wrapper">
    <div class="main-container">
