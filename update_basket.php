<?php
session_start();
require_once('connectdb.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $customer_id = $_SESSION['customer_id'];

    // Update the basket in the database
    $updateItem = $db->prepare('UPDATE basket SET quantity = ? WHERE product_id = ? AND customer_id = ?');
    $updateItem->bindParam(1, $quantity);
    $updateItem->bindParam(2, $product_id);
    $updateItem->bindParam(3, $customer_id);
    
    // Check if the update was successful
    if ($updateItem->execute()) {
        // Update successful
        $response = array('success' => true, 'message' => 'Basket updated successfully');
    } else {
        // Update failed
        $response = array('success' => false, 'message' => 'Failed to update basket');
    }

    echo json_encode($response);
} else {
    // Handle other types of requests if needed
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Method not allowed'));
}
?>
