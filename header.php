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
    /* Header */
        header {
            background-color: rgb(46, 52, 64);
            color: rgb(171,185,207);
          
            text-align: center;
            margin-bottom: 2rem;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
   
            padding: 0.2rem;
            box-sizing: border-box;
            padding-left: 50px;
            padding-right: 50px;
            position: fixed; 
            width: 100%;
            top: 0;
            background-color: rgb(36,41,51);
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: top 0.3s ease-in-out;
        }
        
        nav ul {
          list-style: none;
          padding: 0;
          text-align: center;
        }
        
        nav ul li {
          display: inline;
          margin: 0 15px;
        }
        
        nav ul li a {
          color: rgb(171,185,207);
          text-decoration: none;
          font-weight: bold;
        }
        nav {
            width: 100%;
        }
        
        #navbar nav {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 990px;
            justify-content: space-between;
        }

     .navbar {

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

        /* Update Banner */
        #update-banner {
            position: fixed;
            top: 55px; /* Adjust based on navbar height */
            left: 0;
            width: 100%;
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            text-align: center;
            z-index: 999;
            display: none; /* Initially hidden */
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
        }
        
        #update-banner.hidden {
            transform: translateY(-100%);
            opacity: 0;
        }

        #close-banner {
          background: #000;
          color: #fff;
          border: none;
          padding: 5px 10px;
          margin-left: 15px;
          cursor: pointer;
          font-size: 14px;
          border-radius: 5px;
        }

        #close-banner:hover {
          background: #444;
        }
    </style>

</head>
<body>


    
     <header id="navbar">
        <nav>
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
        
        <div id="update-banner">
            🚀 We're updating our website for a consistent experience across all pages and tools. Please bear with us.
            <button id="close-banner" onclick="closeBanner()">X</button>
        </div>
        
    </header>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const banner = document.getElementById("update-banner");
        const navbar = document.getElementById("navbar");
    
        function adjustNavbar() {
            if (banner && banner.style.display !== "none") {
                navbar.style.top = `${banner.offsetHeight}px`; // Shift navbar below banner
            } else {
                navbar.style.top = "0"; // Navbar back to top when banner is removed
            }
        }
    
        // Adjust navbar on load
        adjustNavbar();
    
        // Close banner function
        window.closeBanner = function() {
            banner.style.display = "none";
            adjustNavbar();
        };
    });
    </script>
    
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const banner = document.getElementById("update-banner");
    
        function getLastShownDate() {
            return localStorage.getItem("updateBannerLastShown");
        }
    
        function setLastShownDate() {
            const today = new Date().toISOString().split("T")[0]; // Store only YYYY-MM-DD
            localStorage.setItem("updateBannerLastShown", today);
        }
    
        function shouldShowBanner() {
            const lastShown = getLastShownDate();
            const today = new Date().toISOString().split("T")[0]; 
            return lastShown !== today; // Show only if it's a new day
        }
    
        function showBanner() {
            banner.style.display = "block"; // Make banner visible
            setTimeout(() => {
                banner.classList.remove("hidden"); // Animate it into place
            }, 50); // Small delay to trigger transition
        }
    
        function closeBanner() {
            banner.classList.add("hidden"); // Apply closing animation
            setTimeout(() => {
                banner.style.display = "none"; // Hide after animation
            }, 500); // Delay matches the transition time
            setLastShownDate(); // Prevent it from showing again for 24 hours
        }
    
        window.closeBanner = closeBanner; // Make function accessible to HTML button
    
        // Check if the banner should appear
        if (shouldShowBanner()) {
            showBanner();
        }
    });
    </script>




    
    <div class="page-wrapper">
    <div class="main-container">
