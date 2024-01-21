<?php
require '../dbconnection.php';
require '../loadTemplate.php';

userLock();

$filter = $_GET['filter'] ?? null;

$userId = $_SESSION['id'] ?? 0;
$user = find($pdo, 'users', 'id', $userId);

if(!$user) {
    flash('error', 'You must be logged in');
    back();

}
$questions = find($pdo, 'questions', 'email', $user[0]['email']);

$output = loadTemplate('../templates/questions.html.php', [
    'reviews' => $questions
]);

$title = 'Questions';
require '../templates/layout.html.php';