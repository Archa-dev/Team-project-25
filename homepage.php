<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SHADED</title>

        <!--bootstrap css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        
<style>

html {
    font-size: 100%;
    scroll-behavior: smooth;

    > body {
        font-family: "Century Gothic", sans-serif;
        background-color: #ffffff;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none; border: none;
        text-decoration: none;
        text-transform: capitalize;
        transition: .2s linear;

        > header {
            background: #ffffff;
            position: fixed;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: space-between; /* Align logo to the left and nav to the right */
            align-items: center;
            top: 0; left: 0; right: 0;
            box-shadow: 0 0 12px #1c7a7f;

            .navbar-nav {
                font-size: 15px;
                text-decoration: none;
                font-weight: bold;
            }

            .search-box {
    border: 3px solid #003b46; /* Set border color */
}

            .navbar .search-btn {
    background-color: #003b46; /* Set background color to green */
    border: none; /* Remove border */
    transition: background-color 0.3s ease;
    margin-right: 10px;
}

            .navbar .search-icon {
                color: #fff; /* Default text color */
                text-decoration: none; /* Remove default underline */
            }

            .navbar .search-btn:hover {
                background-color: #1c7a7f; /* Text color on hover */
            }

            /* Hide the dropdown arrow */
            .navbar-nav .nav-item.dropdown > .nav-link::after {
                display: none !important
            }

            .navbar-nav .nav-item {
            margin-right: 12px; /* Add margin between navbar items */
        }

            .navbar-nav .nav-item .nav-link {
            color: #003b46; /* Default text color */
            text-decoration: none; /* Remove default underline */
            transition: color 0.3s ease, border-bottom-color 0.3s ease; /* Smooth transition for color change */
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #1c7a7f; /* Text color on hover */
            border-bottom: 4px solid #1c7a7f; /* Underline on hover */
        }
        }
    }
}

.logo img {
    max-width: 100%; /* Ensure the logo scales proportionally */
    max-height: 50px; /* Set the maximum height as needed */
    margin-left: auto; /* Center the logo horizontally */
}

.fas {
    font-size: 15px;
}

main {
    margin-top: 90px; /* Adjust margin-top to be equal to the height of the header */
}

/* Additional styles for the main content images and text overlay */
.main-content {
            position: relative;
            max-width: 100%;
            overflow: hidden;
            padding: 10px;
            margin-left: 30px;
            margin-right: 30px;
        }

        .main-content img {
            width: 100%;
            height: auto;
            display: block;
            margin: auto;
        }

        .main-content video {
        width: 100%; /* Set video width to fill the container */
        height: auto; /* Automatically adjust height to maintain aspect ratio */
    }

        .text-overlay {
            position: absolute;
            top: 30px; /* Adjust the top value to control the distance from the top */
            left: 30px; /* Adjust the left value to control the distance from the left */
            text-align: left;
            color: #fff; /* Text color */
        }

   .btn-shop {
    background-color: #003b46;
    border: none; /* Remove border */
    transition: background-color 0.3s ease;
    font-size: 18px;
    font-weight: bold;
}

.shop-buttons{
    position: absolute;
    top: 30px;
    right: 30px;
    text-align: right;
}

.btn-shop:hover {
                background-color: #1c7a7f; /* Text color on hover */
            }

        .video-container {
    position: relative;
    max-width: 100%;
    overflow: hidden;
}

/* Add specific styles for the first column */
.col-md-6:nth-child(1) .video-container .text-overlay {
    left: 30px; /* Adjust the left value to control the distance from the left for the first column */
    top: 30px;
}

/* Add specific styles for the second column */
.col-md-6:nth-child(2) .video-container .text-overlay {
    left: 30px;
    top: 30px;
}

/* Media query for smaller screens */
@media (max-width: 767px) {
    .text-overlay {
        left: 50%; /* Center the text horizontally on smaller screens */
        transform: translateX(-50%);
    }
}

@media (max-width: 767px) {
    .col-md-6:nth-child(1) .video-container  .text-overlay {
        left: 50%; /* Center the text horizontally on smaller screens */
        transform: translateX(-50%);
    }
}

@media (max-width: 767px) {
    .col-md-6:nth-child(2) .video-container  .text-overlay {
        left: 50%; /* Center the text horizontally on smaller screens */
        transform: translateX(-50%);
    }
}

h2{
    font-weight: bold;
}

