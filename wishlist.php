<!DOCTYPE html>
<html lang="en">


<?php
session_start();
require_once('connectdb.php');
$customerid = $_SESSION['customer_id'];

// Retrieve basket items for the logged-in customer
$itemIDs = $db->prepare('SELECT b.product_id, p.product_name, p.price 
                        FROM basket b
                        JOIN productdetails p ON b.product_id = p.product_id
                        WHERE b.customer_id = ?');
$itemIDs->bindParam(1, $customerid);
$itemIDs->execute();
$items = $itemIDs->fetchAll(PDO::FETCH_ASSOC);

$itemsCount = count($items);
?>

        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!--bootstrap css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        
            <title>Wishlist - SHADED</title>
        


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
        font-size: 15px;
    }

    main {
        margin-top: 15vh; /* Adjust margin-top to be equal to the height of the header */
    }

    .wishlist-container {
        max-width: 1000px;
        margin: 20px auto;
        padding: 80px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
    font-size: 40px;
    color: #003b46;
    text-align:center;
    font-weight: bold;
}

    .wishlist-items {
        margin-bottom: 40px;
    }

    .wishlist-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .wishlist-column {
        flex: 1;
    }

    .wishlist-item {
        display: flex;
        align-items: center;
        
    }

    .wishlist-item-image {
        width: 60%;
        height: 60%;
        object-fit: contain;
        border-radius: 5px;
        margin-left: -60px;
        max-width: 270px;
    max-height: 270px;
    }

    .wishlist-item-title{
        text-align: right;
        font-size: 20px;
        margin-right: 60px;
        
    }

    .wishlist-price {
        text-align: right;
        font-weight: bold;
        margin-right: 160px;
    
    }

    .wishlist-item-colour {
    display: block; /* Display the color information on a new line */
    color: #555; /* Optionally style the color information */
    margin-top: 5px; /* Add margin to separate it from the price */
    margin-right: 60px;
}
.wishlist-amount {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    
}

   

    .button {
        cursor: pointer;
        padding: 10px;
        background-color: #003b46;
        color: #fff;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
       
    }

    .button:hover {
        background-color: #07575b;
    }


   
.wishlist-item-details{
    
    display: flex;
        flex-direction: column;
        margin-right: 20px;

}


    
  .wishlist-amount.wishlist-column {
    display: flex;
    align-items: center;
    justify-content: flex-end; 
}

