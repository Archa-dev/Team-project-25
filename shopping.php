<?php
require_once('connectdb.php');
session_start();
if(isset($_SESSION['customer_id'])) {
$customerid = $_SESSION['customer_id'];}

// Check if a color filter is set
$colorFilter = isset($_POST['colorSelect']) ? $_POST['colorSelect'] : 'all';

// Check if the search filter is set
$searchFilter = isset($_POST['searchFilter']) ? $_POST['searchFilter'] : 'all';

// Check if a category filter is set
$categoryFilter = isset($_POST['categoryFilter']) ? $_POST['categoryFilter'] : 'all';

// Check if a price range filter is set
//$priceRange = isset($_POST['priceRange']) ? array_map('intval', explode('-', $_POST['priceRange'])) : array(20, 1000);
if(isset($_POST['priceRange']) && is_array($_POST['priceRange']) && isset($_POST['priceRange'][0])) {
    $splitElements = explode('-', $_POST['priceRange'][0]); 
    $priceRange[0] = $splitElements[0];
    $priceRange[1] = $splitElements[1];
}
// Extract min and max prices from the price range array
$minPrice = isset($priceRange[0]) ? $priceRange[0] : 20;
$maxPrice = isset($priceRange[1]) ? $priceRange[1] : 1000;
//echo $maxPrice;
// Build the SQL query with both category, color, and price range filters
$query = "SELECT * FROM productdetails WHERE 1";

// Build the SQL query with price range filter
$query .= " AND price BETWEEN :minPrice AND :maxPrice";


if ($categoryFilter !== 'all') {
    $query .= " AND category = :category";
}
if ($colorFilter !== 'all') {
    $query .= " AND colour = :color";
}
if (strpos($searchFilter, 'women') !== false || strpos($searchFilter, 'woman') !== false || strpos($searchFilter, 'lad') !== false || strpos($searchFilter, 'female') !== false) {
    $searchFilter = 'female';
}
elseif (strpos($searchFilter, 'men') !== false || strpos($searchFilter, 'man') !== false || strpos($searchFilter, 'male') !== false){
    $searchFilter = 'male';
}


if ($searchFilter !== 'all') {
    $query .= " AND (product_name LIKE :searchFilter OR category = :catSearchFilter OR colour LIKE :searchFilter)";
}


// Prepare the SQL statement
$stmt = $db->prepare($query);

// Bind the category parameter if it's set
if ($categoryFilter !== 'all') {
    $stmt->bindParam(':category', $categoryFilter, PDO::PARAM_STR);
}

// Bind the color parameter if it's set
if ($colorFilter !== 'all') {
    $stmt->bindParam(':color', $colorFilter, PDO::PARAM_STR);
}
// Bind the parameter if it's set
if ($searchFilter !== 'all') {
    $catSearchFilter = $searchFilter;
    $searchFilter = '%' . $searchFilter . '%';
    $stmt->bindParam(':searchFilter', $searchFilter, PDO::PARAM_STR);
    $stmt->bindParam(':catSearchFilter', $catSearchFilter, PDO::PARAM_STR);
}


// Bind the price range parameters if it's set
$stmt->bindParam(':minPrice', $minPrice, PDO::PARAM_INT);
$stmt->bindParam(':maxPrice', $maxPrice, PDO::PARAM_INT);


// Execute the query
$result = $stmt->execute();

// Check for errors
if (!$result) {
    die("Database query failed.");
}

// Fetch the results as an associative array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);



