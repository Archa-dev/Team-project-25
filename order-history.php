<!DOCTYPE html>
<?php
require_once('connectdb.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the integerInput is set
    if (isset($_POST["integerInput"])) {
        // Retrieve the value and sanitize as an integer
        $integerValue = intval($_POST["integerInput"]);
 
        // Process the integer value as needed
        echo "Entered Integer Value: $integerValue";
    }
}
 
$items=$db->prepare("SELECT * FROM `previousorders` WHERE customer_id = ?");
$items -> bindParam(1,$integerValue);
$items->execute();
$item =$items->fetch(PDO::FETCH_ASSOC);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--bootstrap css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <style>
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
    
    /* Logo Styles */
    .logo img {
        max-width: 100%;
        max-height: 50px;
        margin-left: auto;
    }
    
    /* Icon Styles */
    .fas {
        font-size: 15px;
    }

     /* Removes arrows next to the categories */
.navbar-nav .nav-item.dropdown > .nav-link::after {
    display: none;
}

    
    /* order history page Styles */
    .order-history {
        max-width: 100%;
        margin: 80px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }
    
    .order {
        border-bottom: 1px solid #ccc;
        padding: 15px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .order-details {
        flex-grow: 1;
    }
    
    /* View Details Button Styles */
    .view-details-btn {
        background-color: #fff;
        color: #000;
        padding: 8px 15px;
        border: none;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s, text-decoration 0.3s;
    }
    
    .view-details-btn:hover {
        text-decoration: underline;
        background-color: #fff;
        color: #000;
    }

    main {
            flex: 1;
        }

        .sticky-footer-padding {
            margin-bottom: 60px; /* Adjust the margin bottom to match the height of the footer */
        }
   
        .footer {
            background-color: #fff;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 10px;
            box-shadow:0 -5px 10px rgba(0, 0, 0, 0.1); /* Add this line for the shadow effect */
    }

    
   
    
        </style>
    <title>Order History-SHADED</title>
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-user"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <i class="fas fa-lock"></i>
                        </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-heart"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Item 1</a></li>
                                <li><a class="dropdown-item" href="#">Item 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Product 1</a></li>
                                <li><a class="dropdown-item" href="#">Product 2</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="sticky-footer-padding">
        <!-- order history title-->
        <section class="order-history">
            <h2>Order History</h2> 

            <!-- brief order details-->
            <div class="order">
                <div class="order-details">
                    <h5>Order <?=$item['productId']?></h5>
                    <p>Date: 15-11-2023</p>
                    <p>Total: £450.00</p>
                </div>
                <!-- button that redirects to the product details page-->
                <button class="view-details-btn" onclick="redirectToProductDetails(1)">View Details</button>
            </div>
            

            <div class="order">
                <div class="order-details">
                    <h5>Order #12346</h5>
                    <p>Date: 13-11-2023</p>
                    <p>Total: £365.00</p>
                </div>
                <button class="view-details-btn" onclick="redirectToProductDetails(2)">View Details</button>
                <!-- change to data base info ? onclick="redirectToProductDetails(2)"-->
            </div>

            <div class="order">
                <div class="order-details">
                    <h5>Order #12345</h5>
                    <p>Date: 12-11-2023</p>
                    <p>Total: £535.00</p>
                </div>
                <button class="view-details-btn" onclick="redirectToProductDetails(3)">View Details</button>
            </div>

            <!-- Add more orders as needed -->

           
        </section>


    </main>

    <footer class="footer">
    <p>&copy; 2023 Your Website</p>
        <div class="footer-links">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </div>

    </footer>
    <script> function redirectToProductDetails(productId) {
        window.location.href = 'product-details.html?id=' + productId;
            // JavaScript function to submit the form
    function submitForm() {
 
 // Submit the form
 document.forms[0].submit();
}
    }</script>

<form method="post">
    <!-- Integer text box -->
    <label for="integerInput">Enter an Integer:</label>
    <input type="text" name="integerInput" id="integerInput" pattern="\d+" title="Please enter a valid integer." required>
   
    <!-- Submit button -->
    <button type="submit">Submit</button>
</form>


</body>
</html>