<!DOCTYPE html>
<?php
require_once('connectdb.php');

session_start();
 $customerId=$_SESSION["customer_id"];

$items = $db->prepare("SELECT o.order_id, o.date, p.price FROM `previousorders` o
                      JOIN `productdetails` p ON o.product_id = p.product_id
                      WHERE o.customer_id = ?");
$items->bindParam(1, $customerId);
$items->execute();
$orders = $items->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
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
            box-shadow:0 -5px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <title>Order History-SHADED</title>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-sm w-100">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenuItems" aria-controls="navbarMenuItems" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="#" class="navbar-brand logo">
                    <img src="shaded logo.png" alt="Shaded Logo">
                </a>
                <div class="collapse navbar-collapse" id="navbarMenuItems">


                </div>
            </div>
        </nav>
    </header>

    <main class="sticky-footer-padding">
        <!-- order history title-->
        <section class="order-history">
            <h2>Order History</h2>

            <?php foreach ($orders as $order) : ?>
                <!-- brief order details-->
                <div class="order">
                    <div class="order-details">
                        <h5>Order <?= $order['order_id'] ?></h5>
                        <p>Date: <?= $order['date'] ?></p>
                        <p>Total: £<?= $order['price'] ?></p>
                    </div>
                    <!-- button that redirects to the product details page-->
                    <button class="view-details-btn" onclick="redirectToProductDetails(<?= $order['order_id'] ?>)">View Details</button>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    </body>
</html>