//$customerid = 13;   
// Retrieve basket items for the logged-in customer
$itemIDs = $db->prepare('SELECT b.product_id, p.product_name, p.price, b.quantity, p.colour, p.stock  
                        FROM basket b
                        JOIN productdetails p ON b.product_id = p.product_id
                        WHERE b.customer_id = ?');
$itemIDs->bindParam(1, $customerid);
$itemIDs->execute();
$items = $itemIDs->fetchAll(PDO::FETCH_ASSOC);

$itemsCount = count($items);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other desired page
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - SHADED</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="shortcut icon" href="images/Updatedfavicon.png" type="image/png">
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
            justify-content: space-between; 
            align-items: center;
            top: 0; left: 0; right: 0;
            box-shadow: 0 0 12px #1c7a7f;

            .navbar-nav {
                font-size: 15px;
                text-decoration: none;
                font-weight: bold;
            }

            /* Search Box */
            .search-box { 
                border: 3px solid #003b46; 
            }

            .navbar .search-btn {
                background-color: #003b46; 
                border: none; 
                transition: background-color 0.3s ease;
                margin-right: 5px;
            }

            .navbar .search-icon {
                color: #fff; 
                text-decoration: none; 
            }

            .navbar .search-btn:hover {
                background-color: #1c7a7f; 
            }

            /* Hide the dropdown arrow */
            .navbar-nav .nav-item.dropdown > .nav-link::after {
                display: none !important
            }

            .dropdown-item{
                color: #003B46;
                text-decoration: none;
                font-size: 15px;
                font-weight: bold;
                transition: background-color 0.3s;  
            }

            .dropdown-item:hover{
                color: #003B46;
                background-color: rgba(28, 122, 127, 0.4);
            }

            .navbar-nav .nav-item {
            margin-right: 8px; /* Adds margin between navbar items */
        }

            .navbar-nav .nav-item .nav-link {
            color: #003b46; 
            text-decoration: none; 
            transition: color 0.3s ease, border-bottom-color 0.3s ease; 
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #1c7a7f; 
            border-bottom: 4px solid #1c7a7f; 
        }
        }
    }
}

.logo img {
    max-width: 100%; 
    max-height: 50px; 
    margin-left: auto; 
}

.fas {
    font-size: 15px;
}

/* Shopping Bag Popup*/
.shopping-bag-popup {
    position: fixed;
    top: 80px;
    right: -400px; /* Initially hidden */
    width: 350px;
    max-height: 85vh; 
    overflow-y: auto; /* Enables vertical scrolling if needed */
    background-color: #fff;
    z-index: 1000;
    transition: right 0.3s ease;
    padding: 20px;
}

.shopping-bag-popup.show {
    right: 0; /* Slides in from the right */
}

.shopping-bag-product {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    position: relative;
}

.shopping-bag-product img {
    max-width: 120px; 
    height: auto; /* Maintains aspect ratio */
    margin-right: 20px; /* Adds spacing between the image and product details */
}

.product-details {
    flex: 1; /* Allows the product details to take up remaining space */
    margin-bottom: 50px;
}

.total-price {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px; /* Adds spacing between the products and total price */
}

.total-price .price-left {
    font-weight: bolder;
    font-size: 15px;
}

.total-price .price-right {
    font-size: 15px;
    font-weight: bold;
}

.shopping-bag-popup h4{
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 25px;
}

.shopping-bag-popup h5{
    font-size: 14px;
    font-weight: bold;
}

.shopping-bag-popup p{
    font-size: 13px;
    margin-bottom: 4px;
    font-weight: lighter;
}

.btn-primary {
    background-color: #003b46; /* Dark blue */
        color: #fff; /* White text */
        padding: 10px;
        margin-top: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 15px;
        transition: background-color 0.3s ease;
        font-weight: bold;
}

.btn-primary:hover {
    background-color: #07575b;
}

/*Sun Icon*/
#sun-icon {
    position: fixed; 
    top: 100px; /* Initial top position */
    right: 10px;
    font-size: 32px;
    color: yellow; 
    text-shadow: 0 0 10px black; 
    z-index: 900; /* Ensures it appears above the navbar */
    transition: top 0.1s ease, color 0.2s linear; /* Transition for smooth movement and color change */
}

/* CSS for dark mode */
.dark-mode {
    background-color: #000000; /*background color black */
    color: #ffffff; /*text color white */
}

#dark-mode-toggle:hover{
    background-color: #1c7a7f; /* Text color on hover */
            }

.dark-mode header {
    background-color: #000000; /*  navbar background color black */
}

/* Update sun/moon icon styles */
.dark-mode #dark-mode-toggle .fas {
    color: #ffffff; /* Changes color of moon icon to white */
}

#dark-mode-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #003b46;
    border: 3px solid #003b46;
    border-radius: 40%; /* Makes it circular */
    padding: 12px;
    z-index: 1000; /* Ensures it appears above other content */
}

#dark-mode-toggle .fas {
    color: #ffffff;
}

.dark-mode .shopping-bag-popup,
.dark-mode .dropdown-menu{
    background-color: #000000;
}

.dark-mode .dropdown-item:hover {
    background-color: rgba(28, 122, 127, 0.7);
}

.dark-mode .filter-container {
    background-color: #000;
    color: #ffffff;
}

