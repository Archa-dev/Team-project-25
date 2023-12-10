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
<!--mine-->
body {
        font-family: "Century Gothic", sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none;
        border: none;
        text-decoration: none;
        text-transform: capitalize;
        transition: .2s linear;
        display: flex;
            flex-direction: column;
            min-height: 100vh;
    }
    
    header {
        background: #fff;
        position: fixed;
        width: 100%;
        z-index: 1000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        top: 0;
        left: 0;
        right: 0;
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, 0.1);
    }
    
    

    /* product-details.html styling */
.product-details {
    max-width: 100%;
    margin: 80px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.product {
    border-bottom: 1px solid #ccc;
    padding: 15px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.product-info {
    flex-grow: 1;
}

.sticky-footer-padding {
            margin-bottom: 60px; /* Adjust the margin bottom to match the height of the footer */
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
        <section class="product-details">
            <h2>Product Details</h2> 

            <div class="product">
                <div class="product-info">
                    <img id="Image" src="" alt="Product Image">
                    <h5 id="ProductName"></h5>
                    <p id="Price"></p>
                    <p id="Quantity"></p>

                    <!--remove -->
                    <h5>Order #12346</h5>
                    <p>Date: 13-11-2023</p>
                    <p>Total: £365.00</p>
                    <!-- Additional information, e.g., card details, can be added here -->
                </div>
               
            </div>


            

           
        </section>


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
                        <!-- social media icons -->
                        <a href="https://en-gb.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
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