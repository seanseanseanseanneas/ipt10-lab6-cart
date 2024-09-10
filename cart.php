<?php
session_start();
require "products.php";

// Initialize cart items
$cart_items = [];
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id) {
        foreach ($products as $product) {
            if ($product['id'] == $product_id) {
                $cart_items[] = $product;
                break;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <ul>
        <?php if (!empty($cart_items)): ?>
            <?php foreach ($cart_items as $item): ?>
                <li>
                    <?php echo $item['name']; ?> - <?php echo $item['price']; ?> PHP
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Your cart is empty.</li>
        <?php endif; ?>
    </ul>

    <a href="reset-cart.php">Clear my cart</a>
    <a href="place_order.php">Place the order</a>
</body>
</html>
