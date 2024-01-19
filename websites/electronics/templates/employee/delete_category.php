<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();

$catId = $_GET['id'] ?? 0;

$category = find($pdo, 'categories', 'id', $catId);

if(!$category) {
    flash('error', 'Category not found!');
    redirect('categories.php');
}

try {

    // we delete all products in this category before deleting the category
    delete($pdo, 'products', $catId, 'category_id');
    delete($pdo, 'categories', $catId);
    flash('success', 'Category deleted successfully.');
    redirect('categories.php');
} catch (\Throwable $th) {
    flash('error', 'An internal error occurred, please contact administrator if error persists: '
            . $th->getMessage());
    redirect('categories.php');
}