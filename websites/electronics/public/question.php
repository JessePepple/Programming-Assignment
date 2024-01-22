<?php
require '../dbconnection.php';
require '../loadTemplate.php';

$questionId = $_GET['id'] ?? 0;

$question = find($pdo, 'questions', 'id', $questionId);

if(!$question) {
    flash('error', 'Question not found!');
    back();
}

$product = find($pdo, 'products', 'id', $question[0]['product_id']);

if(!$product) {
    flash('error', 'Question product not found!');
    back();
}

$user = [];

if(isset($_SESSION['id'])) {
    $user = find($pdo, 'users', 'id', $_SESSION['id']);
}

$sql = "SELECT
    users.email,
    answers.*
 FROM answers INNER JOIN users ON answers.answered_by = users.id WHERE
 answers.question_id = :value";

$stmt = $pdo->prepare($sql);
$stmt->execute(['value' => $questionId]);

$answers = $stmt->fetchAll();

$output = loadTemplate('../templates/question.html.php', [
    'question' => $question[0],
    'product' => $product[0],
    'user' => $user[0] ?? [],
    'answers' => $answers,
]);

$title = 'Question';
require '../templates/layout.html.php';