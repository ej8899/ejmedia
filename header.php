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
    
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.css" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
     
     <script>
        tailwind.config = {
            darkMode: 'class',
              theme: {
                extend: {
                  colors: {
                    primary: {"50":"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a","950":"#172554"},
                    gray: {
                        800: '#3b4252', /* nord0 */
                    }
                  }
                },
                fontFamily: {
                  'body': [
                'Inter', 
                'ui-sans-serif', 
                'system-ui', 
                '-apple-system', 
                'system-ui', 
                'Segoe UI', 
                'Roboto', 
                'Helvetica Neue', 
                'Arial', 
                'Noto Sans', 
                'sans-serif', 
                'Apple Color Emoji', 
                'Segoe UI Emoji', 
                'Segoe UI Symbol', 
                'Noto Color Emoji'
              ],
                  'sans': [
                'Inter', 
                'ui-sans-serif', 
                'system-ui', 
                '-apple-system', 
                'system-ui', 
                'Segoe UI', 
                'Roboto', 
                'Helvetica Neue', 
                'Arial', 
                'Noto Sans', 
                'sans-serif', 
                'Apple Color Emoji', 
                'Segoe UI Emoji', 
                'Segoe UI Symbol', 
                'Noto Color Emoji'
              ]
                }
              }
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.js"></script>

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
    :root {
        --tw-bg-opacity: 1;
        --bg-gray-800: #2e3440 !important; 
    }

    /* Header */
    

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


    
    <!-- <header id="navbar">-->
    <!--    <nav>-->
    <!--        <div class="logo"><img src="/graphics/logo-ejmedia.webp" alt="EJMEDIA.CA" class="logo-image"></div>-->
    <!--        <button class="menu-toggle" onclick="toggleMenu()">&#9776;</button>-->
    <!--        <ul id="nav-links" class="nav-links">-->
    <!--            <li><i class="fas fa-home"></i> <a href="/">Home</a></li>-->
    <!--            <li><i class="fas fa-blog"></i> <a href="/blog-main.html">Blog</a></li>-->
    <!--            <li><i class="fas fa-wrench"></i> <a href="/tools.html">Tools</a></li>-->
    <!--            <li><i class="fas fa-info-circle"></i> <a href="#">About</a></li>-->
    <!--            <li><i class="fas fa-envelope"></i> <a href="#">Contact</a></li>-->
    <!--        </ul>-->
    <!--    </nav>-->
        
    <!--    <div id="update-banner">-->
    <!--        🚀 We're updating our website for a consistent experience across all pages and tools. Please bear with us.-->
    <!--        <button id="close-banner" onclick="closeBanner()">X</button>-->
    <!--    </div>-->
        
    <!--</header>-->
    
    <header>
    <nav class="bg-white border-b border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800 fixed w-full top-0 left-0 shadow-md z-50">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="https://ejmedia.ca" class="flex items-center">
                <img src="/graphics/logo-ejmedia.webp" class="mr-3 h-6 sm:h-9" alt="EJMedia.ca Logo" />
                <!--<span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">EJ Media</span>-->
            </a>
            <div class="flex items-center lg:order-2">
                <!--<a href="#" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Log in</a>-->
                <!--<a href="#" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Get started</a>-->
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="/" class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="/blog-main.html" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Blog</a>
                    </li>
                    <li>
                        <a href="/tools.html" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Tools</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Team</a>
                    </li>
                    <li>
                        <a href="#contactus" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
    

    



   
   
    
 <script>
    document.documentElement.classList.add('dark');
        // // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        // if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        //     document.documentElement.classList.add('dark');
        // } else {
        //     document.documentElement.classList.remove('dark')
        // }
    </script>



    
    <div class="page-wrapper">
    <div class="main-container">