.button-remove {
    margin-right: 15px;
}


    .sticky-footer-padding {
        margin-bottom: 8vh;
        /* Adjust the margin bottom to match the height of the footer */
    }

    /* Updated Footer Styles */
    .footer {
                background-color: #003b46;
                color: #fff;
                padding: 10px;
                text-align: center;
                bottom: 0;
                left: 0;
                width: 100%;
                font-size: 14px;
                box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.1);
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
        color: grey; /* Change the hover color as needed */
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

        <main class="main">

        <h2>WISHLIST</h2>

        <section class="wishlist-container">
           

            <div class="wishlist-items">
                <!-- Display wishlist items, right now this php is for basket-->
                <?php foreach ($items as $item) : ?>
                    <div class="wishlist-row">
                        <div class="wishlist-item wishlist-column">
                            <img class="wishlist-item-image" src="sunglasses.avif" alt="Sunglasses" width="100" height="100"><!-- db image to replace sunglasses image<?= $item['product_image'] ?>-->
                            <div class="wishlist-item-details">
                                <span class="wishlist-item-title"><?= $item['product_name'] ?></span>
                                <span class="wishlist-price">£<?= number_format($item['price'], 2) ?></span>
                                <span class="wishlist-item-colour">Colour: BLACK</span>
                            </div>
                        
                        <div class="wishlist-amount wishlist-column">
                            <!-- Add hidden input for product_id -->
                            <input type="hidden" class="wishlist-amount-productid" value="<?= $item['product_id'] ?>">
                            
                            
                            <button class="button button-remove " type="button">REMOVE</button>
                       
                            <!-- Add to shopping bag button-->
                            
                            
                            <button class="button button-addtobag" type="button">ADD TO BAG</button>
                        </div>
                    </div>
                    </div>
                <?php endforeach; ?>

            </div>

            
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

        var amountInputs = document.getElementsByClassName('wishlist-amount-input')
        for (var i = 0; i < amountInputs.length; i++) {
            var input = amountInputs[i]
            input.addEventListener('change', amountChanged)
        }

        var addToBasketButtons = document.getElementsByClassName('test-item-button')
        for (var i = 0; i < addToBasketButtons.length; i++) {
            var button = addToBasketButtons[i]
            button.addEventListener('click', addToBasketClicked)
        }

        document.getElementsByClassName('checkout-button')[0].addEventListener('click', checkoutClicked)
    }

    function checkoutClicked() {
        var BasketItems = document.getElementsByClassName('wishlist-items')[0]
        while (BasketItems.hasChildNodes()) {
            BasketItems.removeChild(BasketItems.firstChild)
        }
        window.location.replace("checkout.php");
    }

    function removeBasketItem(event) {
        var buttonClicked = event.target
        var productid = buttonClicked.parentElement.parentElement.getElementsByClassName('basket-item-productid')[0].innerText
        buttonClicked.parentElement.parentElement.remove()
        // <?php
        // $removeItem = $db->prepare('DELETE FROM basket WHERE product_id = ? AND customer_id = ?');          needs to use something else, probably AJAX to remove item from basket
        // $removeItem->bindParam(1, $productid);
        // $removeItem->bindParam(2, $customerid);
        // $removeItem->execute();
        // ?>
        updateBasketTotal()
    }

    function amountChanged(event) {
        var input = event.target
        if (isNaN(input.value) || input.value <= 0) {
            input.value = 1
        }
        updateBasketTotal()
    }

    function addItemToBasket(title, price, imageSrc, amount, productid) {
        console.log(title, price, imageSrc, amount, productid)
        var BasketRow = document.createElement('div')
        BasketRow.classList.add('wishlist-row')


        var BasketItems = document.getElementsByClassName('wishlist-items')[0]


        var BasketRowContents = `
            <div class="wishlist-item wishlist-column">
                <img class="wishlist-item-image" src="${imageSrc}" >
                <span class="wishlist-item-title">${title}</span>
                <span class="wishlist-item-productid">${productid}</span>
            </div>
            <span class="wishlist-price basket-column">${price}</span>
            <div class="wishlist-amount basket-column">
                <input class="wishlist-amount-input" type="number" value="${amount}">
                <button class="button button-remove" type="button">REMOVE</button>
            </div>`
        BasketRow.innerHTML = BasketRowContents
        BasketItems.append(BasketRow)
        BasketRow.getElementsByClassName('button-remove')[0].addEventListener('click', removeBasketItem)
        BasketRow.getElementsByClassName('wishlist-amount-input')[0].addEventListener('change', amountChanged)
    }

    function updateBasketTotal() {
    var BasketItemContainer = document.getElementsByClassName('wishlist-items')[0]
    var BasketRows = BasketItemContainer.getElementsByClassName('wishlist-row')
    var total = 0
    for (var i = 0; i < BasketRows.length; i++) {
        var BasketRow = BasketRows[i]
        var priceElement = BasketRow.getElementsByClassName('wishlist-price')[0]
        var amountElement = BasketRow.getElementsByClassName('wishlist-amount-input')[0]
        var price = parseFloat(priceElement.innerText.replace('£', ''))
        var amount = amountElement.value
        total = total + (price * amount)
    }
    total = Math.round(total * 100) / 100
    // Set the calculated total value to the HTML element with class 'basket-total-price'
    document.getElementsByClassName('wishlist-total-price')[0].innerText = '£' + total
}
    </script>





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

    </body>
    </html>