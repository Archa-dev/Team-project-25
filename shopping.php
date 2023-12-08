<!DOCTYPE html>
<html lang="en">
<?php
require_once('connectdb.php');

// Check if a color filter is set
$colorFilter = isset($_POST['colorSelect']) ? $_POST['colorSelect'] : 'all';

// Build the SQL query with the color filter
$query = "SELECT * FROM productdetails";
if ($colorFilter !== 'all') {
    $query .= " WHERE colour = :color";
}

$stmt = $db->prepare($query);

// Bind the color parameter if it's set
if ($colorFilter !== 'all') {
    $stmt->bindParam(':color', $colorFilter, PDO::PARAM_STR);
}

// Execute the query
$result = $stmt->execute();

// Check for errors
if (!$result) {
    die("Database query failed.");
}

// Fetch the results as an associative array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script defer src="script.js"></script>
    <title>SHADED</title>
</head>
<body>

<!-- Add a form to get the color selection -->
<form method="post" action="">
    <label for="colorSelect">Select Color:</label>
    <select name="colorSelect" id="colorSelect">
        <option value="all">All Colors</option>
        <option value="black">Black</option>
        <option value="white">White</option>
        <option value="yellow">Yellow</option>
        <option value="brown">Brown</option>
        <option value="green">Green</option>
    </select>
    <button type="submit">Filter</button>
</form>

<main>
    <div id="main">
        <h1>Shaded</h1>
        <h2><center>Items</center> </h2>
        <div id="boxes">
            <div id="row">
                <!-- Loop through each product and display buttons -->
                <?php foreach ($products as $product) : ?>
                    <div id="column">
                        <h3><?= $product['product_name'] ?></h3>
                        <img src="sunglasses.avif" width="50%" height="50%">
                        <p>Price: $<?= $product['price'] ?></p>
                        <!-- Use a button with data attributes to store the product ID and color -->
                        <button class="buy-button" data-product-id="<?= $product['product_id'] ?>" data-color="<?= $product['colour'] ?>">Buy</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<form method="post" action="Item.php" id="buyForm">
    <!-- Hidden input fields to store the selected product ID and color -->
    <input type="hidden" name="selectedProductId" id="selectedProductId" value="">

    <!-- Submit button -->
    <button type="submit">Buy</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add a click event listener to all buttons with the class 'buy-button'
        document.querySelectorAll('.buy-button').forEach(function (button) {
            button.addEventListener('click', function () {
                // Get the product ID
                var productId = button.getAttribute('data-product-id');


                // Set the values of the hidden input fields
                document.getElementById('selectedProductId').value = productId;

                // Submit the form
                document.forms['buyForm'].submit();
            });
        });
    });
</script>

</body>
</html>

<style>
    body {
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
    }

    html {
      font-size: 100%;
      scroll-behavior: smooth;
    }

    header {
      background: #ffffff;
      padding: 10px;
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

    nav {
      display: flex;
      justify-content: space-around;
      align-items: center;
    }

    header .navbar a {
      font-size: 15px;
      color: #000000;
      text-decoration: none;
      padding: 10px;
    }

    nav ul {
      list-style: none;
      padding: 0;
      margin: 0px;
      display: flex;
    }

    nav ul li {
      position: relative;
    }

    nav ul li:hover > ul {
      display: flex;
      flex-direction: column;
      width: 100vw;
      position: fixed;
      top: 70px;
      left: 0;
      background-color: #efefef;
      z-index: 1000;
    }

    nav ul ul {
      display: none;
    }

    .logo img {
      max-width: 100%;
      max-height: 50px;
      margin-left: auto;
    }

    header .icons a {
      font-size: 15px;
      color: #000000;
      margin-left: 50px;
      margin-right: 50px;
    }

    .search, .profile, .wishlist, .shopping-bag {
      background-color: #ffffff;
      z-index: 2000;
    }

    #cart-dropdown ul {
      list-style: none;
      padding: 10px;
      margin: 0;
    }

    #cart-dropdown li {
      padding: 5px;
    }
  </style>
