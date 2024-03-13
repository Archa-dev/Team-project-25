<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, 0.1);

            .navbar a {
                font-size: 15px;
                color: #000000;
                text-decoration: none;
            }

            /* Hide the dropdown arrow */
            .navbar-nav .nav-item.dropdown > .nav-link::after {
                display: none !important
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
    font-size: 15px;/* icon */
}

main {
    margin-top: 11vh;
margin-bottom: 60px;
}
    
/* Welcome Section Styles */
.welcome-section {
    padding: 20px;
    background-color: #003B46; /*  background color */
}

.welcome-section h2 {
    font-size: 18px;
    color: #fff;
}

/* Sidebar Styles */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 300px;
    height: 100%;
    padding-top: 110px;
    background-color: #f8f9fa; /* background color  */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.sidebar ul {
    list-style: none;
    padding-left: 0;
}

.sidebar .nav-link {
    padding: 15px 20px;
    text-decoration: none;
    color: #000;
    font-size: 14px; /* Adjust font size */
    font-weight: bold;
    transition: background-color 0.3s;
    display: block;
}

.sidebar .nav-link:hover {
    background-color: #07575B; /* background color for the hover effect */
    color: #000;
}

.main-content {
    margin-left: 350px; /* Adjust this value to match the width of the sidebar */
}

/* Additional Styling for Active Link */
.sidebar .nav-link.active {
    background-color: #07575B ; /*  background color for the active link */
    color: #000;
    opacity: 0.8;
    position: relative;
}

.sidebar .nav-link.active::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 5px; /* Adjust the width of the vertical line */
    background-color: #000; /* color of the vertical line */
}

    /* order history page Styles */
    .order-history {
        justify-content: center; 
    align-items: center;
    max-width: 87%;
    padding: 10px;
    margin: 50px auto; 
    }
    
    .order-history h2 {
    font-size: 40px; 
    padding-left: 220px;
    margin-bottom: 20px;
    margin-top: 20px;
}

    .order {
        margin-top: 20px;
        border-bottom: 1px solid #ccc;
        padding: 15px 0;
        color: #003B46;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative; 
    }
    
    .order-details {
        flex-grow: 1;
    }
    h2{
        color: #003B46;
       
    }

    .order-details h4 {
        font-size: 20px;
font-weight: bold;
    }
    
    /* View Details Button Styles */
    .view-details-btn {
        background-color: #003b46;
    border: none;
    color: #fff;
    padding: 5px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    font-weight: bold;
    margin: 80px 0;
    cursor: pointer;
    border-radius: 5px;
    white-space: nowrap;
    }
    
    .view-details-btn:hover {
    
        background-color: #07575B;
        color: #fff;
    }

    .additional-details {
        display: none;
    position: absolute; /* Change to relative */
    bottom: -120%; /* Adjust this value as needed */
    left: 0;
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.additional-details img {
    width: 100px; /* Set the width of the image */
    height: 100px; /* Set the height of the image */
    margin-bottom: 10px; /* Add some space below the image */
}

.additional-details p {
    color: #003B46; /* Set text color */
    font-size: 16px; /* Set font size */
}

    .sticky-footer-padding {
    margin-bottom: 8vh;
    /* Adjust the margin bottom to match the height of the footer */
}

/* footer styles */
.footer {
    background-color: #003B46;
    color: #fff;
    padding: 20px 0; /* Add padding to the top and bottom */
    bottom: 0; /* Stick the footer to the bottom */
    width: 100%;
  
    
}


.footer-col {
    width: 25%; /* Set the width of each column */
    padding: 0 15px; /* Add horizontal padding */
    padding-left: 80px;
}

.footer-col h4 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 20px;
}

.footer-col ul {
    list-style-type: none;
    padding: 0;
}

.footer-col ul li {
    margin-bottom: 5px;
    font-size: 14px;
}

.footer-col ul li a {
    color: #fff;
    text-decoration: none;
}

.social-links a {
    display: inline-block;
    margin-right: 10px;
    color: #fff;
    font-size:16px;
}

.social-links a:hover {
    color: #ccc;
}


