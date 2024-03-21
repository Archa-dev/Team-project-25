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


// retrieve customer details
$customerDetails = $db->prepare('SELECT * FROM customerdetails WHERE customer_id = ?');
$customerDetails->bindParam(1, $customerid);
$customerDetails->execute();
$customer = $customerDetails->fetch(PDO::FETCH_ASSOC);
$customerLoginDetails = $db->prepare('SELECT * FROM logindetails WHERE user_id = ?');
$customerLoginDetails->bindParam(1, $customer['user_id']);
$customerLoginDetails->execute();
$customerLogin = $customerLoginDetails->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Account - SHADED</title>

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
    margin-left: auto; /* Centers the logo horizontally */
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
    max-height: 85vh; /* Limits the maximum height to 80% of the viewport height */
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
    color: yellow; /* Initial color of the sun icon */
    text-shadow: 0 0 10px black; 
    z-index: 900; /* Ensures it appears above the navbar */
    transition: top 0.1s ease, color 0.2s linear; /* Transition for smooth movement and color change */
}

/* CSS for dark mode */
.dark-mode {
    background-color: #000000; /* background color black */
    color: #ffffff; /* text color white */
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

.dark-mode .sidebar{
    background-color: #000000;
    box-shadow: 0 0 12px #1c7a7f;
}

.dark-mode .sidebar .nav-link {
    color: #003B46;
}

.dark-mode .sidebar .nav-link:hover {
    background-color: rgba(28, 122, 127, 0.7);
    color: #003B46;
}

.dark-mode .sidebar .nav-link.active {
    background-color: rgba(28, 122, 127, 0.9);
}

.dark-mode #editProfileModal{
    background-color: #000000;
}
.dark-mode #editProfileModal label{
    color: #fff;
}

/* Welcome Section Styles */
.welcome-section {
    padding: 20px;
    padding-top: 30px;
    padding-bottom: 30px;
    background-color: #003B46; 
}

.welcome-section h2 {
    font-size: 20px;
    color: #fff;
}

/* Sidebar Styles */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 300px;
    height: 100%;
    padding-top: 77px;
    background-color: #f8f9fa;
    box-shadow: 0 0 12px #1c7a7f;
}

.sidebar ul {
    list-style: none;
    padding-left: 0;
}

.sidebar .nav-link {
    padding: 18px 25px;
    text-decoration: none;
    color: #003B46;
    font-size: 15px; 
    font-weight: bold;
    transition: background-color 0.3s;
    display: block;
}

.sidebar .nav-link:hover {
    background-color: rgba(28, 122, 127, 0.4);
}

main{
    margin-top: 90px;
}

.main-content {
    margin-left: 350px; 
    margin-right: 50px;
    margin-bottom: 80px;
}

/* Additional Styling for Active Link */
.sidebar .nav-link.active {
    background-color: rgba(28, 122, 127, 0.7); 
    color: #003B46;
    position: relative;
}

.sidebar .nav-link.active::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 10px; /* width of the vertical line  */
    background-color: #003B46; 
}

/* Form Styles */
.error {
    color: #ff0000;
    font-size: 0.8em;
    margin-top: 5px;
}

section {
    background-color: #ffffff;
    padding: 40px 0;
}

.profile-container {
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    max-width: 100%;
    margin: 50px;
}

.profile-details {
    max-width: 100%;
}

.profile-details label {
    font-weight: bold;
}

.profile-details h2{
    font-size: 40px;
    color: #003b46;
    font-weight: bold;
    text-align: center;
    margin-bottom: 70px;
}

.profile-details h3{
    font-size: 22px;
    color: #003b46;
    font-weight: bold;
    text-align: left;
    margin-bottom: 20px;
}


.edit{
    align-items: center;
    max-width: 150px;
    font-weight: bold;
}

/* Profile Form Styles */
#editProfileForm {
    max-width: 800px;
    margin: 0 auto;
    text-align: left;
}

#editProfileModal h2{
    font-size: 30px;
    color: #003b46;
    font-weight: bold;
    text-align: center;
}

#editProfileForm label {
    display: block;
    font-weight: bold;
    color: #000000;
}

#editProfileForm textarea {
    resize: vertical;
}

#editProfileModal {
    display: none;
    position: fixed;
    top: 70px;
    left: 50%;
    transform: translate(-50%, 0%);
    z-index: 1000;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 12px #1c7a7f;
    width: 80%;
    max-height: calc(100% - 70px);
    overflow-y: auto;
}

.modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}

