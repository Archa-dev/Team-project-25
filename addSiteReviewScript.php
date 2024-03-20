<?php
    session_start();
    require_once('connectdb.php');
    $customerid = $_SESSION['customer_id'];
    $getUserID = $db->prepare('SELECT user_id FROM customerdetails WHERE customer_id = ?');
    $getUserID->bindParam(1, $customerid);
    $getUserID->execute();
    $userid = $getUserID->fetchColumn();
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $removeDupe = $db->prepare('DELETE FROM sitereviews WHERE user_id = ?');
    $removeDupe->bindParam(1, $productSelected);
    $removeDupe->bindParam(2, $userid);
    $removeDupe->execute();
    $addReview = $db->prepare('INSERT INTO sitereviews VALUES(?,?,?)');
    $addReview->bindParam(1, $userid);
    $addReview->bindParam(2, $rating);
    $addReview->bindParam(3, $review);
    $addReview->execute();
?>