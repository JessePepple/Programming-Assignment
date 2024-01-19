<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();
$productId = $_GET['id'] ?? 0;

$product = find($pdo, 'products', 'id', $productId);

if(!$product) {
    flash('error', 'Product not found!');
    redirect('products.php');
}

try {
    delete($pdo, 'products', $productId);
    flash('success', 'Product deleted successfully.');
    redirect('products.php');
} catch (\Throwable $th) {
    flash('error', 'An internal error occurred, please contact administrator if error persists: '
            . $th->getMessage());
    redirect('products.php');
}