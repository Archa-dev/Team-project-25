<?php
// Include database connection file
require_once 'connectdb.php';
session_start();

// Initialize an empty array to store wishlist data
$wishlistData = [];

// Check if the user is logged in
if (isset($_SESSION['customer_id'])) {
    // Retrieve customer ID from session
    $customerId = $_SESSION['customer_id'];
    // Prepare and execute SQL query to fetch wishlist items for the logged-in customer
    $query = $db->prepare('SELECT * FROM `wishlist` WHERE `customer_id` = ?');
    $query->bindParam(1, $customerId);
    $query->execute();
    
    // Fetch wishlist data and store it in an associative array
    $wishlistData = $query->fetchAll(PDO::FETCH_ASSOC);
}

// Output wishlist data as JSON
echo json_encode($wishlistData);
?>
