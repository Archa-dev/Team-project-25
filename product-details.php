<?php
require_once('connectdb.php');
session_start();
if(isset($_SESSION['customer_id'])) {
$customerid = $_SESSION['customer_id'];}

//$customerid = 13;   
// Retrieve basket items for the logged-in customer
$itemIDs = $db->prepare('SELECT b.product_id, p.product_name, p.price, b.quantity, p.colour
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
   
    <!--bootstrap css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/Updatedfavicon.png" type="image/png">


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
            margin-right: 8px;
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
    margin-right: 20px; /*spacing between the image and product details */
}

.product-details {
    flex: 1; /* Allows the product details to take up remaining space */
    margin-bottom: 50px;
}

.total-price {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px; 
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
    background-color: #000000; /*navbar background color black */
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

.dark-mode .product-details,
.dark-mode .product-details2,
.dark-mode #returnForm{
    box-shadow: 0 0 12px #1c7a7f;
    background-color: #000000;
}

.dark-mode .product-information h5, 
.dark-mode .product-information p,
.dark-mode .return-section b{
  color: #fff;
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
    margin-right: 5px; 
}

.return-link:hover {
    text-decoration: none;
    color: #1c7a7f;
}

main {
    margin-top: 90px; 
    margin-bottom: 200px;
}
    /* product-details.html styling */

    .main-content {
            position: relative;
            max-width: 100%;
            overflow: hidden;
            padding: 10px;
            margin-left: 30px;
            margin-right: 30px;
        }

.main-content h2{
    color: #003B46;
    font-weight: bold;
    text-align: center;
    font-size: 40px;
    margin-bottom: 40px;
}

.product-details2 {
  
    position: relative;
    max-width: 100%;
    background-color: #fff;
    color: #003B46;
    padding: 20px;
    box-shadow: 0 0 12px #1c7a7f;
    border-radius: 5px;
    display: flex;
    flex-direction: row;
    align-items: flex-end;
    position: relative;

}
.product-information {
  
  position: relative;
  max-width: 100%;
  margin: 50px auto;
  color: #003B46;
  padding: 20px;
  border-radius: 5px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
 
}

.product-price {
    margin-top: 5px; 
}
.product-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.product-item .product-details2 {
    flex-grow: 1;
}

.product h5{
    color: #003B46;
    font-weight: bold;
} 

.product-information {
   display: flex;
   flex-direction: column;
   margin-top: 20px;
   }

   .product-information h5{
  font-weight: bold;
   }

   .product-information h5, .product-information p{
  font-weight: bold;
  color: #000000;
   }

        .product img {
            width: 200px;
            height: auto;
            margin-right: 20px;
        }


        @media (max-width: 615px) {
    .product {
        height: 720px;
    }
}

@media (max-width: 610px) {
    .product-information{
        margin-top: 0px;
    }
}

.total-return-container {
    position: absolute;
    bottom: 10px;
    right: 10px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.return-section b{
font-weight: bold;
color: #000000;
}

#returnButton{
    width: 250px; 
    margin-top: 10px; 
    background: #003B46;
    color: #fff;
    height: 40px;
    border-radius: 5px;
    font-size: 20px;
font-weight: bold;
    border: 0;
    outline: 0;
    cursor: pointer;
    transition: background 1s;
}



#returnButton:hover {
  background-color: #07575B;
        background-color: #07575B;
        color: #fff;
}

    /* Return Form Styles */
    #returnForm {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 12px #1c7a7f;
        z-index: 1000;
        max-width: 500px; 
        width: 90%; 
    }

    #returnForm h3 {
        margin-bottom: 30px;
        color: #003B46;
        font-size: 24px;
        font-weight: bold;
    }

    #returnForm label {
        color: #003B46;
        font-size: 18px; 
        font-weight: bold;
    }

    #returnForm input[type="text"],
    #returnForm select {
        width: calc(100% - 20px); 
        padding: 15px;
        margin-bottom: 20px; 
        border: 1px solid #ccc;
        border-radius: 8px; 
        box-sizing: border-box;
        font-size: 16px;
    }

    #returnForm button[type="submit"]{
        width: 100%; 
        margin-top: 20px; 
        background-color: #003B46;
        color: #fff;
        padding: 15px; 
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 18px;
        font-weight: bold;
    }

    #returnForm button[type="submit"]:hover{
        background-color: #07575B;
    }

    #closeButton {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #003B46;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 15px;
    font-weight: bold;
}

