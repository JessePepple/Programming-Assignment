<?php
require '../dbconnection.php';
require '../loadTemplate.php';

$productId = $_GET['id'] ?? 0;

$product = find($pdo, 'products', 'id', $productId);

if(!$product) {
    flash('error', 'Product not found!');
    back();
}

$category = find($pdo, 'categories', 'id', $product[0]['category_id']);

if(!$category) {
    flash('error', 'Product category not found!');
    back();
}

$user = [];

if(isset($_SESSION['id'])) {
    $user = find($pdo, 'users', 'id', $_SESSION['id']);
}

$reviews = find($pdo, 'questions', [
    ['product_id', '=', $productId],
    ['status', '=', '1']
]);

$output = loadTemplate('../templates/product.html.php', [
    'product' => $product[0],
    'category' => $category[0],
    'user' => $user[0] ?? [],
    'reviews' => $reviews,
    'pdo' => $pdo
]);

$title = 'Product';
require '../templates/layout.html.php';