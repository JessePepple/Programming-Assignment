<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();
$products = findAll($pdo, 'products', 'id', 'DESC');

$output = loadTemplate('../../templates/employee/products.html.php', [
    'products' => $products
]);

$title = 'Products';
require '../../templates/layout.html.php';