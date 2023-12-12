<!DOCTYPE html>
<html lang="en">
<head>

<script>
    function showMessageConfirmation() {
        alert("Your message has been sent. Thank you for contacting us!");
        return false; // Prevents the form from submitting
    }
</script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Us - SHADED</title>
   
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
        margin-bottom: 60px;
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
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, 0.1);

            .navbar a {
                font-size: 15px;
                color: #000000;
                text-decoration: none;
            }

            
            .navbar-nav .nav-item.dropdown > .nav-link::after {
                display: none !important
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

main {
    margin-top: 11vh; 
}

.sticky-footer-padding {
    margin-bottom: 11vh;
}

/* Welcome Section Styles */
.welcome-section {
    padding: 20px;
    background-color: #f8f9fa; 
}

.welcome-section h2 {
    font-size: 18px;
    color: #000;
}

/* Sidebar Styles */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 300px;
    height: 100%;
    padding-top: 110px;
    background-color: #f8f9fa; 
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.sidebar ul {
    list-style: none;
    padding-left: 0;
}

.sidebar .nav-link {
    padding: 15px 20px;
    text-decoration: none;
    color: #000;
    font-size: 14px; 
    font-weight: bold;
    transition: background-color 0.3s;
    display: block;
}

.sidebar .nav-link:hover {
    background-color: lightgrey; /
    color: #000;
}

.main-content {
    margin-left: 350px; 
}

/* Additional Styling for Active Link */
.sidebar .nav-link.active {
    background-color: #f5f5f5; 
    color: #000;
    position: relative;
}

.sidebar .nav-link.active::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 5px; 
    background-color: #000; 
}

/* contact us page Styles */

 .contact-section1 {
    justify-content: space-between;
    align-items: flex-start;
        padding: 10px;
        margin-left: 50px;
        max-width: 450px;
 }
 .contact-section2 {
   padding: 10px;
   border-top: 1px solid #ccc ;
   display: flex;
   max-width: 87%;
   margin-top: 10px;
   margin-left: 50px;
   justify-content: space-between;
        align-items: center;
 }

 .contact-section3 {
   padding: 10px;
   display: flex;
   margin-top: 10px;
   margin-left: 50px;
   margin-right: 230px;
   font-size: 14px;
 }
 .contact-section h3 {
   flex:1 ;
   margin-top: 10px;
   margin-right: 20px;
   font-size: 18px;
   font-weight: bold;
 }
 .contact-section p {
    flex: 1;
    margin-left: -130px;
   font-size: 14px;
   margin-top: 10px;
   margin-bottom: 10px;
 }

 label {
            display: block;
            margin-bottom: 0.5rem;
        }

        input,
        textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        input[type="submit"] {
            background-color: darkgrey;
            color: #fff;
            border: #000;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: grey;
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
    text-decoration: underline; 
    color: #000; 
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
                                <li><a class="dropdown-item" name="nav-logout-button" href = "login.php" >Logout</a></li>
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

    </header>

   <main class="sticky-footer-padding main-content">
    <div class="container"> 

    <aside class="sidebar">
    <div class="welcome-section">
        <h2>Welcome to your personal area</h2>
        
    </div>
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="accountPage.php">
                My Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="order-history.php">
                My Orders
            </a>
            <li class="nav-item">
            <a class="nav-link active" href="Contactus.php">Contact Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">
                Logout
            </a>
        </li>
    </ul>
</aside>
    
    <!-- Main content for the contact page -->
    <div class="profile-container">
    <div class="contact-section1">
    <h2 class="border-bottom pb-2">Contact Us</h2>
              <p>Use one of the following methods to contact us</p>
            </div>
           <div class="contact-section">
            <div class="contact-section2">
              <h3>Call our Client Service</h3>
              <p class="service-hours">To contact our Client Service you can call <strong>800 800 0000</strong> from Monday to Saturday 9:00 am - 8:00 pm, or Sunday 9:00 am - 6:00 pm.</p>
            </div>
            <div class="contact-section3">
            <h3>Send us a message</h3>
            <form action="/submit-message" method="post" onsubmit="return showMessageConfirmation()">
        <div class="row mb-3">
            <div class="col">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="col">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message:</label>
            <textarea id="message" name="message" rows="4" class="form-control" required></textarea>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
    </form>
            
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
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
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
