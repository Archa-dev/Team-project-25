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
    <!-- icon styles for filter colour options -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
   
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

/* shaded logo */
.logo img {
    max-width: 100%; /* Ensure the logo scales proportionally */
    max-height: 50px; /* Set the maximum height as needed */
    margin-left: auto; /* Center the logo horizontally */
}

/* icons */
.fas {
    font-size: 15px;
}

main {
    margin-top: 11vh; /* Adjust margin-top to be equal to the height of the header */
}

/* filter styles */
   /* Filter styles */
   .filter-container {
        width: 200px;
        padding: 20px;
        position: fixed;
        left: 20px;
        top: 200px;
        background-color: #f8f9fa; /* Light grey background */
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Soft shadow effect */
        z-index: 200;
    }

    .filter-title {
        font-size: 22px;
        margin-bottom: 30px;
        padding-left: 35px;
        color: #003b46; /* Dark blue */
    }

    .filter-option select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    background-color: #f8f9fa;
    font-size: 16px;
    appearance: none; 
    margin-bottom: 20px;
}

.filter-option select:focus {
    outline: none; /* Remove focus outline */
    border-color: #003B46; /* blue border color on focus */
}

.filter-option select option {
    background-color: #f8f9fa;
    color: #003B46;
}

.filter-option select option:hover {
    background-color: #007bff;
    color: #fff;
}

.filter-option label {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
    color: #003b46;
}

    .filter-button {
        background-color: #003b46; /* Dark blue */
        color: #fff; /* White text */
        padding: 10px;
        margin-top: 40px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .filter-button:hover {
        background-color: #07575B; /* Darker blue on hover */
    }

.filter-title {
    font-weight: bold; 
    font-size: 26px;
    margin-left: 8px; /* Moves title to the right */
    padding-top: 40px;
    
}

/* Price container styles */


#price-slider {
    margin-top: 20px; 
    margin-bottom: 40px; 
    color: #003B46;
}

#priceRange {
    width: 100%;
    margin-top: 10px;
    text-align: center;
    color: #003B46;
    font-weight: bold;
    border:none;
}

/* Adjust position of the price range label and slider */
#price-container {
    position: relative; 
}





/* filter styles end here */

.selection-title {
    display: flex;
    justify-content: center;
    margin-bottom: 50px;
    margin-left: -200px; /* left margin */
    margin-right: 20px; /* right margin */
}

.selection-title h2 {
    font-size: 35px;
    color: #003b46;
    font-weight: bold;
    
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
    padding-top: 60px; /* creates space for the fixed navbar */
}



#main {
    padding: 1rem;
    margin-left: 220px;
}


.main-container {
    flex: 1;
}





.buy-button {
    background-color: #003b46;
    border: none;
    color: #fff;
    padding: 2px 8px;
    text-align: auto;
    text-decoration:none;
    display: inline-block;
    font-size: 15px;
    margin: 10px 0;
    margin-left: 185px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
        
}

.product-info {
        text-align: left; 
        color: black;
        text-decoration: none;
        
       
        
    }

    .price {
        margin-top: 5px; /* Adds margin between the product name and the price */
        text-align: left;
        font-weight: bold;
        
    }


/* footer styles */
.footer {
    background-color: #003B46;
    color: #fff;
    padding: 50px 0; /* Add padding to the top and bottom */
}

.container {
    width: 90%; /* Set the width of the container */
    margin: auto; /* Center the container */
}

