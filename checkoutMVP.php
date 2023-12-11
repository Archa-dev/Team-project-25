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
    font-size: 15px;/* icons*/
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
        }

        #order-summary {
            width: 75%;
            padding: 20px;
            background-color: #f8f9fa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        }

        .order-summary-product {
            margin-bottom: 15px;
            height: auto;
}

.order-summary-product img {
    max-width: 100%; /* Ensure the image doesn't exceed its container's width */
    max-height: 150px; 
    display: block; 
}

        .total-amount {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }
        
        .btn-primary {
    background-color: darkgrey;
    border: #000;
    color: #fff;
}

.btn-primary:hover {
    background-color: grey;
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
    color: #000; /*  hover color  */
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
                                <li><a class="dropdown-item"  name="nav-logout-button" >Logout</a></li>
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
    
    <main class="sticky-footer-padding main-content">
    <div class="container">
    <div class="row">
    <div class="col-12 col-md-6 mb-4">
        <div id="shipping-details">
            <h2>Shipping Details</h2>
            <form>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="First Name" id="firstName">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Surname" id="surname">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Address Line" id="addressLine">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Postcode" id="postcode">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="City" id="city">
        </div>
        <button type="button" onclick="validateShipping()" class="btn btn-primary mt-3">Submit</button>
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
        <button type="button" onclick="validatePayment()" class="btn btn-primary mt-3">Submit</button>
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
                    <button onclick="confirmOrder()" class="btn btn-primary mt-3 checkout-button" type="button">Checkout</button>
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
                        <!-- social media icons  -->
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="terms-links">
                         <!-- links do not redirect anywhere  -->
                        <a href="#">Terms of Use</a>
                        <a href="#">Cookies Policy</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

<!-- JavaScript Section -->
<script>

// Helper function to set border color
function setBorderColor(elementId, isValid) {
  var color = isValid ? 'green' : 'red';
  document.getElementById(elementId).style.borderColor = color;
}

function validateShipping() {
  var isValid = true;
  var fields = ['firstName', 'surname', 'addressLine', 'postcode', 'city'];

  fields.forEach(function(field) {
    var value = document.getElementById(field).value;
    var fieldIsValid = value !== '';
    setBorderColor(field, fieldIsValid);
    isValid = isValid && fieldIsValid;
  });

  document.getElementById("shipping-error").innerText = isValid ? "" : "Incomplete Shipping Details";
  return isValid;
}

function validatePayment() {
  var cardNumber = document.getElementById("cardNumber").value;
  var securityNumber = document.getElementById("securityNumber").value;
  var cardNumberValid = cardNumber.length === 16 && !isNaN(cardNumber);
  var securityNumberValid = securityNumber.length === 3 && !isNaN(securityNumber);

  setBorderColor("cardNumber", cardNumberValid);
  setBorderColor("securityNumber", securityNumberValid);

  var isValid = cardNumberValid && securityNumberValid;

  document.getElementById("payment-error").innerText = isValid ? "" : "Invalid Payment Details";
  return isValid;
}



function confirmOrder() {
  var shippingValid = validateShipping();
  var paymentValid = validatePayment();

  if (shippingValid && paymentValid) {
    alert("Thank you for your order! Your payment has been successful.");
    window.location.href = 'homepage.php';
  } else {
    var message = "Please check the following:";
    if (!shippingValid) {
      message += "\n - Shipping Information";
    }
    if (!paymentValid) {
      message += "\n - Payment Information";
    }
    alert(message);
  }
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
