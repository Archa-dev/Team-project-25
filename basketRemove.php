<?php
    session_start();
    require_once('connectdb.php');
    $customerid = $_SESSION['customer_id'];
    $id = $_REQUEST['id'];
    $removeItem = $db->prepare('DELETE FROM basket WHERE product_id = ? AND customer_id = ?');
    $removeItem->bindParam(1, $id);
    $removeItem->bindParam(2, $customerid);
    $removeItem->execute();
?>