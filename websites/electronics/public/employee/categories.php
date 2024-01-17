<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();

$output = loadTemplate('../../templates/employee/categories.html.php', [
    'categories' => $navCategories
]);

$title = 'Categories';
require '../../templates/layout.html.php';