.bold-link {
    font-weight: bold;
}

        /* Style for the custom link text */
        .custom-link {
            color: #fff;
        }

        .no-underline {
            text-decoration: none !important;
        }

        #sun-icon {
    position: fixed; /* Change position to fixed */
    top: 100px; /* Initial top position */
    right: 10px;
    font-size: 32px;
    color: yellow; /* Initial color of the sun icon */
    text-shadow: 0 0 10px black; /* Add outline */
    z-index: 1000; /* Ensure it appears above the navbar */
    transition: top 0.1s ease, color 0.2s linear; /* Transition for smooth movement and color change */
}


.shopping-bag-popup {
    position: fixed;
    top: 80px;
    right: -400px; /* Initially hidden */
    width: 400px;
    height: auto;
    background-color: #fff;
    z-index: 999;
    transition: right 0.3s ease;
    padding: 20px;
}

.shopping-bag-popup.show {
    right: 0; /* Slide in from the right */
}

/* CSS for dark mode */
.dark-mode {
    background-color: #000000; /* Change background color to black */
    color: #ffffff; /* Change text color to white */
}

#dark-mode-toggle:hover{
    background-color: #1c7a7f; /* Text color on hover */
            }

.dark-mode header {
    background-color: #000000; /* Change navbar background color to black */
}

/* Update sun/moon icon styles */
.dark-mode #dark-mode-toggle .fas {
    color: #ffffff; /* Change color of moon icon to white */
}

#dark-mode-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #003b46;
    border: 3px solid #003b46;
    border-radius: 40%; /* Make it circular */
    padding: 12px;
    z-index: 1000; /* Ensure it appears above other content */
}

#dark-mode-toggle .fas {
    color: #ffffff;
}

/* Updated Footer Styles */
.footer {
            background-color: #003b46;
            color: #fff;
            padding: 10px;
            text-align: center;
            width: 100%;
            font-size: 14px;
            box-shadow: 0 0 12px #1c7a7f;
        }

.social-icons a {
            margin: 0 20px;
            color: #fff;
            font-size: 14px;
        }

.terms-links a {
    margin-left: 5px;
    color: #fff; /* Change the color as needed */
    text-decoration: none;
}

.terms-links a:hover {
    text-decoration: underline; /* Add underlining on hover if desired */
    color: #000; /* Change the hover color as needed */
}

</style>

    </head>
    <body>
        <!--bootstrap js-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                crossorigin="anonymous">
        </script>

    <header>
        <!-- added bootstrap navbar utility classes -->
        <nav class="navbar navbar-expand-sm w-100">

            <!-- using container-fluid for responsiveness -->
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenuItems" aria-controls="navbarMenuItems" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="#" class="navbar-brand logo">
                    <img src="images/Logo 2.png" alt="Shaded Logo">
                </a>
                <div class="collapse navbar-collapse" id="navbarMenuItems">

                    <!-- navbar to the left of the search box -->
                    <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                    <li class="nav-item">
                            <a class="nav-link" href="shopping.php">Shop All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutUs.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Contactus.php">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reviews.php">Reviews</a>
                        </li>
                    </ul>

                    <!-- search box -->
                    <form class="d-flex" role="search">
                        <input class="form-control me-2 search-box" type="search" placeholder="Search" aria-label="Search" id="mySearchInput">
                        <button class="btn btn-outline-bg search-btn" type="submit">
                            <a href="#" class="search-icon"">
                                <i class="fas fa-search"></i>
                            </a>
                        </button>
                    </form>

                    <!-- navbar to the right of the search box -->
                    <ul class="navbar-nav mw-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> <!-- Assuming a user icon for admin/user -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="accountPage.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="order-history.php">My Orders</a></li>
                                <li><a class="dropdown-item" href="login.php">Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-lock"></i> <!-- Assuming a lock icon for log in/sign up -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="admin.php">Admin</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="shopping-bag-icon">
                                <i class="fas fa-shopping-bag"></i>
                            </a>
                            <div id="shopping-bag-popup" class="shopping-bag-popup">
                                <!-- Content of the shopping bag popup goes here -->
                                <div class="shop-buttons">
                    <a href="shopping.php" class="btn btn-primary btn-shop">EXPLORE NOW</a>
                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div id="dark-mode-toggle">
        <a class="nav-link" href="#">
            <i class="fas fa-lightbulb"></i>
        </a>
    </div>

    <main class="sticky-footer-padding">

    <div id="sun-icon">&#9728;</div>

    <div class="main-content">
            <video src="videos/1.mp4" autoplay muted loop></video>
            <div class="text-overlay">
                <a href="shopping.php" class="custom-link no-underline">
                    <h2 class="no-underline">Shop the Latest Collection</h2>
                </a>
                <a href="shopping.php" class="custom-link no-underline">
                    <p class="no-underline">Discover new arrivals and trends for the season.</p>
                </a>
            </div>
                <div class="shop-buttons">
                    <a href="shopping.php" class="btn btn-primary btn-shop">EXPLORE NOW</a>
                </div>
    </div>

        <div class="main-content">
            <img src="images/BW 2,1.jpg" alt="Image 1">
            <div class="text-overlay">
                <a href="shopping.php" class="custom-link no-underline">
                    <h2 class="no-underline">Special Offers</h2>
                </a>
                <a href="shopping.php" class="custom-link no-underline">
                    <p class="no-underline">Enjoy exclusive discounts on your favorite sunglasses.</p>
                </a>
            </div>
            <div class="shop-buttons">
                <a href="shopping.php" class="btn btn-primary btn-shop">SHOP DEALS</a>
        </div>
        </div>

        <div class="main-content">
    <div class="row">
        <div class="col-md-6">
            <div class="video-container">
            <video src="videos/2.mp4" autoplay muted loop></video>
                <div class="text-overlay">
                    <a href="shopping.php" class="custom-link no-underline">
                        <h2 class="no-underline">Men's Sunglasses</h2>
                    </a>
                </div>
                <div class="shop-buttons">
                <a href="shopping.php" class="btn btn-primary btn-shop">SHOP</a>
        </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="video-container">
            <video src="videos/3.mp4" autoplay muted loop></video>
                <div class="text-overlay">
                    <a href="#" class="custom-link no-underline">
                        <h2 class="no-underline">Women's Sunglasses</h2>
                    </a>
                </div>
                <div class="shop-buttons">
                <a href="shopping.php" class="btn btn-primary btn-shop">SHOP</a>
        </div>
            </div>
        </div>
    </div>
