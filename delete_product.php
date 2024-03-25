<?php
require_once('connectdb.php');
$product_id = $_POST['productId'];
var_dump($product_id);
$sql = $db->prepare("DELETE FROM productdetails WHERE product_id = ?");
$sql->bindParam(1, $product_id);
$sql->execute();