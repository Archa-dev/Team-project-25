<!DOCTYPE html>
<html lang="en">
  
<?php
require_once('connectdb.php');
session_start();
$user = $_SESSION['customer_id'];

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
        // Check for duplicate entry
        $checkDuplicate = $db->prepare("SELECT COUNT(*) FROM `basket` WHERE `customer_id` = ? AND `product_id` = ?;");
        $checkDuplicate->bindParam(1, $user);
        $checkDuplicate->bindParam(2, $integerValue);
        $checkDuplicate->execute();
        $count = $checkDuplicate->fetchColumn();

        // If no duplicate, proceed with insertion
        if ($count == 0) {
            $addToBasket = $db->prepare("INSERT INTO `basket` (`customer_id`, `product_id`) VALUES (?, ?);");
            $addToBasket->bindParam(1, $user);
            $addToBasket->bindParam(2, $integerValue);

            // Execute the SQL query to insert the product into the basket
            $addToBasket->execute();

        } else {
            // Display a message
            echo "Product is already in the basket.";
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!--bootstrap css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
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
        outline: none;
         border: none;
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
    margin-top: 11vh; /* Adjust margin-top to be equal to the height of the header */
}
    
    #main {
    display: flex;
    flex-direction: column;
    align-items: center; 
    margin-top: 11vh;
    }

    #boxes {
    max-width: 800px; /* maximum width for the content */
    width: 100%;
    padding: 20px;
}

        #column {
         position: absolute;
         left: 0;
    top: 0;
    width: 40%;
    float: left;
           
        }

        

        #column img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover; 
        }

        #product-info {
            flex: 0 0 45%; /* Adjust the width of the right column */
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 60px;
            
        }

        #product-info h3{
            margin-bottom: 10px;
            font-size: 40px;
         padding-left: 30px;
        
        }

        #product-info h4 {
            margin-bottom: 20px;
            font-size: 30px;
         padding-left: 30px;
        }

        #product-info-container {
    width: 85%;
    float: right;
   
}

#product-info h5 {
    margin-bottom: 5px;
    font-size: 16px; /* Adjust the font size for additional headers */
    padding-left: 30px;
}




    .add-to-basket-button {
    background-color: #003b46;
    border: none;
    color: #fff;
    padding: 5px 200px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    margin: 80px 0;
    margin-left: 30px;
    cursor: pointer;
    border-radius: 5px;
    white-space: nowrap;
        }

        .add-to-basket-button:hover {
    background-color: #07575b;
}

#leave-review-btn {
    margin-left: 500px;
  margin-top: -80px;
  color: #003b46;
  border: none;
  padding: 5px 30px;
  background-color: #ffffff;
  text-decoration: none;
  transition: text-decoration 0.2s;
  white-space: nowrap;
}

#leave-review-btn:hover {
  text-decoration: underline;
}

.sticky-footer-padding {
    margin-bottom: 8vh;
    /* Adjust the margin bottom to match the height of the footer */
}
#review-form-popup {
    position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #ffffff;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
  padding: 30px;
  z-index: 1000;
}

#review-form {
    margin: 0 auto;
  max-width: 500px;
}

#review-form label {
  display: block;
  margin-bottom: 10px;
}

#review-form input[type="text"],
#review-form input[type="number"],
#review-form textarea {
  display: block;
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #cccccc;
  margin-bottom: 20px;
  resize: vertical;
}

#review-form textarea {
  height: 150px;
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

.form-group label {
  display: block;
  font-size: 18px;
  margin-bottom: 5px;
}

.form-group input,
.form-group textarea {
  border: none;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
  display: block;
  font-size: 18px;
  padding: 10px;
  width: 100%;
}

.form-group textarea {
  resize: vertical;
}

.star-rating {
  font-size: 30px;
  margin-bottom: 20px;
}

.star-rating i {
  color: #cccccc;
  transition: color 0.2s;
}

.star-rating i:hover {
  color: #ffcc00;
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
    color: #6c757d; /* Change the color as needed */
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
                                <li><a class="dropdown-item" href="basket.php">View Shopping Basket</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>


    <main class="sticky-footer-padding">
        <div id="main">
            <div id="boxes">
                <div id="row">
                    <div id="column" style="display: flex; align-items: center;" >
                        <img src="MK-2161BU-0001_1.jpeg" alt="Product Image" style="width: 100%; height: auto;">
                    </div>
                    <div id="product-info-container" style="width: 60%; float: right;">
                    <div id="product-info">
                        <h3 style><?= $item['product_name'] ?></h3>
                        <h4 >£<?= $item['price'] ?></h4>

                        <!-- placeholder headers -->
    <h5 style="margin-top: 30px;">Colour: BLACK</h5>
    <div class="color-icon"> <!-- Container for the black circle icon -->
        <i class="fas fa-circle" style= "font-size: 32px; margin-left: 30px;"></i> <!-- Black circle icon -->
    </div>
    <h5 style="margin-top: 30px;">Size: ONE SIZE</h5>
                        <!-- Add your product name and price elements here -->
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <!-- Add your product ID input or any other necessary fields here -->
                            <input type="hidden" name="selectedProductId" value="<?= $integerValue ?>">
                            <!-- Button to trigger the SQL query -->
                            <button type="submit" name="addToBasket" class="add-to-basket-button">Add to Shopping Basket</button>
                        </form>

                        <button id="leave-review-btn" class="review-button">Leave a Review</button>

<div id="review-form-popup" style="display: none;">
  <form id="review-form">
  <button type="button" id="close-review-form-btn">CLOSE</button>
  <div class="form-group">
    <label for="star-rating">Star Rating:</label>
    <div class="star-rating">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
    </div>
  </div>
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="review">Review:</label>
    <textarea id="review" name="review" class="form-control" rows="3" required></textarea>
    <button type="submit" class="add-to-basket-button">Submit Review</button>
  </form>
</div>
                </div>
                </div>
                </div>
            </div>
        </div>
   
    </main>

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
   

<script>
    document.getElementById("leave-review-btn").addEventListener("click", function() {
  document.getElementById("review-form-popup").style.display = "block";
});

document.getElementById("review-form").addEventListener("submit", function(event) {
  event.preventDefault();
  // Handle form submission here
});

document.getElementById('close-review-form-btn').addEventListener('click', function() {
  document.getElementById('review-form-popup').style.display = 'none';
});
</script>

</body>
</html>
