<!DOCTYPE html>
<?php
require_once('connectdb.php');

session_start();
 $customerId=$_SESSION["customer_id"];

$items = $db->prepare("SELECT o.order_id, o.date, p.price FROM `previousorders` o
                      JOIN `productdetails` p ON o.product_id = p.product_id
                      WHERE o.customer_id = ?");
$items->bindParam(1, $customerId);
$items->execute();
$orders = $items->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
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
        margin-bottom: 60px; /* Adjust this value to match the height of the footer */
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
    margin-top: 11vh; /* Adjust margin-top to be equal to the height of the header */
}

.sticky-footer-padding {
    margin-bottom: 11vh;
}
        
/* Welcome Section Styles */
.welcome-section {
    padding: 20px;
    background-color: #f8f9fa; /*  background color */
}

.welcome-section h2 {
    font-size: 18px;
    color: #000;
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
    background-color: lightgrey; /* background color for the hover effect */
    color: #000;
}

.main-content {
    margin-left: 350px; /* Adjust this value to match the width of the sidebar */
	margin-top: -20px;
}

/* Additional Styling for Active Link */
.sidebar .nav-link.active {
    background-color: #f5f5f5; /*  background color for the active link */
    color: #000;
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
        justify-content: space-between;
    align-items: flex-start;
        max-width: 87%;
        padding: 10px;
        margin: 50px;
    }
    
    .order {
        border-bottom: 1px solid #ccc;
        padding: 15px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .order-details {
        flex-grow: 1;
    }
    
    /* View Details Button Styles */
    .view-details-btn {
        background-color: #fff;
        color: #000;
        padding: 8px 15px;
        border: none;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s, text-decoration 0.3s;
    }
    
    .view-details-btn:hover {
        text-decoration: underline;
        background-color: #fff;
        color: #000;
    }

        
    .sticky-footer-padding {
    margin-bottom: 8vh;
    /* Adjust the margin bottom to match the height of the footer */
}

/* Updated Footer Styles */
.footer {
            background-color: #fff;
            color: grey;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            font-size: 14px;
            box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.1);
        }

.social-icons a {
            margin: 0 20px;
            color: grey;
            font-size: 14px;
        }

.terms-links a {
    margin-left: 5px;
    color: #6c757d; 
    text-decoration: none;
}

.terms-links a:hover {
    text-decoration: underline; /*  underlining on hover */
    color: #000; /*  hover color */
}

</style>

    <title>Order History - SHADED</title>
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
                     <!--   <li class="nav-item dropdown"> 
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Men
                            </a>-->
            					 <li class="nav-item">
                            <a class="nav-link" href="shopping.php">Products</a>
                        		</li>
                        <!--    <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Men's Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Men's White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Men's Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Men's Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Men's Green Sunglasses</a></li>
                            </ul> -->
                        <!--</li>-->
                        <li class="nav-item dropdown">
                           <!-- <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Women
                            </a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Women's Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Women's White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Women's Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Women's Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Women's Green Sunglasses</a></li>
                            </ul>
                        </li>-->
            					<li class="nav-item">
                            <a class="nav-link" href="Contactus.php">Contact Us</a>
                        		</li>
                        <li class="nav-item dropdown">
                         <!--   <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="aboutUs.php">About Us</a>
                        </li>
                    </ul>

                    <!-- search box -->
<!--                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="mySearchInput">
                        <button class="btn btn-outline-bg" type="submit">
                            <a href="#">
                                <i class="fas fa-search"></i>
                            </a>
                        </button>
                    </form>
-->
                    <!-- navbar to the right of the search box -->
                    <ul class="navbar-nav mw-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> <!-- Assuming a user icon for admin/user -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="accountPage.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="order-history.php">My Orders</a></li>
                                <li><a class="dropdown-item"  name="nav-logout-button" href="login.php" >Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-lock"></i> <!-- Assuming a lock icon for log in/sign up -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                 <!--               <li><a class="dropdown-item" href="login.php">Log In</a></li>
                                <li><a class="dropdown-item" href="signup.php">Sign Up</a></li> --> <!-- for later implementation -->
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
 <?php
if(isset($_POST['nav-logout-button'])){
	session_start();

	session_unset();
	
	session_destroy();
	
	header("Location:login.php");
	exit();
                                
                                
                                }
                                
                                
                                ?>

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
		    <a class="nav-link"  name="nav-logout-button" href="login.php" ></a>
                <!--Logout-->
            </a>
        </li>
    </ul>
</aside>

        <!-- order history title-->
        <div class="profile-container">
        <div class="order-history">
        <h2 class="border-bottom pb-2">Order History</h2>

        <?php foreach ($orders as $order) : ?>
                <!-- brief order details-->
                <div class="order">
                    <div class="order-details">
                        <h5>Order <?= $order['order_id'] ?></h5>
                        <p>Date: <?= $order['date'] ?></p>
                        <p>Total: £<?= $order['price'] ?></p>
                    </div>
                    <!-- button that redirects to the product details page-->
                    <button class="view-details-btn" onclick="redirectToProductDetails(<?= $order['order_id'] ?>)">View Details</button>
                </div>
            <?php endforeach; ?>

                <!-- brief order details-->
                <div class="order">
                    <div class="order-details">
                        <h5>Order 1</h5>
                        <p>Date: 2023-12-01</p>
                        <p>Total: £39.99</p>
                    </div>
                    <!-- button that redirects to the product details page-->
                    <button class="view-details-btn" onclick="redirectToProductDetails()">View Details</button>
                </div>
           
                <!-- brief order details-->
                <div class="order">
                    <div class="order-details">
                        <h5>Order 2</h5>
                        <p>Date: 2023-12-02</p>
                        <p>Total: £69.99</p>
                    </div>
                    <!-- button that redirects to the product details page-->
                    <button class="view-details-btn" onclick="redirectToProductDetails()">View Details</button>
                </div>

                <!-- brief order details-->
                <div class="order">
                    <div class="order-details">
                        <h5>Order 3</h5>
                        <p>Date: 2023-12-03</p>
                        <p>Total: £49.99</p>
                    </div>
                    <!-- button that redirects to the product details page-->
                    <button class="view-details-btn" onclick="redirectToProductDetails()">View Details</button>
                </div>

                <!-- brief order details-->
                <div class="order">
                    <div class="order-details">
                        <h5>Order 4</h5>
                        <p>Date: 2023-12-04</p>
                        <p>Total: £39.99</p>
                    </div>
                    <!-- button that redirects to the product details page-->
                    <button class="view-details-btn" onclick="redirectToProductDetails()">View Details</button>
                </div>

                <!-- brief order details-->
                <div class="order">
                    <div class="order-details">
                        <h5>Order 5</h5>
                        <p>Date: 2023-12-05</p>
                        <p>Total: £49.99</p>
                    </div>
                    <!-- button that redirects to the product details page-->
                    <button class="view-details-btn" onclick="redirectToProductDetails()">View Details</button>
                </div>

            <!-- Add more orders-->

           
            </div>
        </div>
    </main>

    <!--Bootstrap Container for Footer -->
    
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
                        <!--social media icons  -->
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                    
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="terms-links">
                      <!--links do not redirect anywhere-->
                        <a href="#">Terms of Use</a>
                        <a href="#">Cookies Policy</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    </body>
</html>