#closeButton:hover {
    background-color: #07575B;
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

    <title>Product Details -SHADED</title>
</head>
<body>

     <!--bootstrap js-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
     crossorigin="anonymous">
</script>

<header>

<a href="order-history.php" class="return-link"><i class="fas fa-arrow-left"></i> Return to My Orders</a>
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

    <div id="sun-icon">&#9728;</div>

    <div class="main-content">
    <h2>PRODUCT DETAILS</h2>
    <?php
    // retrieve order details
    $orderID = $_GET['id']; 
    $orderDetails = $db->prepare('SELECT * FROM previousorders WHERE order_id = ?');
    $orderDetails->bindParam(1, $orderID);
    $orderDetails->execute();
    $order = $orderDetails->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <div class="product-details2">
            <div class="product">
                <?php echo"<h5>ORDER #".$orderID."</h5>" ?>
                <div class="product-info">
                    <!-- Product 1 -->
                    <div class="product-item">
                        <div class="product-information">
                            <?php
                            $getProductName = $db->prepare('SELECT * FROM productdetails WHERE product_id = ?');
                            $getProductName->bindParam(1, $order['product_id']);
                            $getProductName->execute();
                            $productDetails = $getProductName->fetch(PDO::FETCH_ASSOC); 
                            echo"<h5>". $productDetails['product_name'] ."</h5>";
                            echo "<p>£" . $productDetails['price'] . "</p>"; ?>
                        </div>
                    </div>
                </div>
                <!-- Total and status of order -->
                <div class="product-info total-return-container">
                  
                    <div class="return-section">
                    <?php 
                        $totalPrice = $productDetails['price']*$order['quantity'];
                        echo"<p><b>Total: £".$totalPrice."</b></p>";
                    ?>
                        <p><b>STATUS OF ORDER: PROCESSED</b></p>
                        <button id="returnButton">RETURN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Return Form -->
<div id="returnForm" style="display: none;">
    <div>
    <button id="closeButton">CLOSE</button>
        <h3>RETURN ITEMS</h3>
     
        <form id="returnItemsForm">
            <label for="reason">Reason for Return:</label><br>
            <select id="reason" name="reason">
            <option value="too_big_or_too_small">Too big or too small</option>
        <option value="quality_not_as_expected">Quality not as expected</option>
        <option value="missing_items">Missing items</option>
        <option value="no_longer_needed">No longer needed</option>
        <option value="wrong_items_received">Wrong items received</option>
        </select><br><br>
            <button type="submit">SUBMIT RETURN</button>
        </form>
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
   document.addEventListener("DOMContentLoaded", function() {
        var statusOfOrder = "DELIVERED"; // Replace this with the actual status of the order

        var returnButton = document.getElementById('returnButton');
        var returnForm = document.getElementById('returnForm');
        var closeButton = document.getElementById('closeButton');
        var returnItemsForm = document.getElementById('returnItemsForm');

        // Set initial button text based on the status of the order
        if (statusOfOrder === "PROCESSING") {
            returnButton.innerText = "CANCEL";
        } else {
            returnButton.innerText = "RETURN";
        }

        // Add event listener to the return button
        returnButton.addEventListener('click', function() {
            if (statusOfOrder === "PROCESSING") {
                // Perform cancel action
                alert("Your order has been cancelled!");
            } else {
                // Display return form
                returnForm.style.display = "block";
            }
        });

        // Add event listener to close button of the return form
        closeButton.addEventListener('click', function() {
            returnForm.style.display = "none";
        });

        // Add event listener to handle form submission
        returnItemsForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // get reason for return
            var reason = returnItemsForm.reason.value;
            let orderID = <?php echo $orderID; ?>;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'returnScript.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('orderid=' + orderID + '&reason=' + reason);
            xhr.addEventListener('readystatechange', function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                    } else {
                        console.log('Error: ' + xhr.status);
                    }
                }
            });

            // Display a confirmation message
            alert("Your return has been submitted. Please check your email for return options.");


               // Hide the return form
               returnForm.style.display = "none";
        });
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

    // color of the sun icon
    sunIcon.style.color = 'rgb(' + red + ', ' + green + ', ' + blue + ')';
});

// Set initial position of the sun icon below the navbar
window.addEventListener('DOMContentLoaded', function() {
    var sunIcon = document.getElementById('sun-icon');
    var navbarHeight = document.querySelector('header').offsetHeight;
    sunIcon.style.top = navbarHeight + 'px';
});
</script>

<script>
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
