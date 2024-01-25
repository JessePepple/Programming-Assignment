<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();
$employees = find($pdo, 'users', [
    ['rank', '=', '1'],
    ['id', '>', '1'],
]);

$output = loadTemplate('../../templates/employee/employees.html.php', [
    'employees' => $employees
]);

$title = 'Employees';
require '../../templates/layout.html.php';