<?php
ob_start();
require_once('connectdb.php');
session_start();


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
    ob_end_flush();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer Accounts - Admin</title>

        <!--bootstrap css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
         <!-- favicon -->
         <link rel="shortcut icon" href="images/Updatedfavicon.png" type="image/png">
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
            margin-right: 8px; /* Adds margin between navbar items */
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
    max-width: 100%; /* Ensures the logo scales proportionally */
    max-height: 50px; 
    margin-left: auto; /* Centers the logo horizontally */
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
    max-height: 85vh; /* Limits the maximum height to 80% of the viewport height */
    overflow-y: auto; /* Enables vertical scrolling if needed */
    background-color: #fff;
    z-index: 1000;
    transition: right 0.3s ease;
    padding: 20px;
}

.shopping-bag-popup.show {
    right: 0; /* Slides in from the right */
}

.shopping-bag-product {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    position: relative;
}

.shopping-bag-product img {
    max-width: 120px; 
    height: auto; /* Maintains aspect ratio */
    margin-right: 20px; /* Adds spacing between the image and product details */
}

.product-details {
    flex: 1; /* Allows the product details to take up remaining space */
    margin-bottom: 50px;
}

.total-price {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px; /* Adds spacing between the products and total price */
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
    position: fixed; 
    top: 100px; /* Initial top position */
    right: 10px;
    font-size: 32px;
    color: yellow; /* Initial color of the sun icon */
    text-shadow: 0 0 10px black; /* Adds outline */
    z-index: 900; /* Ensures it appears above the navbar */
    transition: top 0.1s ease, color 0.2s linear; /* Transition for smooth movement and color change */
}

/* CSS for dark mode */
.dark-mode {
    background-color: #000000; /* background color black */
    color: #ffffff; /* text color white */
}

#dark-mode-toggle:hover{
    background-color: #1c7a7f; /* Text color on hover */
            }

.dark-mode header {
    background-color: #000000; /* navbar background color black */
}

/* Update sun/moon icon styles */
.dark-mode #dark-mode-toggle .fas {
    color: #ffffff; /* Changes color of moon icon to white */
}

#dark-mode-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #003b46;
    border: 3px solid #003b46;
    border-radius: 40%; /* Makes it circular */
    padding: 12px;
    z-index: 1000; /* Ensures it appears above other content */
}

#dark-mode-toggle .fas {
    color: #ffffff;
}

.dark-mode .shopping-bag-popup,
.dark-mode .dropdown-menu,
.dark-mode td{
    background-color: #000000;
}

.dark-mode .dropdown-item:hover {
    background-color: rgba(28, 122, 127, 0.7);
}

/*Homepage Content*/
.return-link {
    position: absolute;
    top: 90px; 
    left: 20px;
    font-size: 14px;
    font-weight: bold;
    color: #003b46; 
    text-decoration: none;
    z-index: 1000; /* Ensures it appears above other content */
}

.return-link i {
    margin-right: 5px; /* spacing between the icon and the text */
}

.return-link:hover {
    text-decoration: none;
    color: #1c7a7f;
}

main {
    margin-top: 90px; /* Adjusts margin-top to be equal to the height of the header */
}

.main-content {
            position: relative;
            max-width: 100%;
            overflow: hidden;
            padding: 10px;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 100px;
        }

        .main-content h2{
    color: #003B46;
    font-weight: bold;
    text-align: center;
    font-size: 40px;
    margin-bottom: 60px;
}



.table-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: auto;
    margin-top: 20px;
}

table {
    width: 80%;
    margin-bottom: 20px;
    box-shadow: 0 0 12px #1c7a7f
}

th, td {
    border: 1px solid #000;
    padding: 15px;
}

th {
    background-color: #003B46; /* Dark background color for headers */
    color: #fff; /* White text color */
    text-align: center;
}

td{
    text-align: center;
}

tr:nth-child(even) {
    background-color: #f2f2f2; /* Alternate row background color */
}

tr:hover {
    background-color: #ddd; /* Hover effect for rows */
}

.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 5%;
}

form select, form input[type="text"], form input[type="submit"] {
    padding: 10px;
    width: auto; /* Adjust based on your layout */
    border: 1px solid #003B46;
    border-radius: 5px;
    font-weight: bold;
}

