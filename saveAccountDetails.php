<?php
session_start();
require_once('connectdb.php');
$newPassword = "";
$customerid = $_SESSION['customer_id'];
$newPassword = $_POST['newPassword'];
$accountName = $_POST['accountName'];
$address = $_POST['address'];
$email = $_POST['email'];
$addInfoToDB = $db->prepare('UPDATE customerdetails SET name = ?, default_address = ? WHERE customer_id = ?');
$addInfoToDB->bindParam(1, $accountName);
$addInfoToDB->bindParam(2, $address);
$addInfoToDB->bindParam(3, $customerid);
$addInfoToDB->execute();
$getUserID = $db->prepare('SELECT user_id FROM customerdetails WHERE customer_id = ?');
$getUserID->bindParam(1, $customerid);
$getUserID->execute();
$userid = $getUserID->fetch();
$addInfoToDB = $db->prepare('UPDATE logindetails SET email = ? WHERE user_id = ?');
$addInfoToDB->bindParam(1, $email);
$addInfoToDB->bindParam(2, $userid['user_id']);
$addInfoToDB->execute();

if ($newPassword != "") {
    $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $changePassword = $db->prepare('UPDATE logindetails SET password = ? WHERE user_id = ?');
    $changePassword->bindParam(1, $newPassword);
    $changePassword->bindParam(2, $userid['user_id']);
    $changePassword->execute();
}
?>