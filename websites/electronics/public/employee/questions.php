<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();

$filter = $_GET['filter'] ?? null;

if($filter && $filter == 'answered') {
    $questions = find($pdo, 'questions', 'answered', '1');

} else if($filter && $filter == 'unanswered') {
    $questions = find($pdo, 'questions', 'answered', '0');
} else {
    $questions = findAll($pdo, 'questions', 'id', 'desc');
}


$output = loadTemplate('../../templates/employee/questions.html.php', [
    'reviews' => $questions
]);

$title = 'Questions';
require '../../templates/layout.html.php';