.dark-mode .product-info,
.dark-mode .product-info h3{
    color: white !important;
}

main {
    margin-top: 90px; 
    margin-bottom: 350px;
}

.return-link {
    position: absolute;
    top: 90px; 
    left: 20px;
    font-size: 14px;
    font-weight: bold;
    color: #003b46; 
    text-decoration: none;
    z-index: 1000; /* Ensures it appears above other content */
}

.return-link i {
    margin-right: 5px; /* spacing between the icon and the text */
}

.return-link:hover {
    text-decoration: none;
    color: #1c7a7f;
}

@media (max-width: 640px) {
    .selection-title {
        margin-left: 60%;
    }
}

/* filter styles */
   /* Filter styles */
   .filter-container {
    width: 200px;
    padding: 20px;
    position: fixed;
    left: 20px;
    bottom: 175px;
    border-radius: 5px;
    z-index: 200;
    max-height: calc(100vh - 200px); 
    transition: top 0.3s ease; /* Adds smooth transition */
    box-shadow: 0 0 12px #1c7a7f;
    }

    .filter-title {
        font-size: 22px;
        margin-bottom: 15px;
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
    outline: none; /* Removes focus outline */
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
    margin-bottom: 0px;
    font-size: 14px;
    color: #003b46;
    font-weight: bold;
}

    .filter-button {
        background-color: #003b46; /* Dark blue */
        color: #fff; /* White text */
        padding: 5px;
        margin-top: 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        transition: background-color 0.3s ease;
        font-weight: bold;
    }

    .filter-button:hover {
        background-color: #07575B; /* Darker blue on hover */
    }

.filter-title {
    font-weight: bold; 
    font-size: 26px;
    margin-left: 8px; /* Moves title to the right */
    
}

/* Price container styles */


#price-slider {
    margin-top: 15px; 
    margin-bottom:15px; 
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

#products{
    margin-bottom: 30px;
}

/* position of the price range label and slider */
#price-container {
    position: relative; 
}

/* filter styles end here */

.selection-title {
    display: flex;
    justify-content: center;
    align-items: center;
}

.selection-title h2 {
    font-size: 40px;
    color: #003b46;
    font-weight: bold;
    margin-bottom: 45px;
    margin-right: 200px;
}


.container-fluid {
    flex: 1;
    margin-top: auto;
}

h3 {
   font-size: 18px;
   font-weight: bold;
   
}

h2 {
   font-size: 20px;
   margin: 10px 0;
    margin-left: 14px;
}

#main {
    margin-left: 220px;
}

.main-container {
    flex: 1;
}

.product-info {
        text-align: left; 
        color: black;
        text-decoration: none;   
    }

.product-info h3{
    color: black;
}

    .price {
        margin-top: 5px; /* margin between the product name and the price */
        text-align: left;
        
    }

    .product-container {
    width: 90%; 
    margin: auto; /* Centers the container */
    padding: 15px;
    
}
    
/* footer styles */
.footer {
    background-color: #003B46;
    color: #fff;
    padding: 20px 0; /* Adds padding to the top and bottom */
    bottom: 0; /* Sticks the footer to the bottom */
    width: 100%;
    position: relative;
}


