<?php
session_start();
require_once('connectdb.php');
$adminUsername = $_POST['adminName'];
$newPassword = $_POST['newPassword'];
$newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
$getAdminID = $db->prepare('SELECT user_id FROM logindetails WHERE username = ?');
$getAdminID->bindParam(1, $adminUsername);
$getAdminID->execute();
$adminID = $getAdminID->fetch();
$changePassword = $db->prepare('UPDATE logindetails SET password = ? WHERE user_id = ?');
$changePassword->bindParam(1, $newPassword);
$changePassword->bindParam(2, $adminID['user_id']);
$changePassword->execute();