</style>

    <title>Order History-SHADED</title>
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

                <a href="homepage.php" class="navbar-brand logo">
                    <img src="shaded logo.png" alt="Shaded Logo">
                </a>
                <div class="collapse navbar-collapse" id="navbarMenuItems">

                    <!-- navbar to the left of the search box -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Men
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Men's Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Men's White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Men's Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Men's Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Men's Green Sunglasses</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Women
                            </a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Women's Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Women's White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Women's Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Women's Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Women's Green Sunglasses</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Unisex
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Unisex Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Unisex White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Unisex Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Unisex Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Unisex Green Sunglasses</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Prescription
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Prescription Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Prescription White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Prescription Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Prescription Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Prescription Green Sunglasses</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Blue Light
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Blue Light Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Blue Light White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Blue Light Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Blue Light Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Blue Light Green Sunglasses</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutUs.php">About Us</a>
                        </li>
                    </ul>

                    <!-- search box -->
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="mySearchInput">
                        <button class="btn btn-outline-bg" type="submit">
                            <a href="#">
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
                                <li><a class="dropdown-item" href="homepage.php">Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-lock"></i> <!-- Assuming a lock icon for log in/sign up -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="login.php">Log In</a></li>
                                <li><a class="dropdown-item" href="signup.php">Sign Up</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-heart"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" >View Wishlist</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="basket.php">View Shopping Cart</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <!-- Profile Section -->
    <main class="sticky-footer-padding main-content">
    <div class="container"> <!-- Wrap the profile content in a Bootstrap container -->

    <aside class="sidebar">
    <div class="welcome-section">
        <h2>Welcome to your personal area</h2>
        <!-- You can dynamically replace [Username] with the actual username -->
    </div>
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="accountPage.php">
                My Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="order-history.php">
                My Orders
            </a>
            <li class="nav-item">
            <a class="nav-link" href="Contactus.php">Contact Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">
                Logout
            </a>
        </li>
    </ul>
</aside>

        <!-- order history title-->
        <div class="profile-container">
        <div class="order-history">
        <h2 class="border-bottom pb-2"><b>MY ORDERS</b></h2>
 
           
                 <!-- placeholder order details-->
                 <div class="order">
                    <div class="order-details">
                        <h4>Order 4842</h4>
                        <p>Date: </p>
                        <p>Total: £</p>
                    </div>
                    <!-- button that redirects to the product details page-->
                    <button class="view-details-btn" onclick="redirectToProductDetails()">VIEW DETAILS</button>
                </div>
           
            <!-- placeholder order details-->
            <div class="order">
                    <div class="order-details">
                        <h4>Order 4842</h4>
                        <p>Date: </p>
                        <p>Total: £</p>
                    </div>
                    <!-- button that redirects to the product details page-->
                    <button class="view-details-btn" onclick="redirectToProductDetails()">VIEW DETAILS</button>
                </div>
           
                 <!-- placeholder order details-->
                 <div class="order">
                    <div class="order-details">
                        <h4>Order 4842</h4>
                        <p>Date: </p>
                        <p>Total: £</p>
                    </div>
                    <!-- button that redirects to the product details page-->
                    <button class="view-details-btn" onclick="redirectToProductDetails()">VIEW DETAILS</button>
                </div>
           

           
            </div>
        </div>
    </main>


    <footer class="footer">
     <div class="container">
     <div class="row">
     <div class="footer-col">
             <h4>&copyShaded | All Rights Reserved</h4>
             <ul>
             <li><a href="TermsandConditions.html">Terms & Conditions </a></li>
             <li><a href="Policy.html">Privacy and Cookies Policy</a></li>
             
             </ul>
     </div>
     <div class="footer-col">
            <h4>References</h4>
            <ul>
            <li><a href="References For Products.txt"  target="_blank" >Sunglasses Products</a></li>
            <li><a href="Home & Login Media References.txt" target="_blank" >Homepage References </a></li>
            <li><a href="Home & Login Media References.txt"  target="_blank" >Login/Signup References</a></li>
            
            </ul>
    </div>
    <div class="footer-col">
            <h4>Need Help?</h4>
            <ul>
                <li><a href="about.Us.php">About Us</a></li>
                <li><a href="Contactus.php">Contact Us</a></li>
                <li><a href="FAQs.html">FAQs</a></li>
                
            </ul>
    </div>
    <div class="footer-col">
        <h4>follow us</h4>
        <div class="social-links">
            <a href="https://en-gb.facebook.com/"  target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/?lang=en-gb"  target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/" target="_blank" ><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</div>
</div>
        </footer>

    <script> 
    function redirectToProductDetails(productId) {
        window.location.href = 'product-details.php?id=' + productId;
            // JavaScript function to submit the form
  
    }
  
    </script>




</body>
</html>
