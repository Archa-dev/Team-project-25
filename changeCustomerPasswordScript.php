<?php
session_start();
require_once('connectdb.php');
$customer_id = $_SESSION['customer_id'];
$newPassword = $_POST['newPassword'];
$newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
$changePassword = $db->prepare('UPDATE logindetails SET password = ? WHERE customer_id = ?');
$changePassword->bindParam(1, $newPassword);
$changePassword->bindParam(2, $customer_id);
$changePassword->execute();
