<?php
session_start();
require "products.php";

// Generate a unique order code
$order_code = uniqid('order_');

// Retrieve cart items from session
$cart = $_SESSION['cart'];

// Initialize total price
$total_price = 0;

// Prepare order details
$order_details = "Order Code: $order_code\n";
$order_details .= "Date and Time: " . date('Y-m-d H:i:s') . "\n\n";
$order_details .= "Order Items:\n";

// Fetch product details
foreach ($cart as $product_id) {
    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            $order_details .= "Product ID: " . $product['id'] . "\n";
            $order_details .= "Product Name: " . $product['name'] . "\n";
            $order_details .= "Price: " . number_format($product['price'], 2) . " PHP\n\n";
            $total_price += $product['price'];
        }
    }
}

// Add total price to order details
$order_details .= "Total Price: " . number_format($total_price, 2) . " PHP\n";

// Save order details to a file
file_put_contents("orders-{$order_code}.txt", $order_details);

// Clear the cart
$_SESSION['cart'] = [];

// Display order confirmation
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>
    <p>Order Code: <?php echo htmlspecialchars($order_code); ?></p>
    <p>Date and Time: <?php echo date('Y-m-d H:i:s'); ?></p>
    <h2>Order Summary</h2>
    <ul>
        <?php foreach ($cart as $product_id): ?>
            <?php foreach ($products as $product): ?>
                <?php if ($product['id'] == $product_id): ?>
                    <li>
                        Product Name: <?php echo htmlspecialchars($product['name']); ?><br>
                        Price: <?php echo number_format($product['price'], 2); ?> PHP
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </ul>
    <p>Total Price: <?php echo number_format($total_price, 2); ?> PHP</p>
    <a href="index.php">Return to Shop</a>
</body>
</html>
