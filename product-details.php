<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!--bootstrap css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
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
h2{
    font-size: 40px;
    text-align: center;
    color: #003B46;
}
.logo img {
    max-width: 100%; /* Ensure the logo scales proportionally */
    max-height: 50px; /* Set the maximum height as needed */
    margin-left: auto; /* Center the logo horizontally */
}

.fas {
    font-size: 15px;/* icon */
}

main {
    margin-top: 11vh; /* Adjust margin-top to be equal to the height of the header */
}
    /* product-details.html styling */

.product-details {
  
    position: relative;
    max-width: 100%;
    margin: 50px auto;
    background-color: #fff;
    color: #003B46;
    padding: 20px;
    box-shadow: 0 0 10px #003B46;
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
    margin-top: 5px; /* Added margin between product name and price */
}
.product-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.product-item .product-details {
    flex-grow: 1;
}

.product h5{
    color: #003B46;
    font-weight: bold;
} 

.product-info {
   display: flex;
   flex-direction: column;
   margin-top: 20px;
   }

   .product-info h5{
  font-weight: bold;
   }



        .product img {
            width: 200px; /* Adjust the size of the product image */
            height: auto;
            margin-right: 20px; /* Add some space between image and text */
        }

.sticky-footer-padding {
    margin-bottom: 8vh;
    /* Adjust the margin bottom to match the height of the footer */
}

.total-return-container {
    position: absolute;
    bottom: 10px;
    right: 10px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}


#returnButton{
    width: 250px; /* Adjust button width as needed */
    margin-top: 10px; /* Add margin between total and button */
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
        box-shadow: 0 0 10px #003B46;
        z-index: 1000;
        max-width: 500px; /* Limit form width */
        width: 90%; /* Adjust width as needed */
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
    }

    #returnForm input[type="text"],
    #returnForm select {
        width: calc(100% - 20px); /* Adjust width and compensate for padding */
        padding: 15px; /* Increased padding */
        margin-bottom: 20px; /* Increased margin */
        border: 1px solid #ccc;
        border-radius: 8px; /* Increased border radius */
        box-sizing: border-box;
        font-size: 16px;
    }

    #returnForm button[type="submit"]{
        width: 100%; /* Make button width 100% */
        margin-top: 20px; /* Add margin between select and button */
        background-color: #003B46;
        color: #fff;
        padding: 15px; /* Adjust padding as needed */
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

/* Updated Footer Styles */
.footer {
            background-color: #003B46;
            color: #fff;
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
            color: #fff;
            font-size: 14px;
        }
.social-icons a:hover{
    color : #07575B;
}

.terms-links a {
    margin-left: 5px;
    color: #fff;
    text-decoration: none;
}

.terms-links a:hover {
    text-decoration: underline; /* underlining on hover  */
    color: #07575B; /* hover color */
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
    <main class="sticky-footer-padding main-content">
    <h2><b>PRODUCT DETAILS</b></h2>

    <div class="container">
        <div class="product-details">
            <div class="product">
                <h5>ORDER #2333</h5>
                <div class="product-info">
                    <!-- Product 1 -->
                    <div class="product-item">
                        <img src="MK-2161BU-0001_1.jpeg" alt="Product Image 1">
                        <div class="product-information">
                            <h5>Product Name 1</h5>
                            <p>£50.00</p>
                        </div>
                    </div>
                    <!-- Product 2 -->
                    <div class="product-item">
                        <img src="MK-2161BU-0001_1.jpeg" alt="Product Image 2">
                        <div class="product-information">
                            <h5>Product Name 2</h5>
                            <p>£65.00</p>
                        </div>
                    </div>
                </div>
                <!-- Total and status of order -->
                <div class="product-info total-return-container">
                  
                    <div class="return-section">
                    <p><b>Total: £115.00</b></p>
                        <p><b>STATUS OF ORDER: PROCESSING</b></p>
                        <button id="returnButton">RETURN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Return Form -->
<div id="returnForm" style="display: none;">
    <div>
    <button id="closeButton" onclick="closeForm()">CLOSE</button>
        <h3>RETURN ITEMS</h3>
     
        <form id="returnItemsForm">
           

            <label for="products">Select Products to Return:</label><br>
            <select id="products" name="products">
                <option value="product1">Product 1</option>
                <option value="product2">Product 2</option>
                <!-- Add more options as needed -->
            </select><br>
            
            <label for="reason">Reason for Return:</label><br>
            <select id="products" name="products">
            <option value="too_big_or_too_small">Too big or too small</option>
        <option value="quality_not_as_expected">Quality not as expected</option>
        <option value="missing_items">Missing items</option>
        <option value="no_longer_needed">No longer needed</option>
        <option value="wrong_items_received">Wrong items received</option>
        </select><br><br>
            <button type="submit">SUBMIT RETURN</button>
        </form>
   
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

            // Display a confirmation message
            alert("Your return has been submitted. Please check your email for return options.");


               // Hide the return form
               returnForm.style.display = "none";
        });
    });
</script>

</body>
</html>