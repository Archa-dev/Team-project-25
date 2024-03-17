<?php
require_once('connectdb.php');
session_start();

if (isset($_SESSION['customer_id'])) {
    $customerid = $_SESSION['customer_id'];
}

// Retrieve basket items for the logged-in customer
$itemIDs = $db->prepare('SELECT b.product_id, p.product_name, p.price, b.quantity, p.colour
                        FROM basket b
                        JOIN productdetails p ON b.product_id = p.product_id
                        WHERE b.customer_id = ?');
$itemIDs->bindParam(1, $customerid);
$itemIDs->execute();
$bitems = $itemIDs->fetchAll(PDO::FETCH_ASSOC);
    
    $itemsCount = count($bitems);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
        // Destroy the session
        session_destroy();
    
        // Redirect to the login page or any other desired page
        header('Location: login.php');
        exit;
    }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the selectedProductId is set
    if (isset($_POST["selectedProductId"])) {
        // Retrieve the value and sanitize as an integer
        $integerValue = intval($_POST["selectedProductId"]);

        // Fetch product details from the database
        $items = $db->prepare("SELECT * FROM `productdetails` WHERE `product_id` = ?;");
        $items->bindParam(1, $integerValue);
        $items->execute();
        $item = $items->fetch(PDO::FETCH_ASSOC);
    }

    // Check if the addToBasket button is clicked
    if (isset($_POST["addToBasket"])) {
        if ($customerid !== null) {
            // Check for duplicate entry
            $checkDuplicate = $db->prepare("SELECT COUNT(*) FROM `basket` WHERE `customer_id` = ? AND `product_id` = ?;");
            $checkDuplicate->bindParam(1, $customerid);
            $checkDuplicate->bindParam(2, $integerValue);
            $checkDuplicate->execute();
            $count = $checkDuplicate->fetchColumn();

            // If no duplicate, proceed with insertion
            if ($count == 0) {
                $addToBasket = $db->prepare("INSERT INTO `basket` (`customer_id`, `product_id`,`quantity`) VALUES (?, ?,1);");
                $addToBasket->bindParam(1, $customerid);
                $addToBasket->bindParam(2, $integerValue);

                // Execute the SQL query to insert the product into the basket
                $addToBasket->execute();
            } else {
                $updateQuantity = $db->prepare("UPDATE `basket` SET `quantity` = `quantity` + 1 WHERE `customer_id` = ? AND `product_id` = ?");
                $updateQuantity->bindParam(1, $customerid);
                $updateQuantity->bindParam(2, $integerValue);
                $updateQuantity->execute();
            }
        } else {
            header("Location: login.php");
            exit();
        }
    }
}
else {
    header("Location: shopping.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <!--bootstrap css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="updatedFavicon.png" type="image/png">
    
    <title>Item - SHADED</title>
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
            margin-right: 8px; /* Add margin between navbar items */
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

/* Shopping Bag Popuop*/
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
        margin-top: 30px;
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
    color: yellow; /* Initial color of the sun icon */
    text-shadow: 0 0 10px black;
    z-index: 900; /* Ensures it appears above the navbar */
    transition: top 0.1s ease, color 0.2s linear; /* Transition for smooth movement and color change */
}

/* CSS for dark mode */
.dark-mode {
    background-color: #000000; /* background color black */
    color: #ffffff; /*text color white */
}

#dark-mode-toggle:hover{
    background-color: #1c7a7f; /* Text color on hover */
            }

.dark-mode header {
    background-color: #000000; /* navbar background color black */
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

.dark-mode #column img{
    box-shadow: 0 0 12px #1c7a7f !important;
}

.dark-mode #review-form-popup{
    background-color: #000000;
}

.dark-mode #review-form-popup label{
    color: #fff;
}

.return-link {
    position: absolute;
margin-bottom: 280px;
margin-left: 10px;
    font-size: 14px;
    font-weight: bold;
    color: #003b46; 
    text-decoration: none;
    z-index: 1000; /* Ensures it appears above other content */
}

.return-link i {
    margin-right: 5px; 
}

.return-link:hover {
    text-decoration: none;
    color: #1c7a7f;
}

main {
    margin-top: 90px; 
    margin-bottom: 150px;
}
    
    #main {
    display: flex;
    flex-direction: column;
    align-items: center; 
    margin-top: 11vh;
    flex-wrap: wrap;
    }

    #boxes {
    max-width: 800px; 
    width: 100%;
    padding: 20px;
}

        #column {
         position: absolute;
         left: 0;
    top: 0;
    width: 45%;
    float: left;
    flex: 1 0 100%;
           
        }

        

        #column img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover; 
            margin-top: 180px;
            margin-left: 20px;
           
        }

        #product-info {
            flex: 0 0 45%; /* width of the right column */
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 60px;
            
        }

        #product-info h3{
            margin-bottom: 10px;
            font-size: 32px;
         padding-left: 60px;
         font-weight: bold;
        
        }

        #product-info h4 {
            margin-bottom: 20px;
            font-size: 28px;
         padding-left: 60px;
        }

        #product-info-container {
    width: 50%;
    float: right;
    margin-top: 20px;
    flex: 1 0 100%;
   
}

