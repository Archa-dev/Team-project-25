<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!--bootstrap css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
        <title>Basket-SHADED</title>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
$itemAmount=$db->prepare('SELECT COUNT(*) FROM basket WHERE product_id = ? AND customer_id = ?');


$itemsCount = $db->prepare('SELECT COUNT(*) FROM basket WHERE customer_id = ?');
$itemsCount->bindParam(1, $customerid);
$itemsCount->execute();
$itemsNum = $itemsCount->fetchColumn();

?>

<style>

html {
    font-size: 100%;
    scroll-behavior: smooth;
 /*  navbar Styles */
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
    font-size: 15px;
}

main {
    margin-top: 15vh; /* Adjust margin-top to be equal to the height of the header */
}

            /* basket styles */
.basket-container {
    max-width: 600px;
    margin: 20px auto;
    padding: 100px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #000;
}

.basket-items {
    margin-bottom: 20px;
}

.basket-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.basket-column {
    flex: 1;
}

.basket-item {
    display: flex;
    align-items: center;
}

.basket-item-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 5px;
    margin-right: 10px;
}

.basket-price {
    text-align: right;
    font-weight: bold;
}

.basket-amount {
    display: flex;
    align-items: center;
}

.basket-amount-input {
    width: 40px;
    margin-right: 5px;
    text-align: center;
}

.button {
    cursor: pointer;
    padding: 10px;
    background-color: lightgray;
    color: #fff;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: grey;
}

.basket-total {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding-top: 10px;
    font-size: 16px;
}

.basket-total-title {
    margin-right: 10px;
}

.basket-total-price {
    font-weight: bold;
    color: #000; 
}

            /* Checkout button styling */
.checkout-button {
    width: 100%;
    padding: 15px;
    background-color: lightgray;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    transition: background-color 0.3s ease;
}

.checkout-button:hover {
    background-color: grey;
}

.sticky-footer-padding {
            margin-bottom: 60px; 
        }
   
       /*  Footer Styles */
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
    text-decoration: underline; /* underlining on hover */
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

    <a href="#" class="navbar-brand logo">
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
                    <li><a class="dropdown-item" href="#">Men Category 1</a></li>
                    <li><a class="dropdown-item" href="#">Men Category 2</a></li>
                    <li><a class="dropdown-item" href="#">Men Category 3</a></li>
                    <li><a class="dropdown-item" href="#">Men Category 4</a></li>
                    <li><a class="dropdown-item" href="#">Men Category 5</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Women
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Women Category 1</a></li>
                    <li><a class="dropdown-item" href="#">Women Category 2</a></li>
                    <li><a class="dropdown-item" href="#">Women Category 3</a></li>
                    <li><a class="dropdown-item" href="#">Women Category 4</a></li>
                    <li><a class="dropdown-item" href="#">Women Category 5</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Unisex
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Unisex Category 1</a></li>
                    <li><a class="dropdown-item" href="#">Unisex Category 2</a></li>
                    <li><a class="dropdown-item" href="#">Unisex Category 3</a></li>
                    <li><a class="dropdown-item" href="#">Unisex Category 4</a></li>
                    <li><a class="dropdown-item" href="#">Unisex Category 5</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Prescription
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Prescription Category 1</a></li>
                    <li><a class="dropdown-item" href="#">Prescription Category 2</a></li>
                    <li><a class="dropdown-item" href="#">Prescription Category 3</a></li>
                    <li><a class="dropdown-item" href="#">Prescription Category 4</a></li>
                    <li><a class="dropdown-item" href="#">Prescription Category 5</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Blue Light
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Blue Light Category 1</a></li>
                    <li><a class="dropdown-item" href="#">Blue Light Category 2</a></li>
                    <li><a class="dropdown-item" href="#">Blue Light Category 3</a></li>
                    <li><a class="dropdown-item" href="#">Blue Light Category 4</a></li>
                    <li><a class="dropdown-item" href="#">Blue Light Category 5</a></li>
                </ul>
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
                    <li><a class="dropdown-item" href="#">My Profile</a></li>
                    <li><a class="dropdown-item" href="#">My Orders</a></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-lock"></i> <!-- Assuming a lock icon for log in/sign up -->
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Log In/ Sign Up</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-heart"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" >Your wish list is empty</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" >Your shopping cart is empty</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
</nav>
    </header>

    <main>
        <section class="basket-container">
            <h2>Your Basket</h2>

            <div class="basket-items">
                <!-- Displays items in the basket -->
                <!-- Example item - remove once sorted with the database -->
                <div class="basket-row">
                    <div class="basket-item basket-column">
                            <span class="basket-price" hidden="hidden">0</span>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="basket-total">
                <strong class="basket-total-title">Total</strong>
                <span class="basket-total-price">£0</span>
            </div>

            <button class="button checkout-button" type="button">PROCEED TO CHECKOUT</button>
        </section>
    </main>



</body>

<script>

if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready() {
    var removeBasketItemButtons = document.getElementsByClassName('button-remove')
    for (var i = 0; i < removeBasketItemButtons.length; i++) {
        var button = removeBasketItemButtons[i]
        button.addEventListener('click', removeBasketItem)
    }

    document.getElementsByClassName('checkout-button')[0].addEventListener('click', checkoutClicked)
}

function checkoutClicked() {
    var BasketItems = document.getElementsByClassName('basket-items')[0]
    while (BasketItems.hasChildNodes()) {
        BasketItems.removeChild(BasketItems.firstChild)
    }
    window.location.replace("checkout.php");
}

function removeBasketItem(event) {
    var buttonClicked = event.target
    var productid = buttonClicked.parentElement.parentElement.getElementsByClassName('basket-item-productid')[0].innerText
    buttonClicked.parentElement.parentElement.remove()
    $.ajax({
        url: 'basketRemove.php',
        type: 'POST',
        data: { id:productid },
    });
    updateBasketTotal()
}


function addItemToBasket(title, price, imageSrc, productid) {
    var BasketRow = document.createElement('div')
    BasketRow.classList.add('basket-row')


    var BasketItems = document.getElementsByClassName('basket-items')[0]


    var BasketRowContents = `
        <div class="basket-item basket-column">
            <img class="basket-item-image" src="${imageSrc}" width="100" height="100">
            <span class="basket-item-title">${title}</span>
            <span class="basket-item-productid">${productid}</span>
        </div>
        <span class="basket-price basket-column">${price}</span>
        <div class="basket-amount basket-column">
            <button class="button button-remove" type="button">REMOVE</button>
        </div>`
    BasketRow.innerHTML = BasketRowContents
    BasketItems.append(BasketRow)
    BasketRow.getElementsByClassName('button-remove')[0].addEventListener('click', removeBasketItem)
}

function updateBasketTotal() {
    var BasketItemContainer = document.getElementsByClassName('basket-items')[0]
    var BasketRows = BasketItemContainer.getElementsByClassName('basket-row')
    var total = 0
    for (var i = 0; i < BasketRows.length; i++) {
        var BasketRow = BasketRows[i]
        var priceElement = BasketRow.getElementsByClassName('basket-price')[0]
        var price = parseFloat(priceElement.innerText.replace('£', ''))
        total = total + (price)
    }
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('basket-total-price')[0].innerText = '£' + total
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
addItemToBasket('$title', '$price', '$imageSrc', '$productid');
updateBasketTotal();
</script>";
}

?>

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
                        <!--  social media icons  -->
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                       
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="terms-links">
                         <!--  links do not redirect anywhere  -->
                        <a href="#">Terms of Use</a>
                        <a href="#">Cookies Policy</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</body>
</html>