.footer-col {
    width: 25%; /*width of each column */
    padding: 0 15px; /*horizontal padding */
    padding-left: 80px;/*left padding */
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

</head>
<body>
<!--bootstrap js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
     crossorigin="anonymous">
</script>


<header>

<a href="homepage.php" class="return-link"><i class="fas fa-arrow-left"></i> Return to Home</a>

        <!-- added bootstrap navbar utility classes -->
        <nav class="navbar navbar-expand-sm w-100">

            <!-- using container-fluid for responsiveness -->
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenuItems" aria-controls="navbarMenuItems" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="homepage.php" class="navbar-brand logo">
                    <img src="images/Logo.png" alt="Shaded Logo">
                </a>
                <div class="collapse navbar-collapse" id="navbarMenuItems">

                   <!-- navbar to the left of the search box -->
                   <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
                   <li class="nav-item">
                            <a class="nav-link" href="homepage.php">Home</a>
                        </li>
                    <li class="nav-item">
                            <a class="nav-link" href="shopping.php">Shop All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  onclick="filterCategory('male')">Men</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  onclick="filterCategory('female')">Women</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  onclick="filterCategory('unisex')">Unisex</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  onclick="filterCategory('futuristic')">Futuristic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  onclick="filterCategory('blue_light')">Blue Light</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="aboutUs.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Contactus.php">Contact Us</a>
                        </li>
                    </ul>

                    <!-- search box -->
                    <form class="d-flex" role="search" method="POST" action="shopping.php">
                        <input class="form-control me-2 search-box" type="search" placeholder="Search Products" aria-label="Search" id="mySearchInput" name="searchFilter">
                        <button class="btn btn-outline-bg search-btn" type="submit">
                            <i class="fas fa-search search-icon"></i>
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
                                <form method="post" action="">
    <button type="submit" name="logout" class="dropdown-item">Logout</button>
</form>

                            </ul>
                        </li>
                        <?php
                                if($_SESSION['authorization_level']==='admin'){
                                echo(' <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-lock"></i> <!-- Assuming a lock icon for log in/sign up -->
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="admin.php">Admin Homepage</a></li>
                                    <li><a class="dropdown-item" href="inventory.php">Inventory</a></li>
                                    <li><a class="dropdown-item" href="customerAccounts.php">Customer Accounts</a></li>
                                    <li><a class="dropdown-item" href="Admin-account-approval.php">Admin Approval</a></li>
                                    <li><a class="dropdown-item" href="adminAccounts.php">Admin Accounts</a></li>
                                    <li><a class="dropdown-item" href="orders.php">Orders</a></li>
                                </ul>
                            </li>');
                                };
                       ?>

                        <li class="nav-item">
                            <a class="nav-link" href="wishlist.php">
                                <i class="fas fa-heart"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="shopping-bag-icon">
        <i class="fas fa-shopping-bag"> <?= $itemsCount ?></i>
    </a>
    <div id="shopping-bag-popup" class="shopping-bag-popup">
        <h4>Your Selection (<?= $itemsCount ?>)</h4>

        <?php foreach ($items as $item) : ?>
            <div class="shopping-bag-product">
            <?php $imageFileName = "ImagesForProducts/" . $item['product_id'] . "_" . str_replace(' ', '_', $item['product_name']) . ".avif"; ?>
                <img src="<?= $imageFileName ?>" alt="Product Image" width="100%" height="60%">
                <div class="product-details">
                    <h5><?= $item['product_name'] ?></h5>
                    <p>Price: £<?= number_format($item['price'], 2) ?></p>
                    <p>Colour: <?= $item['colour'] ?></p>
                    <p>Quantity: <?= $item['quantity'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>

        <hr>
        <!-- Total Price -->
        <?php
        // Calculate total price
        $totalPrice = 0;
        foreach ($items as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        ?>
        <div class="total-price">
            <div class="price-left">Total Price:</div>
            <div class="price-right">£<?= number_format($totalPrice, 2) ?></div>
        </div>

        <div class="buttons">
            <a href="basket.php" class="btn btn-primary">VIEW SHOPPING BAG</a>
            <a href="checkout.php" class="btn btn-primary">PROCEED TO CHECKOUT</a>
        </div>
        <!-- <p>Your shopping bag is empty.</p> -->
    </div>
</li>

                </div>
            </div>
        </nav>
    </header>

    <div id="dark-mode-toggle">
        <a class="nav-link" href="#">
            <i class="fas fa-lightbulb"></i>
        </a>
    </div>


    <main>
    <div id="main">
        
    <div class="main-container">

    <div id="sun-icon">&#9728;</div>

        <!-- main page title -->
        <div class="selection-title">
        <h2>SHOP OUR SELECTION</h2>
</div>

<div class="filter-container">
    <h3 class="filter-title">FILTER</h3>

    <!-- Category filter -->
    <form method="post" class="filter-option" action="" id="filterForm">
    <label for="categoryFilter">Category:</label>
    <select name="categoryFilter" id="categoryFilter">
        <option value="all">All</option>
        <option value="male">Mens</option>
        <option value="female">Womens</option>
        <option value="unisex">Unisex</option>
        <option value="futuristic">Futuristic</option>
        <option value="blue_light">Bluelight</option>
    </select>

    <!-- Colour filter -->
    <label for="colorSelect">Colour:</label>
    <select name="colorSelect" id="colorSelect">
        <option value="all">All Colours</option>
        <option value="black">Black</option>
        <option value="white">White</option>
        <option value="yellow">Yellow</option>
        <option value="brown">Brown</option>
        <option value="green">Green</option>
    </select>

    <!-- Price filter -->
    <div class="filter-option">
        <label for="priceRange">Price Range:</label>
        <div id="price-slider">
            <input type="text" id="priceRange" readonly style="color:#003b46; font-weight:bold;">
            <!-- Change the name attribute to "priceRange[]" to submit as an array -->
            <input type="hidden" id="priceRangeHidden" name="priceRange[]" value="20-1000">
        </div>
    </div>

    <!-- Apply filter button -->
    <button class="filter-button" type="submit">SUBMIT</button>
</form>
</div>



</div>


    <div class="product-container">
    <div class="row">
        <!-- Loop through each product and display buttons -->
        <?php foreach ($products as $product) : ?>
            <div id="products" class="col-sm-6 col-md-4 col-lg-3">
            <a href="javascript:void(0);" onclick="buyProduct(<?= $product['product_id'] ?>);"style="text-decoration: none; color: black; ">
            <?php $imageFileName = "ImagesForProducts/" . $product['product_id'] . "_" . str_replace(' ', '_', $product['product_name']) . ".avif"; ?>
    <img src="<?= $imageFileName ?>" alt="Product Image" width="100%" height="60%">
                </a>
                <div class="product-info">
                <a href="javascript:void(0);" onclick="buyProduct(<?= $product['product_id'] ?>);"style="text-decoration: none; color: black; ">
                <h3><?= $product['product_name'] ?></h3>
                </a>
                <p class="price"> £<?= $product['price'] ?></p>
                <p><?= $product['stock'] ?> stock left</p>
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
             <li><a href="TermsandConditions.php">Terms & Conditions </a></li>
             <li><a href="Policy.php">Privacy and Cookies Policy</a></li>
             
             </ul>
     </div>
     <!-- first column -->
     <div class="footer-col">
            <h4>References</h4>
            <ul>
            <li><a href="References For Products.txt"  target="_blank" >Sunglasses Products</a></li>
            <li><a href="Home & Login Media References.txt" target="_blank" >Homepage References </a></li>
            <li><a href="Home & Login Media References.txt"  target="_blank" >Login/Signup References</a></li>
            
            </ul>
    </div>
     <!-- second column -->
    <div class="footer-col">
            <h4>Need Help?</h4>
            <ul>
                <li><a href="aboutUs.php">About Us</a></li>
                <li><a href="Contactus.php">Contact Us</a></li>
                <li><a href="FAQs.php">FAQs</a></li>
                
            </ul>
    </div>
    <!-- third column -->
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
document.addEventListener('DOMContentLoaded', function () {
    // Function to handle product click
    function buyProduct(productId) {
    document.getElementById('selectedProductId').value = productId;
    document.forms[0].submit(); // Change the form index accordingly
}

});

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

    // color of the sun icon
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

    $(function() {
        // Initialize price range slider
        $("#price-slider").slider({
            range: true,
            min: 20,
            max: 1000,
            values: [20, 1000],
            slide: function(event, ui) {
                $("#priceRange").val(ui.values[0] + "-" + ui.values[1]); // Update the value of priceRange input
                $("#priceRangeHidden").val(ui.values[0] + "-" + ui.values[1]); // Update the hidden input
            }
        });

        // Initialize priceRange input value
        var sliderValues = $("#price-slider").slider("values");
        $("#priceRange").val(sliderValues[0] + "-" + sliderValues[1]);

        // Update JavaScript variable when the input field is changed directly
        $("#priceRange").change(function() {
            var range = $(this).val().split("-");
            $("#price-slider").slider("values", [parseInt(range[0]), parseInt(range[1])]);
            $("#priceRangeHidden").val($(this).val()); // Update the hidden input
        });
    });

    // Function to handle product click
    function buyProduct(productId) {
        document.getElementById('selectedProductId').value = productId;
        document.getElementById('buyForm').submit();
    }

    
    function filterCategory(category) {
        // Create a form element dynamically
        var form = document.createElement('form');
        form.method = 'post';
        form.action = 'shopping.php'; 
        
        // Create an input element to hold the category filter value
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'categoryFilter';
        input.value = category;
        
        // Append the input element to the forms
        form.appendChild(input);
        
        // Append the form to the document body and submit it
        document.body.appendChild(form);
        form.submit();
    }

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
