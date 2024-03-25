<?php
// Include the file that handles the database connection
require_once 'connectdb.php';

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data sent from the update product form
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productStock = $_POST['productStock'];
    $productColor = $_POST['productColor'];
    $productCategory = $_POST['productCategory'];

    // Perform any necessary validation or sanitization on the received data

    try {
        // Prepare SQL statement for fetching existing product details
        $stmt = $db->prepare("SELECT * FROM productdetails WHERE product_id = :productId");

        // Bind parameter
        $stmt->bindParam(':productId', $productId);

        // Execute the statement
        $stmt->execute();

        // Fetch existing product details
        $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

        // Use existing values if corresponding form fields are empty
        $productName = empty($productName) ? $existingProduct['product_name'] : $productName;
        $productPrice = empty($productPrice) ? $existingProduct['price'] : $productPrice;
        $productStock = empty($productStock) ? $existingProduct['stock'] : $productStock;
        $productColor = empty($productColor) ? $existingProduct['colour'] : $productColor;
        $productCategory = empty($productCategory) ? $existingProduct['category'] : $productCategory;

        // Prepare SQL statement for updating the product
        $stmt = $db->prepare("UPDATE productdetails SET product_name = :productName, price = :productPrice, stock = :productStock, colour = :productColor, category = :productCategory WHERE product_id = :productId");

        // Bind parameters
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':productPrice', $productPrice);
        $stmt->bindParam(':productStock', $productStock);
        $stmt->bindParam(':productColor', $productColor);
        $stmt->bindParam(':productCategory', $productCategory);
        $stmt->bindParam(':productId', $productId);

        // Execute the update statement
        $stmt->execute();

        // Optionally, you can return a success message or redirect to another page
        echo "Product updated successfully";
        
        $imageFileName = "ImagesForProducts/" . $existingProduct['product_id'] . "_" . str_replace(' ', '_', $existingProduct['product_name']) . ".avif";
        $newImageFileName = "ImagesForProducts/" . $existingProduct['product_id'] . "_" . str_replace(' ', '_', $productName) . ".avif";


if (rename($imageFileName, $newImageFileName)) {
    echo "File name changed successfully.";
} else {
    echo "Error renaming file.";
}


    } catch(PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // If the request is not a POST request, return an error message
    echo "Invalid request method";
}
?>