form input[type="submit"] {
    background-color: #003B46; /* Dark button background color */
    color: #fff; /* White text color */
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form input[type="submit"]:hover {
    background-color: #07575b; /* Darker color on hover */
    color: #fff;
}

.button{
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    height: 100%;
    margin-left: 20px;
}

.btn-edit{
    background-color: #003B46;
    color: #fff; /* White text */
        padding: 10px !important;
        margin-top: 10px;
        border: none !important;
        border-radius: 5px;
        cursor: pointer;
        width: 180px !important;
        font-size: 15px;
        transition: background-color 0.3s ease;
        font-weight: bold;
}


.btn-del{
    color: #fff; /* White text */
        padding: 10px !important;
        margin-top: 10px;
        border: none !important;
        border-radius: 5px;
        cursor: pointer;
        width: 180px !important;
        font-size: 15px;
        transition: background-color 0.3s ease;
        font-weight: bold;
        background-color: darkred !important;
}

.btn-del:hover{
    background-color: red !important;
    color: #fff;
}

/* footer styles */
.footer {
    background-color: #003B46;
    color: #fff;
    padding: 20px 0; /* Adds padding to the top and bottom */
    bottom: 0; /* Sticks the footer to the bottom */
    width: 100%;
    position: relative;
}


.footer-col {
    width: 25%; /*width of each column */
    padding: 0 15px; /*horizontal padding */
    padding-left: 80px; /* left padding */
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

    <a href="admin.php" class="return-link"><i class="fas fa-arrow-left"></i> Return to Admin</a>
        <!-- added bootstrap navbar utility classes -->
        <nav class="navbar navbar-expand-sm w-100">

            <!-- using container-fluid for responsiveness -->
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenuItems" aria-controls="navbarMenuItems" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="homepage.php" class="navbar-brand logo">
                    <img src="images/Logo.png" alt="Shaded Logo">
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
                        <li class="nav-item dropdown">
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
                        </li>

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
                <img src="images/MK-2161BU-0001_1.jpeg" alt="<?= $item['product_name'] ?>">
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
<!-- lightmode/darkmode -->
    <div id="dark-mode-toggle">
        <a class="nav-link" href="#">
            <i class="fas fa-lightbulb"></i>
        </a>
    </div>

    <main>

    <div id="sun-icon">&#9728;</div>

    <div class="main-content">
            <h2>CUSTOMER ACCOUNTS</h2>

            <div class="container">
            <div class="table-container">  
<table>
        <tr>
        <th>Customer ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        </tr>
<?php
$fulltable=$db->prepare("SELECT customer_id, name FROM customerdetails WHERE name IS NOT NULL;");
$fulltable->execute();
while($row = $fulltable->fetch()){
    $link=$db->prepare("
    SELECT c.customer_id,c.name,c.default_address,l.username AS username, l.email AS email, l.password AS password
    FROM customerdetails c 
    JOIN logindetails l ON c.user_id=l.user_id
    WHERE customer_id={$row["customer_id"]};
    ");
    $userp=$db->prepare("
    SELECT c.customer_id,c.name,c.default_address,l.username AS username, l.email AS email, l.password AS password
    FROM customerdetails c 
    JOIN logindetails l ON c.user_id=l.user_id
    WHERE customer_id={$row["customer_id"]};
    ");
    $link->execute();
    $userp->execute();
    $userd=$userp->fetch();
    $details=json_encode($link->fetch(PDO::FETCH_ASSOC));
    echo("<tr><td>".$row["customer_id"]."</td><td>".$row["name"]."</td><td>".$userd["username"]."</td><td>".$userd["email"]);
}
?>
</table>
</div>
<br>
<div class="form-container">
<form name="edit-input" method="post" action="customerAccounts.php" >

    <select id="cid" name="cid">
    <option value="default">Enter Customer ID</option>
       <?php
        $cid_query = $db->prepare("SELECT customer_id, name FROM customerdetails WHERE name IS NOT NULL;");
        $cid_query->execute();
        $customer_ids = $cid_query->fetchAll(PDO::FETCH_COLUMN);
    
        foreach ($customer_ids as $customer_id) {
            echo '<option value="' . $customer_id . '">' . $customer_id . '</option>';
        }
       
       ?>
    </select>



    <select id="edit-field" name="edit-field">
        <option value="default">Enter Field</option>
        <option value="name">Name</option>
        <option value="default_address">Default Address</option>
        <option value="email">Email</option>
        <option value="username">Username</option>
        <option value="password">Password</option>

    </select>

    


    <input type="text" id="edit-input" name="edit-input" placeholder="Enter edit">

    

    <input type="submit" value="Submit" name="sub" id="sub">

</form>
    </div>
<?php
if(isset($_POST['sub'])){
$field=$_POST['edit-field'];
$cid=$_POST['cid'];
$val=$_POST['edit-input'];

if($cid=='default' ||$cid =='default'|| $val==null ){
    echo("please fill in all fields");
}else{
    $check=$db->prepare("SHOW COLUMNS FROM customerdetails LIKE '$field'");
    $check->execute();
    if($check->fetch()){
        $push=$db->prepare("UPDATE customerdetails SET $field = ? WHERE customer_id = $cid");
        $push->execute([$val]);
        header("Location: $_SERVER[PHP_SELF]");
        ob_end_flush();
        exit();
    } else{
        if($field=='password'){
            $val=password_hash($val,PASSWORD_DEFAULT);
            $push=$db->prepare("
            UPDATE logindetails AS l
            INNER JOIN customerdetails AS c ON l.user_id = c.user_id
            SET l.$field = ?
            WHERE c.customer_id = $cid
            ");
            $push->execute([$val]);
            header("Location: $_SERVER[PHP_SELF]");
            ob_end_flush();
            exit();

        }else{
        $push=$db->prepare("
        UPDATE logindetails AS l
        INNER JOIN customerdetails AS c ON l.user_id = c.user_id
        SET l.$field = ?
        WHERE c.customer_id = $cid
        ");
        $push->execute([$val]);
        header("Location: $_SERVER[PHP_SELF]");
        ob_end_flush();
        exit();
        }
    }

}


}

?>
<div class="form-container">
<form name="new-input" method="post" action="customerAccounts.php" >

<input type="text" name="inputEmail" placeholder="Email">
<input type="text" name="Username" placeholder="Username">
<input type="text" name="Name" placeholder="Name">
<input type="text" name="Address" placeholder="Address">
<input type="text" name="inputPassword" placeholder="password"><br>


<input type="submit" value="Create" name="new-sub">

</form>
</div>
<?php
if(isset($_POST['new-sub'])){
require_once('connectdb.php');
$email=$_POST['inputEmail'];
$user=$_POST['Username'];
$name=$_POST['Name'];
$pass=$_POST['inputPassword'];
$add=$_POST['Address'];
$auth="customer";
$pass=password_hash($pass,PASSWORD_DEFAULT);

if($email==null || $user==null || $name==null || $pass==null){
    echo("enter details");
}else{

$check=$db->prepare("SELECT * FROM logindetails WHERE username=?");
$check->bindParam(1,$user);
$check->execute();

if($check->rowCount()>0){
  echo ("Username already exists");
}else{
$rej=$db->prepare("INSERT INTO logindetails (username,password,email,authorization_level)value(?,?,?,?)");
$rej->bindParam(1,$user);
$rej->bindParam(2,$pass);
$rej->bindParam(3,$email);
$rej->bindParam(4,$auth);
if($rej->execute()){
  $id=$db->lastInsertId();
  $cdetails=$db->prepare("INSERT INTO customerdetails(user_id,name,default_address) value (?,?,?)");
  $cdetails->bindParam(1,$id);
  $cdetails->bindParam(2,$name);
  $cdetails->bindParam(3,$add);
  $cdetails->execute();
  echo("Successful");
  header("Location: $_SERVER[PHP_SELF]");
  ob_end_flush();
  exit();

}else{
  echo ("Unsuccessful");
}
}
}
}
?>

<div class="form-container">
<form name="delete-input" method="post" action="customerAccounts.php" >

<select id="cid" name="cid">
<option value="default">Enter Customer ID</option>
   <?php
    $cid_query = $db->prepare("SELECT customer_id, name FROM customerdetails WHERE name IS NOT NULL;");
    $cid_query->execute();
    $customer_ids = $cid_query->fetchAll(PDO::FETCH_COLUMN);

    foreach ($customer_ids as $customer_id) {
        echo '<option value="' . $customer_id . '">' . $customer_id . '</option>';
    }
   
   ?>
</select>
<input type="submit" value="Delete" name="del-sub">
</form>
</div>
<?php
if(isset($_POST['del-sub'])){
    $cid=$_POST['cid'];

    $delprev=$db->prepare("DELETE FROM previousorders WHERE customer_id = ?;");
    $delprev->bindParam(1,$cid);
    $delprev->execute();

    $delpend=$db->prepare("DELETE FROM pendingorders WHERE customer_id = ?;");
    $delpend->bindParam(1,$cid);
    $delpend->execute();

    $delbask=$db->prepare("DELETE FROM basket WHERE customer_id = ?;");
    $delbask->bindParam(1,$cid);
    $delbask->execute();

    $delcust=$db->prepare("DELETE FROM customerdetails WHERE customer_id = ?;");
    $delcust->bindParam(1,$cid);
    $delcust->execute();
	
	
    $del=$db->prepare("DELETE FROM logindetails
                       WHERE user_id IN (SELECT user_id FROM customerdetails WHERE customer_id=?) ");
    $del->bindParam(1,$cid);
	$del->execute();

    header("Location: $_SERVER[PHP_SELF]");
    ob_end_flush();
    exit();

}
?>
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

     <div class="form-container">



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

</body>
