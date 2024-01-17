<?php
require '../dbconnection.php';
require '../loadTemplate.php';

$catId = $_GET['id'] ?? 0;

$category = find($pdo, 'categories', 'id', $catId);

if(!$category) {
    flash('error', 'Category not found!');
    back();
}

$products = find($pdo, 'products', 'category_id', $catId);

$output = loadTemplate('../templates/category.html.php', [
    'products' => $products,
    'category' => $category[0]
]);

$title = 'Category';
require '../templates/layout.html.php';