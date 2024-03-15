<?php
session_start();
require_once('connectdb.php');
$customerid = $_SESSION['customer_id'];

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
        
            <title>Wishlist - SHADED</title>
        
<!-- favicon -->
<link rel="shortcut icon" href="updatedFavicon.png" type="image/png">
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
    max-width: 100%; /* Ensures the logo scales proportionally */
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
    text-shadow: 0 0 10px black; /* Adds outline */
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
.dark-mode .dropdown-menu,
.dark-mode .wishlist-container{
    background-color: #000000;
}

.dark-mode .dropdown-item:hover {
    background-color: rgba(28, 122, 127, 0.7);
}

    main {
        margin-top: 90px;
    }

    .wishlist-container {
        max-width: 1000px;
        margin: 20px auto;
        padding: 50px 100px;
        background-color: #fff;
        border: none;
        border-radius: 5px;
        box-shadow: 0 0 12px #1c7a7f;
    }

    h2 {
    font-size: 40px;
    color: #003b46;
    text-align:center;
    font-weight: bold;
    margin-bottom: 40px;
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
        font-weight: bold;
    }

    .wishlist-price {
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
       font-weight: bold;
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
    padding-left: 80px; /* left padding */
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
                        <img src="images/logo.png" alt="Shaded Logo">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarMenuItems">

                       <!-- navbar to the left of the search box -->
                    <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
                        <!-- Modify your category links in the HTML to include onclick event handlers -->
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
<!-- lightmode/darkmode -->
    <div id="dark-mode-toggle">
        <a class="nav-link" href="#">
            <i class="fas fa-lightbulb"></i>
        </a>
    </div>

    <main>

    <div id="sun-icon">&#9728;</div>

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

<!-- footer content -->
<footer class="footer">
     <div class="container">
     <div class="row">
     <div class="footer-col">
             <h4>&copyShaded | All Rights Reserved</h4>
             <ul>
             <li><a href="TermsandConditions.html">Terms & Conditions </a></li>
             <li><a href="Policy.html">Privacy and Cookies Policy</a></li>
             
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
                <li><a href="FAQs.html">FAQs</a></li>
                
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

<!-- JavaScript for Scroll Icon -->
<script>
      window.addEventListener('scroll', function() {
    var sunIcon = document.getElementById('sun-icon');
    var navbarHeight = document.querySelector('header').offsetHeight;
    var footerHeight = document.querySelector('footer').offsetHeight;
    var scrollPosition = window.scrollY;
    var windowHeight = window.innerHeight;
    var bodyHeight = document.body.clientHeight;

    // Calculate position of the sun icon based on scroll position
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
