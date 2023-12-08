<?php
require_once('connectdb.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the integerInput is set
    if (isset($_POST["integerInput"])) {
        // Retrieve the value and sanitize as an integer
        $integerValue = intval($_POST["integerInput"]);

    }
}

$items=$db->prepare("SELECT * FROM `productdetails` WHERE `product_id` = ?;");
$items -> bindParam(1,$integerValue);
$items->execute();
$item =$items->fetch(PDO::FETCH_ASSOC);




?>


<link rel = "stylesheet" type="text/css"  href="Styles.css" />

<div id="main">
    <h1>Shaded</h1>
    <h2><center>Items</center> </h2>
    <div id="boxes">
    <div id="row">
    <div id="column">
        <h3><?= $item ['product_name'] ?></h3>
        <img src="sunglasses.avif" width="50%" height="50%">
        <h4><?= $item ['price'] ?></h4>
    </div>









<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <!-- Add your product ID input or any other necessary fields here -->
    <input type="hidden" name="productID" value="123">

    <!-- Button to trigger the SQL query -->
    <button type="submit" name="addToBasket">Add to Basket</button>
</form>



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
