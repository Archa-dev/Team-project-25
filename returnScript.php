<?php
require_once('connectdb.php');
session_start();
$reason = $_POST['reason'];
$orderid = $_POST['orderid'];
var_dump($reason, $orderid);
$addReturnToDB = $db->prepare("INSERT INTO returnrequests (order_id, reason) VALUES (?, ?)");
$addReturnToDB->bindValue(1, $orderid);
$addReturnToDB->bindValue(2, $reason);
$addReturnToDB->execute();