.footer-col {
    width: 25%; /* Set the width of each column */
    padding: 0 15px; /* Add horizontal padding */
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
    margin-bottom: 10px;
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


    <!-- filter colour options and button -->
        <div class="filter-container">
        <h3 class="filter-title">FILTER</h3>

    
  <!-- Category filter -->
  <div class="filter-option">
        <label for="categoryFilter">Category:</label>
        <select id="categoryFilter">
            <option value="all">All</option>
            <option value="mens">Mens</option>
            <option value="womens">Womens</option>
            <option value="unisex">Unisex</option>
            <option value="futuristic">Futuristic</option>
            <option value="bluelight">Bluelight</option>
        </select>
    </div>

    <!-- Colour filter -->
    <div class="filter-option">
        <label for="colourFilter">Colour:</label>
        <select id="colourFilter">
            <option value="all">All Colours</option>
            <option value="black">Black</option>
            <option value="white">White</option>
            <option value="yellow">Yellow</option>
            <option value="brown">Brown</option>
            <option value="green">Green</option>
        </select>
    </div>

    <!-- Price filter -->
    <div class="filter-option">
    <label for="priceRange">Price Range:</label>
    <div id="price-slider">
    <input type="text" id="priceRange" readonly style="color:#003b46; font-weight:bold;">
</div>
    </div>

    <!-- Apply filter button -->
    <button class="filter-button" onclick="applyFilter()">SUBMIT</button>
</div>

        <!-- main page title -->
        <div class="selection-title">
        <h2>SHOP OUR SELECTION</h2>
</div>

    <div class="container">
    <div class="row">
        <!-- Loop through each product and display buttons -->
        <?php foreach ($products as $product) : ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
            <a href="javascript:void(0);" onclick="buyProduct(<?= $product['product_id'] ?>);"style="text-decoration: none; color: black; ">
                <img src="MK-2161BU-0001_1.jpeg" width="100%" height="60%">
                </a>
                <div class="product-info">
                <a href="javascript:void(0);" onclick="buyProduct(<?= $product['product_id'] ?>);"style="text-decoration: none; color: black; ">
                <h3><?= $product['product_name'] ?></h3>
                </a>
                <p class="price"> £<?= $product['price'] ?></p>
            </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

    <form method="post" action="Item.php" id="buyForm">
    <!-- Hidden input fields to store the selected product ID and color -->
    <input type="hidden" name="selectedProductId" id="selectedProductId" value="">
    
   
</form>

<form method="post" action="">
                <!-- Hidden input field to store the selected color -->
                <input type="hidden" name="selectedColor" id="selectedColor" value="">
            </form>
    </div>

</main>


<footer class="footer">
     <div class="container">
     <div class="row">
     <div class="footer-col">
             <h4>&copyShaded | All Rights Reserved</h4>
             <ul>
             <li><a href="#">About Us</a></li>
             <li><a href="#">Contact Us</a></li>
             </ul>
     </div>
     <div class="footer-col">
            <h4>Product Links</h4>
            <ul>
            <li><a href="#">Sunglasses</a></li>
            <li><a href="#">Homepage Link 1 </a></li>
            <li><a href="#">Homepage Link 2</a></li>
            <li><a href="#">Homepage Link 3</a></li>
            </ul>
    </div>
    <div class="footer-col">
            <h4>Product Links</h4>
            <ul>
                <li><a href="#">a</a></li>
                <li><a href="#">b</a></li>
                <li><a href="#">c</a></li>
                <li><a href="#">d</a></li>
            </ul>
    </div>
    <div class="footer-col">
        <h4>follow us</h4>
        <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</div>
</div>
  </footer>



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

    $( function() {
    $( "#price-slider" ).slider({
        range: true,
        min: 20,
        max: 1000,
        values: [ 20, 1000 ],
        slide: function( event, ui ) {
            $( "#priceRange" ).val( "£" + ui.values[ 0 ] + " - £" + ui.values[ 1 ] );
        }
    });
    $( "#priceRange" ).val( "£" + $( "#price-slider" ).slider( "values", 0 ) +
        " - £" + $( "#price-slider" ).slider( "values", 1 ) );
} );

priceRange.addEventListener('input', updatePriceRange);

    // Function to handle product click
    function buyProduct(productId) {
        document.getElementById('selectedProductId').value = productId;
        document.forms[1].submit();
    }

</script>




</body>
</html>

