<?php
    session_start();
    require_once('connectdb.php');
    // $customerid = $_SESSION['customer_id'];
    $customerid = 1;
    $productSelected = $_POST['productSelected'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $addReview = $db->prepare('INSERT INTO productreviews VALUES(?,?,?,?)');
    $addReview->bindParam(1, $productSelected);
    $addReview->bindParam(2, $customerid);
    $addReview->bindParam(3, $rating);
    $addReview->bindParam(4, $review);
    $addReview->execute();
?>