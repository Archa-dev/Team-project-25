<?php
require_once('connectdb.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (isset($_SESSION['customer_id'])) {
        $customerId = $_SESSION['customer_id'];
        $data = json_decode(file_get_contents('php://input'), true);
        $productId = $data['productId'];

        // Check if the product is already in the wishlist
        $checkQuery = $db->prepare("SELECT COUNT(*) FROM wishlist WHERE customer_id = ? AND product_id = ?");
        $checkQuery->execute([$customerId, $productId]);
        $count = $checkQuery->fetchColumn();

        if ($count == 0) {
            // Add product to wishlist
            $insertQuery = $db->prepare("INSERT INTO wishlist (customer_id, product_id) VALUES (?, ?)");
            $insertQuery->execute([$customerId, $productId]);
            echo json_encode(['success' => true]);
        } else {
            // Remove product from wishlist
            $deleteQuery = $db->prepare("DELETE FROM wishlist WHERE customer_id = ? AND product_id = ?");
            $deleteQuery->execute([$customerId, $productId]);
            echo json_encode(['success' => true]);
        }
    } else {
        // User is not logged in
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
    }
}
?>
