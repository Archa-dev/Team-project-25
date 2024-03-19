<!DOCTYPE html>
<html lang="en">
<?php
require_once('connectdb.php');

// Check if a color filter is set
$colorFilter = isset($_POST['colorSelect']) ? $_POST['colorSelect'] : 'all';

// Build the SQL query with the color filter
$query = "SELECT * FROM productdetails";
if ($colorFilter !== 'all') {
    $query .= " WHERE colour = :color";
}

$stmt = $db->prepare($query);

// Bind the color parameter if it's set
if ($colorFilter !== 'all') {
    $stmt->bindParam(':color', $colorFilter, PDO::PARAM_STR);
}

// Execute the query
$result = $stmt->execute();

// Check for errors
if (!$result) {
    die("Database query failed.");
}

// Fetch the results as an associative array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHADED</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <style>

html {
    font-size: 100%;
    scroll-behavior: smooth;
/* Navbar Styles */
    > body {
        font-family: "Century Gothic", sans-serif;
        background-color: #ffffff;
        margin: 0;
        margin-bottom: 60px; 
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
    font-size: 15px; /*icons */
}

main {
    margin-top: 11vh; /* Adjust margin-top to be equal to the height of the header */
}

.filter-container {
            
            width: 200px; 
            padding: 15px;
            position: fixed;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 10px;
}

/* Style the filter button */
button[type="submitfilter"] {
    background-color: darkgrey;
    color: #fff;
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submitfilter"]:hover {
    background-color: grey;
}


.container-fluid {
    flex: 1;
    margin-top: auto;
}

h3 {
   font-size: 18px;
   
}

h2 {
   font-size: 20px;
   margin: 10px 0;
    margin-left: 14px;
}

main {
    margin-top: 11vh;
    padding-top: 60px; /*  padding to create space for the fixed navbar */
}



#main {
    padding: 1rem;
    margin-left: 220px;
}


.main-container {
    flex: 1;
}



.buy-button {
    background-color: darkgrey;
    border: none;
    color: #fff;
    padding: 2px 8px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 15px;
    margin: 10px 0;
    margin-left: 100px;
    cursor: pointer;
    border-radius: 5px;
        
}



.buy-button:hover {
    background-color: grey;
}

        /* footer styles*/
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
    text-decoration: underline; /* underlining on hover  */
    color: #000; /*  hover color */
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


    <main>
    <div id="main">
        
    <div class="main-container">

        <div class="filter-container">
        /* filter for selecting a specific product colour */
<form method="post" action="">
    <label for="colorSelect">Select Color:</label>
    <select name="colorSelect" id="colorSelect">
        <option value="all">All Colors</option>
        <option value="black">Black</option>
        <option value="white">White</option>
        <option value="yellow">Yellow</option>
        <option value="brown">Brown</option>
        <option value="green">Green</option>
    </select>
    <button type="submitfilter">Filter</button>
</form>
        </div>

        <h2>Shop our Selection</h2>
    <div class="container">
    <div class="row">
        <!-- Loop through each product and display buttons -->
        <?php foreach ($products as $product) : ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                
                <img src="MK-2161BU-0001_1.jpeg" width="90%" height="60%">
                <h3><?= $product['product_name'] ?></h3>
                <p> £<?= $product['price'] ?><span class="buy-button-container"><button class="buy-button" data-product-id="<?= $product['product_id'] ?>" data-color="<?= $product['colour'] ?>">Buy</button></span></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

    <form method="post" action="Item.php" id="buyForm">
    <!-- Hidden input fields to store the selected product ID and color -->
    <input type="hidden" name="selectedProductId" id="selectedProductId" value="">

   
</form>
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
                        <!-- social media icons  -->
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                       
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="terms-links">
                        /* Links to Terms of use and cookies policy do not actually lead anywhere */
                        <a href="#">Terms of Use</a>
                        <a href="#">Cookies Policy</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add a click event listener to all buttons with the class 'buy-button'
        document.querySelectorAll('.buy-button').forEach(function (button) {
            button.addEventListener('click', function () {
                // Get the product ID
                var productId = button.getAttribute('data-product-id');


                // Set the values of the hidden input fields
                document.getElementById('selectedProductId').value = productId;

                // Submit the form
                document.forms['buyForm'].submit();
            });
        });
    });
</script>


</body>
</html>

