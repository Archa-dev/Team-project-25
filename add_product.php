<?php
require_once('connectdb.php');

$productName = $_POST['productName'];
$productPrice = $_POST['productPrice'];
$productCategory = $_POST['productCategory'];
$productColor = $_POST['productColor'];
var_dump($productName, $productPrice, $productCategory, $productColor);

$stmt = $db->prepare("INSERT INTO productdetails (product_name, price, category, colour, stock) VALUES (?, ?, ?, ?, 20)");
$stmt->bindParam(1, $productName);
$stmt->bindParam(2, $productPrice);
$stmt->bindParam(3, $productCategory);
$stmt->bindParam(4, $productColor);
$stmt->execute();