#product-info h5 {
    margin-bottom: 5px;
    font-size: 16px; 
    padding-left: 60px;
    font-weight: bold;
}

@media (min-width: 768px) {
  #main {
    flex-wrap: nowrap;
  }

  #column,
  #product-info-container {
    flex: 1 0 45%;
  }
}

@media (min-width: 992px) {
  #main {
    flex-wrap: nowrap;
  }

  #column,
  #product-info-container {
    flex: 1 0 45%;
  }
}

@media (min-width: 1200px) {
  #main {
    flex-wrap: nowrap;
  }

  #column,
  #product-info-container {
    flex: 1 0 45%;
  }
}


.add-to-wishlist-button {
    position: absolute;
    top: 40%;
    right: 1px;
    transform: translateY(-50%);
    background-color: transparent;
    border:#000000;
    cursor: pointer;
    z-index: 999; /* Ensures the button appears above the image */
}

.add-to-wishlist-button i {
    color: #07575b;
    font-size: 30px;
}

.add-to-wishlist-button i:hover {
    color: #003b46; /* Changes the heart color on hover */
}

    .add-to-basket-button {
    background-color: #003b46;
    border: none;
    color: #fff;
    padding: 5px 215px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    font-weight: bold;
    margin: 80px 0;
    margin-left: 55px;
    cursor: pointer;
    border-radius: 5px;
    white-space: nowrap;
        }

        .add-to-basket-button:hover {
    background-color: #07575b;
}

#leave-review-btn {
    margin-left: 550px;
  margin-top: -80px;
  color: #003b46;
  border: none;
  padding: 5px 30px;
  background-color: #ffffff;
  text-decoration: none;
  transition: text-decoration 0.2s;
  white-space: nowrap;
  border-radius: 5px;
  font-weight: bold;
}

#leave-review-btn:hover {
  text-decoration: underline;
  color: #1c7a7f;
}


#review-form-popup {
    position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #ffffff;
  padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 12px #1c7a7f;
  z-index: 1000;
  height: auto;
  width: 450px;
}

#review-form-popup h2{
    font-size: 30px;
    color: #003b46;
    font-weight: bold;
    text-align: center;
}

#review-form {
    margin: 0 auto;
  max-width: 500px;
}

#close-review-form-btn{
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}

#review-form label {
  display: block;
  font-weight: bold;
    color: #000000;
}

#review-form .form-actions {
  text-align: right;
}

#review-form .form-actions button {
  margin-top: 20px;
}

.form-group {
  margin-bottom: 20px;
}

.form-group textarea {
  resize: vertical;
}

.star-rating {
  font-size: 40px;
  margin-bottom: 20px;
}

.star-rating i {
  color: #cccccc;
  transition: color 0.2s;
}

.star-rating i:hover {
  color: #ffcc00;
}


.review-container {
  margin-top: 30px;
  text-align: left;
  margin-left: 20px;
  max-width: 100%;
}

.review-container h2 {
  margin-bottom: 20px;
  font-weight: bold;
  color: #003B46;
  font-size: 24px;
}

.review-container h3 {
 
  font-weight: bold;
  color: #003B46;
  font-size: 18px;
}

.review-container p{
  margin-bottom: 10px;
  color: #000000;
  font-size: 16px;
}

