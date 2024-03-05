<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout - SHADED</title>

        <!--bootstrap css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        
        <?php
session_start();
require_once('connectdb.php');


$customerid = $_SESSION['customer_id'];


$itemIDs=$db->prepare('SELECT product_id FROM basket WHERE customer_id = ?');
$itemIDs->bindParam(1, $customerid);
$itemIDs->execute();
$itemTitle=$db->prepare('SELECT product_name FROM productdetails WHERE product_id = ?');
$itemPrice=$db->prepare('SELECT price FROM productdetails WHERE product_id = ?');
$itemImage=$db->prepare('SELECT product_image FROM productdetails WHERE product_id = ?');


$itemsCount = $db->prepare('SELECT COUNT(*) FROM basket WHERE customer_id = ?');
$itemsCount->bindParam(1, $customerid);
$itemsCount->execute();
$itemsNum = $itemsCount->fetchColumn();

?>

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
            margin-right: 5px; /* Add margin between navbar items */
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

.return-link {
    position: absolute;
    top: 100px; /* Adjust this value based on your navbar height */
    left: 20px;
    font-size: 14px;
    font-weight: bold;
    color: #003b46; /* Adjust the color as needed */
    text-decoration: none;
    z-index: 1000; /* Ensure it appears above other content */
}

.return-link i {
    margin-right: 5px; /* Adjust the spacing between the icon and the text */
}

.return-link:hover {
    text-decoration: none;
    color: #1c7a7f;
}

.checkout-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

.checkout-heading {
    text-align: center;
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 40px;
    color: #003b46;
}

main {
            display: flex;
            justify-content: space-between;
            margin-top: 5vh;
            padding: 20px;
            margin-left: 25px;
            margin-right: 25px;
        }

        #shipping-details,
        #payment-details {
            width: 125%;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #shipping-details h2,
        #payment-details h2 {
            font-size: 18px;
            font-weight: bold;
            margin-left: 5px;
            color: #003b46;
        }

        input[type="text"],
input[type="date"],
input[type="password"] {
  width: 100%;
  background: #f8f9fa;
  border-radius: 3px;
  display: flex;
  align-items: center;
  padding: 6px 15px;
}

input[type="text"]::placeholder,
input[type="date"]::placeholder,
input[type="password"]::placeholder {
  color: #999; /* Placeholder text color */
}

input[type="text"]:focus,
input[type="date"]:focus,
input[type="password"]:focus {
  border: 2px solid #000; /* Border color on focus */
}

        #order-summary {
            width: 75%;
            padding: 20px;
            background-color: #f8f9fa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-left: 25%;
            height: auto;
        }

        .checkout-button {
            width: 100%;
            background-color: darkgrey;
            color: #fff;
            border: none;
            cursor: pointer;
            height: 10%;
            font-weight: bold;
            font-size: 20px;
        }

        .checkout-button:hover {
            background-color: grey;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .order-summary-heading {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #003b46;
        }

        .order-summary-product {
            margin-bottom: 15px;
            height: auto;
}

.order-summary-product img {
    max-width: 100%; /* Ensure the image doesn't exceed its container's width */
    max-height: 150px; 
    display: block; /* Remove any default inline styling */
}

        .total-price {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }
        
#order-summary hr{
    color: gray;
}

#order-summary span{
    color: #000;
}

        .btn-primary {
    Background-color: #003b46;
    border: none; /* Remove border */
    transition: background-color 0.3s ease;
    font-weight: bold;
}

