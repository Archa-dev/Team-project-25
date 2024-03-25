<?php
require_once('connectdb.php');
session_start();
$orderid = $_POST['order_id'];
$getOrderDetails = $db->prepare("SELECT * FROM pendingorders WHERE order_id = ?");
$getOrderDetails->execute([$orderid]);
$orderDetails = $getOrderDetails->fetch(PDO::FETCH_ASSOC);
$addOrderToPrevious = $db->prepare("INSERT INTO previousorders (customer_id, product_id, shipping_address, quantity) VALUES (?, ?, ?, ?)");
$addOrderToPrevious->bindParam(1, $orderDetails['customer_id']);
$addOrderToPrevious->bindParam(2, $orderDetails['product_id']);
$addOrderToPrevious->bindParam(3, $orderDetails['shipping_address']);
$addOrderToPrevious->bindParam(4, $orderDetails['quantity']);
$addOrderToPrevious->execute();
$removeOrder = $db->prepare("DELETE FROM pendingorders WHERE order_id = ?");
$removeOrder->execute([$orderid]);
echo "Order status updated successfully!";