.edit-modal {
    display: none;
    max-width: 50%;
    padding: 20px 40px;
    background-color: #fff;
    border-radius: 5px;
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
    padding: 0 15px; /*horizontal padding */
    padding-left: 80px; /*left padding */
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

    <!-- Header -->
    <header>
        <!-- added bootstrap navbar utility classes -->
        <nav class="navbar navbar-expand-sm w-100">

            <!-- using container-fluid for responsiveness -->
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenuItems" aria-controls="navbarMenuItems" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="homepage.php" class="navbar-brand logo">
                    <img src="images/logo.png" alt="Shaded Logo">
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
                        <input class="form-control me-2 search-box" type="search" placeholder="Search" aria-label="Search" id="mySearchInput" name="searchFilter">
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
                <img src="images/MK-2161BU-0001_1.jpeg" alt="<?= $item['product_name'] ?>">
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

    <!-- Profile Section -->
    <main class="main-content">

    <div id="sun-icon">&#9728;</div>
    
    <div class="container"> <!-- Bootstrap container -->

    <aside class="sidebar">
    <div class="welcome-section">
        <h2>Welcome to your personal area</h2>
     
    </div>
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="accountPage.php">
                My Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="order-history.php">
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

    <div class="profile-container">
    <div class="profile-details">
            <h2>MY PROFILE</h2>

<!-- Display Profile Details -->
            <div class="row">
            <div class="col-md-6">
            <h3>MY INFORMATION</h3>
            <?php
            if ($customer['name'] == null) {
                echo '<div class="mb-3">
                    <label for="firstName">First Name:</label>
                    <div id="firstNameDisplay">No name saved</div>
                </div>';
                echo '<div class="mb-3">
                    <label for="surname">Surname:</label>
                    <div id="surnameDisplay">No surname saved</div>
                </div>';
            } else {
                echo '<div class="mb-3">
                    <label for="firstName">First Name:</label>
                    <div id="firstNameDisplay">' . explode(' ',$customer['name'],2)[0] . '</div>
                </div>';            
                echo '<div class="mb-3">
                    <label for="surname">Surname:</label>
                    <div id="firstNameDisplay">' . explode(' ',$customer['name'],2)[1] . '</div>
                </div>';
            }
            if ($customerLogin['email'] == null) {
                echo '<div class="mb-3">
                    <label for="email">Your Email:</label>
                    <div id="emailDisplay">No email saved</div>
                </div>';
            } else {
                echo '<div class="mb-3">
                    <label for="email">Your Email:</label>
                    <div id="emailDisplay">' . $customerLogin['email'] . '</div>
                </div>';
            }
            ?>
        </div>

        <div class="col-md-6">
            <h3>MY ADDRESS</h3>
            <!-- <div class="mb-3">
                <label for="shippingAddress">Shipping Address:</label>
                <div id="shippingAddressDisplay">123 Shipping St, Cityville, State, 12345</div>
            </div>
            <div class="mb-3">
                <label for="billingAddress">Billing Address:</label>
                <div id="billingAddressDisplay">456 Billing St, Cityville, State, 67890</div>
            </div> -->
        <?php
        if ($customer['default_address'] == null) {
            echo '<div class="mb-3">
                <label for="shippingAddress">Shipping Address:</label>
                <div id="shippingAddressDisplay">No address saved</div>
            </div>';
            echo '<div class="mb-3">
                <label for="billingAddress">Billing Address:</label>
                <div id="billingAddressDisplay">No address saved</div>
            </div>';
        } else {
            echo '<div class="mb-3">
                <label for="shippingAddress">Shipping Address:</label>
                <div id="shippingAddressDisplay">' . $customer['default_address'] . '</div>
            </div>';
            echo '<div class="mb-3">
                <label for="billingAddress">Billing Address:</label>
                <div id="billingAddressDisplay">' . $customer['default_address'] . '</div>
            </div>';
        }
        ?>
            
            <!-- Payment Method -->
            <!-- <h3>PAYMENT METHOD</h3>
            <div class="mb-3">
                <div id="paymentMethodDisplay">Credit Card</div> Displays payment method here -->
            <!-- </div> -->

             <!-- Edit Profile Button -->
             <div class="edit" onclick="openEditProfileModal()">
            <button class="btn btn-primary">EDIT PROFILE</button>
            </div>
        </div>
     </div>
        </div>
    </div>
</main>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="edit-modal">
    <span class="modal-close" onclick="closeEditProfileModal()">&times;</span>
    <h2>EDIT PROFILE</h2>
    <form id="editProfileForm" onsubmit="saveChanges()">
    <div class="row">
            <div class="col-md-6 mb-3">
                <label for="editFirstName">First Name:</label>
                <input type="text" id="editFirstName" name="editFirstName" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="editSurname">Surname:</label>
                <input type="text" id="editSurname" name="editSurname" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="editEmail">Your Email:</label>
            <input type="email" id="editEmail" name="editEmail" class="form-control" required>
        </div>

        <div class="row">
<div class="col-md-6 mb-3">
    <label for="newPassword">New Password:</label>
    <input type="password" id="newPassword" name="newPassword" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
    <label for="confirmNewPassword">Confirm New Password:</label>
    <input type="password" id="confirmNewPassword" name="confirmNewPassword" class="form-control" required>
</div>
        </div>

        <!-- Fields for Shipping, Billing Address, and Payment Methods -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="editShippingAddress">Shipping Address:</label>
                <textarea class="form-control" id="editShippingAddress" name="editShippingAddress" required></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="editBillingAddress">Billing Address:</label>
                <textarea class="form-control" id="editBillingAddress" name="editBillingAddress" required></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
    </form>
</div>

    <!-- Footer -->
    <footer class="footer">
     <div class="container">
     <div class="row">
          <!-- First ccolumn-->
     <div class="footer-col">
             <h4>&copyShaded | All Rights Reserved</h4>
             <ul>
             <li><a href="TermsandConditions.php">Terms & Conditions </a></li>
             <li><a href="Policy.php">Privacy and Cookies Policy</a></li>
             
             </ul>
     </div>
      <!-- second ccolumn-->
     <div class="footer-col">
            <h4>References</h4>
            <ul>
            <li><a href="References For Products.txt"  target="_blank" >Sunglasses Products</a></li>
            <li><a href="Home & Login Media References.txt" target="_blank" >Homepage References </a></li>
            <li><a href="Home & Login Media References.txt"  target="_blank" >Login/Signup References</a></li>
            
            </ul>
    </div>
     <!-- Third ccolumn-->
    <div class="footer-col">
            <h4>Need Help?</h4>
            <ul>
                <li><a href="aboutUs.php">About Us</a></li>
                <li><a href="Contactus.php">Contact Us</a></li>
                <li><a href="FAQs.php">FAQs</a></li>
                
            </ul>
    </div>
     <!-- Fourth ccolumn-->
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

    <!-- Validation -->
    <script>
    function openEditProfileModal() {
        document.getElementById("editProfileModal").style.display = "block";
    }

    function closeEditProfileModal() {
        document.getElementById("editProfileModal").style.display = "none";
    }

    function saveChanges() {
        event.preventDefault();
        let firstNameInput = document.getElementById("editFirstName").value;
        let surnameInput = document.getElementById("editSurname").value;
        let emailInput = document.getElementById("editEmail").value;
        let newPasswordInput = document.getElementById("newPassword").value;
        let confirmNewPasswordInput = document.getElementById("confirmNewPassword").value;
        let shippingAddressInput = document.getElementById("editShippingAddress").value;
        let billingAddressInput = document.getElementById("editBillingAddress").value;
        
        let fullName = firstNameInput + " " + surnameInput;
        let address = shippingAddressInput;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'saveAccountDetails.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
        }
        }
        var changesMessage = "Changes saved successfully!\n\nNew Details:\nFirst Name: " + firstNameInput + "\nSurname: " + surnameInput +
        "\nEmail: " + emailInput + "\nShipping Address: " + shippingAddressInput +
        "\nBilling Address: " + billingAddressInput;
        xhr.send('accountName='+fullName+'&address='+address+'&email='+emailInput+'&newPassword='+newPasswordInput);


 // Update the displayed details with the edited values
    // document.getElementById("firstNameDisplay").innerText = firstNameInput;
    // document.getElementById("surnameDisplay").innerText = surnameInput;
    // document.getElementById("emailDisplay").innerText = emailInput;
    // document.getElementById("currentPasswordDisplay").innerText = newPasswordInput !== "" ? "*".repeat(newPasswordInput.length) : currentPasswordInput;
    // document.getElementById("phoneDisplay").innerText = phoneInput;
    // document.getElementById("shippingAddressDisplay").innerText = shippingAddressInput;
    // document.getElementById("billingAddressDisplay").innerText = billingAddressInput;
    // document.getElementById("paymentMethodDisplay").innerText = paymentMethodInput;

    alert(changesMessage);
    location.reload();
    // Close the modal after saving changes
    closeEditProfileModal();
    }
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
