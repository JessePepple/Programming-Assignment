<?php
require '../dbconnection.php';
require '../loadTemplate.php';


$products = homeListing($pdo);
$data = ['title' => 'Home', 'products' => $products];
$output = loadTemplate('../templates/index.html.php', $data);
$title = 'Home';
require '../templates/layout.html.php';