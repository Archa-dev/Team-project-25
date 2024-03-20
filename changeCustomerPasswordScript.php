<?php
session_start();
require_once('connectdb.php');
$customer_id = $_SESSION['customer_id'];
$getUserID = $db->prepare('SELECT user_id FROM customerdetails WHERE customer_id = ?');
$getUserID->bindParam(1, $customer_id);
$getUserID->execute();
$userid = $getUserID->fetch();
$newPassword = $_POST['newPassword'];
$newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
$changePassword = $db->prepare('UPDATE logindetails SET password = ? WHERE user_id = ?');
$changePassword->bindParam(1, $newPassword);
$changePassword->bindParam(2, $userid['user_id']);
$changePassword->execute();