</div>

    </main>
    
    <!-- Bootstrap Container for Footer -->
    <div class="container-fluid">
        <footer class="footer">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-text">
                        <p>&copy;Shaded-2023 | All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="social-icons">
                        <!-- Add your social media icons  -->
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <!-- Add more social media icons as needed -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="terms-links">
                        <a href="#">Terms of Use</a>
                        <a href="#">Cookies Policy</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

<!-- JavaScript for Scroll Icon -->
<script>
      window.addEventListener('scroll', function() {
    var sunIcon = document.getElementById('sun-icon');
    var navbarHeight = document.querySelector('header').offsetHeight;
    var footerHeight = document.querySelector('footer').offsetHeight;
    var scrollPosition = window.scrollY;
    var windowHeight = window.innerHeight;
    var bodyHeight = document.body.clientHeight;

    // Calculate the position of the sun icon based on scroll position
    var maxScroll = bodyHeight - windowHeight;
    var visibleHeight = windowHeight - navbarHeight - footerHeight;
    var newPosition = Math.min(Math.max((scrollPosition - navbarHeight) / (maxScroll - navbarHeight - visibleHeight), 0), 1) * (visibleHeight - 40) + navbarHeight;

    // Adjust the sun icon's top position
    sunIcon.style.top = newPosition + 'px';

    // Calculate the ratio of scroll position to the total scroll height
    var scrollRatio = (scrollPosition - navbarHeight) / (maxScroll - navbarHeight - visibleHeight);

    // Calculate color gradient between yellow (#FFFF00) and black (#000000)
    var red = 255 - (255 * scrollRatio);
    var green = 255 - (255 * scrollRatio);
    var blue = 0;

    // Set the color of the sun icon
    sunIcon.style.color = 'rgb(' + red + ', ' + green + ', ' + blue + ')';
});

// Set initial position of the sun icon below the navbar
window.addEventListener('DOMContentLoaded', function() {
    var sunIcon = document.getElementById('sun-icon');
    var navbarHeight = document.querySelector('header').offsetHeight;
    sunIcon.style.top = navbarHeight + 'px';
});

document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;

    darkModeToggle.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        // Toggle icon between light bulb and moon
        darkModeToggle.querySelector('i').classList.toggle('fa-lightbulb');
        darkModeToggle.querySelector('i').classList.toggle('fa-moon');
    });
});

document.getElementById('shopping-bag-icon').addEventListener('click', function() {
  const popup = document.getElementById('shopping-bag-popup');
  popup.classList.toggle('show');
});

    document.addEventListener('click', function(event) {
        const popup = document.getElementById('shopping-bag-popup');
        const shoppingBagIcon = document.getElementById('shopping-bag-icon');
        const isClickInsidePopup = popup.contains(event.target);
        const isClickOnIcon = shoppingBagIcon.contains(event.target);

        if (!isClickInsidePopup && !isClickOnIcon) {
            popup.classList.remove('show');
        }
    });
    </script>

</body>
</html>