.checked {
  color: gold;
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
    width: 25%; /* width of each column */
    padding: 0 15px; /* horizontal padding */
    padding-left: 80px;/* left padding */
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



        <!-- added bootstrap navbar utility classes -->
        <nav class="navbar navbar-expand-sm w-100">

            <!-- using container-fluid for responsiveness -->
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenuItems" aria-controls="navbarMenuItems" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="homepage.php" class="navbar-brand logo">
                    <img src="logo.png" alt="Shaded Logo">
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
                        <li class="nav-item">
                            <a class="nav-link" href="reviews.php">Reviews</a>
                        </li>
                    </ul>

                    <!-- search box -->
                    <form class="d-flex" role="search">
                        <input class="form-control me-2 search-box" type="search" placeholder="Search" aria-label="Search" id="mySearchInput">
                        <button class="btn btn-outline-bg search-btn" type="submit">
                            <a href="#" class="search-icon">
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
                                <form method="post" action="">
    <button type="submit" name="logout" class="dropdown-item">Logout</button>
</form>

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

        <?php foreach ($bitems as $bitem) : ?>
            <div class="shopping-bag-product">
                <img src="images/MK-2161BU-0001_1.jpeg" alt="<?= $bitem['product_name'] ?>">
                <div class="product-details">
                    <h5><?= $bitem['product_name'] ?></h5>
                    <p>Price: £<?= number_format($bitem['price'], 2) ?></p>
                    <p>Colour: <?= $bitem['colour'] ?></p>
                    <p>Quantity: <?= $bitem['quantity'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>

        <hr>
        <!-- Total Price -->
        <?php
        // Calculate total price
        $totalPrice = 0;
        foreach ($bitems as $bitem) {
            $totalPrice += $bitem['price'] * $bitem['quantity'];
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

<!-- Light/dark mode-->
    <div id="dark-mode-toggle">
        <a class="nav-link" href="#">
            <i class="fas fa-lightbulb"></i>
        </a>
    </div>

    <main>

    <div id="sun-icon">&#9728;</div>

        <div id="main">
            <div id="boxes">
                <div id="row">
                    <div id="column" style="display: flex; align-items: center;" >
                    <a href="shopping.php" class="return-link"><i class="fas fa-arrow-left"></i> Return to Shop</a>
                        <img src="Images for products\Mens Black1.1.avif" alt="Product Image" style="width: 100%; height: auto;">
                        <button id="add-to-wishlist-btn" class="add-to-wishlist-button">
        <i class="far fa-heart"></i>
    </button>
                    </div>
                    <div id="product-info-container" style="width: 60%; float: right;">
                    <div id="product-info">
                        <h3 style><?= $item['product_name'] ?></h3>
                        <h4 >£<?= $item['price'] ?></h4>

                        <!-- placeholder headers -->
    <h5 style="margin-top: 30px;">Colour: BLACK</h5>
    <h5 style="margin-top: 10px;">Size: ONE SIZE</h5>
                        <!-- Add your product name and price elements here -->
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <!-- Add your product ID input or any other necessary fields here -->
                            <input type="hidden" name="selectedProductId" value="<?= $integerValue ?>">
                            <!-- Button to trigger the SQL query -->
                            <button type="submit" name="addToBasket" class="add-to-basket-button">ADD TO SHOPPING BAG</button>
                        </form>

                        <button id="leave-review-btn" class="review-button">Leave a Review</button>
                    </div>
                </div>
            </div>
        </div>
        </div>



 
<div id="review-display" class="review-container">
    <h2>REVIEWS FOR THIS PRODUCT</h2>
 <?php
// displays reviews from the database
$reviews = $db->prepare("SELECT * FROM `productreviews` WHERE `product_id` = ?;");
$reviews->bindParam(1, $integerValue);
$reviews->execute();
$reviews = $reviews->fetchAll(PDO::FETCH_ASSOC);
foreach ($reviews as $review) {
    $customerName = $db->prepare("SELECT `name` FROM `customerdetails` WHERE `customer_id` = ?;");
    $customerName->bindParam(1, $review['user_id']);
    $customerName->execute();
    $customerName = $customerName->fetch(PDO::FETCH_ASSOC);
    $starNumber = $review['star_rating'];
    echo "<h3> REVIEW BY:" . $customerName['name'] . "</h4>";            // this is how individual reviews are displayed, this is what needs to be changed for the formatting, although it may be easier to encapsulate this area in a div and use css only
    echo "<h3> RATING:  ". str_repeat('<span class="fa fa-star checked"></span>',$starNumber) . "</h4>";
    echo "<p>" . $review['review_text'] . "</p>";
}
?> 
</div>
        
        





<div id="review-form-popup" style="display: none;">
  <span id="close-review-form-btn" onclick="review-form-popup()">&times;</span>
 <h2>REVIEW</h2>
 <form id="review-form">
  <div class="form-group">
    <label for="star-rating">Star Rating:</label>
    <div class="star-rating">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
    </div>
 
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" class="form-control" required>
  
    <label for="review">Review:</label>
    <textarea id="review" name="review" class="form-control" rows="3" required></textarea>

    <button type="submit" class="btn btn-primary">SUBMIT REVIEW</button>

  </div> 
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
    document.getElementById("leave-review-btn").addEventListener("click", function() {
//  document.getElementById("review-form-popup").style.display = "block";
    var currentProduct = "<?= $item['product_name'] ?>";
    window.location.href = "reviewPage.php?fromProduct=" + currentProduct;
});

document.getElementById("review-form").addEventListener("submit", function(event) {
  event.preventDefault();
  // Handle form submission here
});

document.getElementById('close-review-form-btn').addEventListener('click', function() {
  document.getElementById('review-form-popup').style.display = 'none';
});

document.getElementById("add-to-wishlist-btn").addEventListener("click", function() {
    var heartIcon = this.querySelector("i");
    heartIcon.classList.toggle("far"); // Toggle regular heart icon class
    heartIcon.classList.toggle("fas"); // Toggle solid heart icon class
    
});
</script>


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
</script>

<script>
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
        
        // Append the input element to the form
        form.appendChild(input);
        
        // Append the form to the document body and submit it
        document.body.appendChild(form);
        form.submit();
    }


    
    </script>

</body>
</html>