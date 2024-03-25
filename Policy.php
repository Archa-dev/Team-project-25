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
    
    <title>Privacy and Cookies- SHADED</title>
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
    max-width: 100%; /* Ensure the logo scales proportionally */
    max-height: 50px; /* Set the maximum height as needed */
    margin-left: auto; /* Center the logo horizontally */
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
    max-height: 85vh; /* Limit the maximum height to 80% of the viewport height */
    overflow-y: auto; /* Enable vertical scrolling if needed */
    background-color: #fff;
    z-index: 1000;
    transition: right 0.3s ease;
    padding: 20px;
}

.shopping-bag-popup.show {
    right: 0; /* Slide in from the right */
}

.shopping-bag-product {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    position: relative;
}

.shopping-bag-product img {
    max-width: 120px; /* Set the maximum width of the image */
    height: auto; /* Maintain aspect ratio */
    margin-right: 20px; /* Add spacing between the image and product details */
}

.product-details {
    flex: 1; /* Allow the product details to take up remaining space */
    margin-bottom: 50px;
}

.total-price {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px; /* Add spacing between the products and total price */
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
    position: fixed; /* Change position to fixed */
    top: 100px; /* Initial top position */
    right: 10px;
    font-size: 32px;
    color: yellow; /* Initial color of the sun icon */
    text-shadow: 0 0 10px black; /* Add outline */
    z-index: 900; /* Ensure it appears above the navbar */
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

.dark-mode .shopping-bag-popup,
.dark-mode .dropdown-menu{
    background-color: #000000;
}

.dark-mode .dropdown-item:hover {
    background-color: rgba(28, 122, 127, 0.7);
}

/*Homepage Content*/
main {
    margin-top: 90px; /* Adjust margin-top to be equal to the height of the header */
}
    
    #main {
    display: flex;
    flex-direction: column;
    
    margin-top: 11vh;
    }

    #boxes {
    max-width: 1000px; /* maximum width for the content */
    width: 100%;
    padding: 20px;
}


        

        .product-container h2 {
    color: #003b46; /* Set the color to #003b46 */
    font-size: 40px;
    font-weight: bold;
    text-align: center;
    padding-top: 20px;
    margin-bottom: 40px;
}


#section h4 {
    margin-bottom: 10px;
    color: #003B46; /* Added margin bottom to create space between title and questions */
    margin-bottom: 40px;
   font-weight: bold;

}



/* footer styles */
.footer {
    background-color: #003B46;
    color: #fff;
    padding: 20px 0; /* Add padding to the top and bottom */
    bottom: 0; /* Stick the footer to the bottom */
    width: 100%;
    position: relative;
}


.footer-col {
    width: 25%; /* Set the width of each column */
    padding: 0 15px; /* Add horizontal padding */
    padding-left: 80px;
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

        <div class="container" id="main">
            <div class="product-container">
                <h2> PRIVACY AND COOKIES POLICY</h2>

                <div id="section">
                    
                        <h4>PRIVACY POLICY</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut purus nec turpis congue interdum vel et justo. Maecenas viverra augue id arcu blandit malesuada. Duis sed malesuada velit. Curabitur non sem sit amet magna condimentum lacinia. Proin sodales blandit hendrerit. Nullam vel ligula auctor, dignissim massa a, volutpat odio.</p>
                        <p>Nulla id hendrerit justo. Quisque mattis arcu nec sapien tincidunt volutpat. Cras tempor velit ac orci ultricies, in semper ligula molestie. Sed accumsan viverra enim, sed euismod sapien rhoncus ut. Donec tempus felis a ligula ultrices posuere. Vestibulum et aliquet mauris. Integer non massa sapien. Mauris interdum varius urna, eget faucibus nunc efficitur ac.</p>
                        <p>Phasellus rhoncus efficitur nisl, ut eleifend odio tempor a. Fusce eu bibendum nisl. Aenean ac fringilla elit. Mauris eu velit felis. Fusce sagittis lectus eu lacinia hendrerit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce tristique efficitur urna, nec vehicula orci efficitur nec. Integer sed purus justo.</p>
                        <p>Nullam ullamcorper, nunc sit amet interdum fringilla, enim mi eleifend odio, sed elementum ex turpis id arcu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer venenatis lacinia felis, nec ultrices libero sollicitudin nec. Donec nec libero non ante scelerisque pretium. Proin vestibulum, arcu ac blandit auctor, mi metus rhoncus risus, a tempor nulla diam nec nibh.</p>
                        <p>Nullam molestie orci sed magna pretium, et tincidunt dui luctus. Integer at sapien in dui tincidunt ultricies. Cras varius magna vitae venenatis vulputate. Donec at lacus id sapien scelerisque luctus. Pellentesque auctor pharetra odio, a sagittis nisi accumsan sed. Nulla tristique mauris quis enim ultrices dapibus. Nulla facilisi.</p>
                </div>
                
                <div id="section">
                    
                        <h4>COOKIES POLICY</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut purus nec turpis congue interdum vel et justo. Maecenas viverra augue id arcu blandit malesuada. Duis sed malesuada velit. Curabitur non sem sit amet magna condimentum lacinia. Proin sodales blandit hendrerit. Nullam vel ligula auctor, dignissim massa a, volutpat odio.</p>
                        <p>Nulla id hendrerit justo. Quisque mattis arcu nec sapien tincidunt volutpat. Cras tempor velit ac orci ultricies, in semper ligula molestie. Sed accumsan viverra enim, sed euismod sapien rhoncus ut. Donec tempus felis a ligula ultrices posuere. Vestibulum et aliquet mauris. Integer non massa sapien. Mauris interdum varius urna, eget faucibus nunc efficitur ac.</p>
                        <p>Phasellus rhoncus efficitur nisl, ut eleifend odio tempor a. Fusce eu bibendum nisl. Aenean ac fringilla elit. Mauris eu velit felis. Fusce sagittis lectus eu lacinia hendrerit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce tristique efficitur urna, nec vehicula orci efficitur nec. Integer sed purus justo.</p>
                        <p>Nullam ullamcorper, nunc sit amet interdum fringilla, enim mi eleifend odio, sed elementum ex turpis id arcu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer venenatis lacinia felis, nec ultrices libero sollicitudin nec. Donec nec libero non ante scelerisque pretium. Proin vestibulum, arcu ac blandit auctor, mi metus rhoncus risus, a tempor nulla diam nec nibh.</p>
                        <p>Nullam molestie orci sed magna pretium, et tincidunt dui luctus. Integer at sapien in dui tincidunt ultricies. Cras varius magna vitae venenatis vulputate. Donec at lacus id sapien scelerisque luctus. Pellentesque auctor pharetra odio, a sagittis nisi accumsan sed. Nulla tristique mauris quis enim ultrices dapibus. Nulla facilisi.</p>
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
        form.action = 'shopping.php'; // Shopping.php is the target page
        
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





