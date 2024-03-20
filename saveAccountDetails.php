<?php
session_start();
require_once('connectdb.php');
$customerid = $_SESSION['customer_id'];
$accountName = $_POST['accountName'];
$address = $_POST['address'];
$email = $_POST['email'];
$addInfoToDB = $db->prepare('UPDATE customerdetails SET name = ?, default_address = ? WHERE customer_id = ?');
$addInfoToDB->bindParam(1, $accountName);
$addInfoToDB->bindParam(2, $address);
$addInfoToDB->bindParam(3, $customerid);
$addInfoToDB->execute();
$addInfoToDB = $db->prepare('UPDATE logindetails SET email = ? WHERE customer_id = ?');
$addInfoToDB->bindParam(1, $email);
$addInfoToDB->bindParam(2, $customerid);
$addInfoToDB->execute();