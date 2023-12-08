<!DOCTYPE html>
<html lang="en">
<?php 
require_once('connectdb.php');

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
    <header>
        <a href="#" class="logo">
            <img src="shaded logo.png" alt="Shaded Logo">
        </a>
        <nav class="navbar">
            <ul>
                <li>
                    <a href="#">Men</a>
                    <ul>
                        <li><a href="#">Category 1</a></li>
                        <li><a href="#">Category 2</a></li>
                        <li><a href="#">Category 3</a></li>
                        <li><a href="#">Category 4</a></li>
                        <li><a href="#">Category 5</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Women</a>
                    <ul>
                        <!-- Women's category subcategories -->
                        <li><a href="#">Category 1</a></li>
                        <li><a href="#">Category 2</a></li>
                        <li><a href="#">Category 3</a></li>
                        <li><a href="#">Category 4</a></li>
                        <li><a href="#">Category 5</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Unisex</a>
                    <ul>
                        <!-- Unisex category subcategories -->
                        <li><a href="#">Category 1</a></li>
                        <li><a href="#">Category 2</a></li>
                        <li><a href="#">Category 3</a></li>
                        <li><a href="#">Category 4</a></li>
                        <li><a href="#">Category 5</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Prescription</a>
                    <ul>
                        <!-- Prescription category subcategories -->
                        <li><a href="#">Category 1</a></li>
                        <li><a href="#">Category 2</a></li>
                        <li><a href="#">Category 3</a></li>
                        <li><a href="#">Category 4</a></li>
                        <li><a href="#">Category 5</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Blue Light</a>
                    <ul>
                        <!-- Blue Light category subcategories -->
                        <li><a href="#">Category 1</a></li>
                        <li><a href="#">Category 2</a></li>
                        <li><a href="#">Category 3</a></li>
                        <li><a href="#">Category 4</a></li>
                        <li><a href="#">Category 5</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="icons">
            <a href="#" class="fas fa-search"></a>
            <a href="#" class="fas fa-user"></a>
            <a href="#" class="fas fa-heart"></a>
            
        <div class="shopping-bag" onmouseover="showCartDropdown()" onmouseout="hideCartDropdown()">
            <a href="#" class="fas fa-shopping-cart"></a> 
            <!-- Shopping bag dropdown content -->
            <div id="cart-dropdown">
                <ul>
                    <li>Product 1</li>
                    <li>Product 2</li>
                    <!-- Add more products dynamically based on user's cart -->
                </ul>
            </div>
        </div>
    </div>

    </header>

    <main>
        
        <div id="main">
            <h1>Shaded</h1>
            <h2><center>Items</center> </h2>
            <div id="boxes">
            <div id="row">
            <div id="column">
                    <h3>variable1</h3>
                    <img src="sunglasses.avif" width="50%" height="50%">
                </div>
                
                <div id="column">
                    <h3>variable 2</h3>
                    <img src="sunglasses.avif" width="50%" height="50%">
                </div>
                
                <div id="column">
                    <h3>variable 3</h3>
                    <img src="sunglasses.avif" width="50%" height="50%">     
                
                </div>
                <div id="column">
                    <h3>variable</h3>
                    <img src="sunglasses.avif" width="50%" height="50%">
                </div>
    
    </main>

    <footer>

    </footer>

    <form method="post" action="Item.php">
    <!-- Integer text box -->
    <label for="integerInput">Enter an Integer:</label>
    <input type="text" name="integerInput" id="integerInput" pattern="\d+" title="Please enter a valid integer." required>
    
    <!-- Submit button -->
    <button type="submit">Submit</button>
</form>


        <script>
        // JavaScript function to submit the form
        function submitForm() {
    
            // Submit the form
            document.forms[0].submit();
        }
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
