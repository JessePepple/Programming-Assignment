<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();
$employeeId = $_GET['id'] ?? 0;

$employee = find($pdo, 'users', 'id', $employeeId);

if(!$employee) {
    flash('error', 'Employee not found!');
    redirect('employees.php');
}

try {
    delete($pdo, 'users', $employeeId);
    flash('success', 'Employee deleted successfully.');
    redirect('employees.php');
} catch (\Throwable $th) {
    flash('error', 'An internal error occurred, please contact administrator if error persists: '
            . $th->getMessage());
    redirect('employees.php');
}