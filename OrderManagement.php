<?php
// Include database connection
require_once('connectdb.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Loop through each product
    foreach ($_POST['amount'] as $productId => $newAmount) {
        // Update the stock amount in the database
        $stmt = $db->prepare("UPDATE productdetails SET stock = :newAmount WHERE product_id = :productId");
        $stmt->bindParam(':newAmount', $newAmount, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
    }
    echo "Stock amounts updated successfully!";
}

// Fetch product details from the database
$stmt = $db->prepare("SELECT * FROM productdetails");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Product Amounts</title>
</head>
<body>
    <h1>Change Product Amounts</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php foreach ($products as $product): ?>
            <label for="amount_<?php echo $product['product_id']; ?>">
                <?php echo $product['product_name']; ?> Stock Amount:
            </label>
            <input type="number" id="amount_<?php echo $product['product_id']; ?>" name="amount[<?php echo $product['product_id']; ?>]" value="<?php echo $product['stock']; ?>" min="0"><br>
        <?php endforeach; ?>
        <button type="submit">Update Stock Amounts</button>
    </form>
</body>
</html>