.btn-primary:hover {
    background-color: #1c7a7f;
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

<a href="basket.php" class="return-link"><i class="fas fa-arrow-left"></i> Return to Shopping Bag</a>

        <!-- added bootstrap navbar utility classes -->
        <nav class="navbar navbar-expand-sm w-100">

            <!-- using container-fluid for responsiveness -->
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenuItems" aria-controls="navbarMenuItems" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="homepage.php" class="navbar-brand logo">
                    <img src="images/Logo 2.png" alt="Shaded Logo">
                </a>
                <div class="collapse navbar-collapse" id="navbarMenuItems">

                    <!-- navbar to the left of the search box -->
                    <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
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
                            Futuristic
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Futuristic Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Futuristic White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Futuristic Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Futuristic Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Futuristic Green Sunglasses</a></li>
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
                        <li class="nav-item">
                            <a class="nav-link" href="Contactus.php">Contact Us</a>
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
                                <i class="fas fa-shopping-bag"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="basket.php">View Shopping Basket</a></li>
                            </ul>
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

    <main class="checkout-container">
    <h1 class="checkout-heading">CHECKOUT</h1>
    <div id="sun-icon">&#9728;</div>
    <div class="container">
    <div class="row">
    <div class="col-12 col-md-6 mb-4">
        <div id="shipping-details">
            <h2>Shipping Details</h2>
            <form>
                <div class="row">
        <div class="col-md-6 mb-3">
            <input type="text" class="form-control" placeholder="First Name" id="firstName">
        </div>
        <div class="col-md-6 mb-3">
            <input type="text" class="form-control" placeholder="Surname" id="surname">
        </div>
                </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Phone Number" id="phoneNumber">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Address Line" id="addressLine">
        </div>
        <div class="row">
        <div class="col-md-6 mb-3">
            <input type="text" class="form-control" placeholder="Postcode" id="postcode">
        </div>
        <div class="col-md-6 mb-3">
            <input type="text" class="form-control" placeholder="City" id="city">
        </div>
        </div>
        <button type="button" onclick="validateShipping()" class="btn btn-primary mt-3">CONFIRM</button>
    </form>
            <p class="error-message" id="shipping-error"></p>
        </div>

        <div id="payment-details" class="mt-4">
            <h2>Payment Details</h2>
            <form>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="16 Digit Card Number" id="cardNumber">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Expiry Date" id="expiryDate" onfocus="(this.type='date')">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Security Number" id="securityNumber">
        </div>
        <button type="button" onclick="validatePayment()" class="btn btn-primary mt-3">CONFIRM</button>
    </form>
            <p class="error-message" id="payment-error"></p>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="row">
            <div class="col-12">
                <div id="order-summary">
                    <h2 class="order-summary-heading">Order Summary</h2>
                    <div class="order-summary-product">
                    <div class="order-summary-items">
                    <span class="basket-price" hidden="hidden">0</span>
                    </div>
                    <hr>
                    <span>Total:</span>
                    <span class="total-price">£0</span>
                    <button onclick="confirmOrder()" class="btn btn-primary mt-3 checkout-button">CHECKOUT</button>
                </div>
            </div>
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

<!-- JavaScript Section -->
<script>
  function toggleDropdown(dropdownId) {
    var dropdownContent = document.getElementById(dropdownId).getElementsByClassName("dropdown-content")[0];
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  }

  function validateShipping() {
    var firstName = document.getElementById("firstName").value;
    var surname = document.getElementById("surname").value;
    var addressLine = document.getElementById("addressLine").value;
    var postcode = document.getElementById("postcode").value;
    var city = document.getElementById("city").value;

    if (firstName === '' || surname === '' || addressLine === '' || postcode === '' || city === '') {
      document.getElementById("shipping-error").innerText = "Incomplete Shipping Details";
    } else {
      document.getElementById("shipping-error").innerText = "";
    }
  }

  function validatePayment() {
    var cardNumber = document.getElementById("cardNumber").value;
    var expiryDate = document.getElementById("expiryDate").value;
    var securityNumber = document.getElementById("securityNumber").value;

    if (cardNumber.length !== 16 || isNaN(cardNumber)) {
      document.getElementById("payment-error").innerText = "Invalid Card Number";
    } else if (securityNumber.length !== 3 || isNaN(securityNumber)) {
      document.getElementById("payment-error").innerText = "Invalid Security Number";
    } else {
      document.getElementById("payment-error").innerText = "";
    }
  }

  function confirmOrder() {
    var firstName = document.getElementById("firstName").value;
    var surname = document.getElementById("surname").value;
    var addressLine = document.getElementById("addressLine").value;
    var postcode = document.getElementById("postcode").value;
    var city = document.getElementById("city").value;
    var cardNumber = document.getElementById("cardNumber").value;
    var expiryDate = document.getElementById("expiryDate").value;
    var securityNumber = document.getElementById("securityNumber").value;

    var shippingError = document.getElementById("shipping-error");
    var paymentError = document.getElementById("payment-error");

    // Check if any of the shipping details are empty
    if (firstName === '' || surname === '' || addressLine === '' || postcode === '' || city === '') {
      shippingError.innerText = "Incomplete Shipping Details";
      return; // Exit the function early
    } else {
      shippingError.innerText = "";
    }

    // Check if the card number is valid
    if (cardNumber.length !== 16 || isNaN(cardNumber)) {
      paymentError.innerText = "Invalid Card Number";
      return; // Exit the function early
    }

    // Check if the security number is valid
    if (securityNumber.length !== 3 || isNaN(securityNumber)) {
      paymentError.innerText = "Invalid Security Number";
      return; // Exit the function early
    }

    // If all details are valid, proceed with the order confirmation
    alert("Thank you for your order!");
}

  function addItemToCheckout(title, price, imageSrc) {
    var BasketRow = document.createElement('div')
    BasketRow.classList.add('basket-row')

    var BasketItems = document.getElementsByClassName('order-summary-items')[0]

    var BasketRowContents = `
        <div class="basket-item basket-column">
            <img class="basket-item-image" src="${imageSrc}" width="100" height="100">
            <span class="basket-item-title">${title}</span>
        </div>
        <span class="basket-price basket-column">${price}</span>`
    BasketRow.innerHTML = BasketRowContents
    BasketItems.append(BasketRow)
}


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

<?php
for ($i = 0; $i < $itemsNum; $i++) {

$productid = $itemIDs->fetchColumn();

$itemTitle->bindParam(1, $productid);
$itemTitle->execute();
 
 
$itemPrice->bindParam(1, $productid);
$itemPrice->execute();

$itemImage->bindParam(1, $productid);
$itemImage->execute();

$title = $itemTitle->fetchColumn();
$price = $itemPrice->fetchColumn();
$imageSrc = $itemImage->fetchColumn();

echo "
<script>
addItemToCheckout('$title', '$price', '$imageSrc');
</script>";
}

?>
<script>
function updateBasketTotal() {
    var BasketItemContainer = document.getElementsByClassName('order-summary-items')[0]
    var BasketRows = BasketItemContainer.getElementsByClassName('basket-row')
    console.log(BasketRows)
    var total = 0
    for (var i = 0; i < BasketRows.length; i++) {
        var BasketRow = BasketRows[i]
        var priceElement = BasketRow.getElementsByClassName('basket-price')[0]
        var price = parseFloat(priceElement.innerText.replace('£', ''))
        total = total + (price)
    }
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('total-price')[0].innerText = '£' + total
}
updateBasketTotal()
</script>
</body>
</html>
