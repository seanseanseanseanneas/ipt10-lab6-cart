<?php
session_start();
require "products.php";

// Add to cart logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    
    // Check if product exists
    $product_exists = false;
    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            $product_exists = true;
            break;
        }
    }

    if ($product_exists) {
        // Add product to cart
        $_SESSION['cart'][] = $product_id;
    }
}

// Redirect to the cart page
header("Location: cart.php");
exit;
?>
