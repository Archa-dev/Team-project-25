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

