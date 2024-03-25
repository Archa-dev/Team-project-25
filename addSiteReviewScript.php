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
    $removeDupe->bindParam(1, $userid);
    $removeDupe->execute();
    $addReview = $db->prepare('INSERT INTO sitereviews (user_id, star_rating, review_text) VALUES (?, ?, ?)');
    $addReview->bindParam(1, $userid, PDO::PARAM_INT);
    $addReview->bindParam(2, $rating, PDO::PARAM_INT);
    $addReview->bindParam(3, $review, PDO::PARAM_STR);
    $addReview->execute();
?>