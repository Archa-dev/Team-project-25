<?php
    session_start();
    require_once('connectdb.php');
    $customerid = $_SESSION['customer_id'];
    $getUserID = $db->prepare('SELECT user_id FROM customerdetails WHERE customer_id = ?');
    $getUserID->bindParam(1, $customerid);
    $getUserID->execute();
    $userid = $getUserID->fetchColumn();
    $productSelected = $_POST['productSelected'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $removeDupe = $db->prepare('DELETE FROM productreviews WHERE product_id = ? AND user_id = ?');
    $removeDupe->bindParam(1, $productSelected);
    $removeDupe->bindParam(2, $userid);
    $removeDupe->execute();
    $addReview = $db->prepare('INSERT INTO productreviews VALUES(?,?,?,?)');
    $addReview->bindParam(1, $productSelected);
    $addReview->bindParam(2, $userid);
    $addReview->bindParam(3, $rating);
    $addReview->bindParam(4, $review);
    $addReview->execute();
?>