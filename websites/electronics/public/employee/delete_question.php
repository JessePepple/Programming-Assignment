<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();
$questionId = $_GET['id'] ?? 0;

$question = find($pdo, 'questions', 'id', $questionId);

if(!$question) {
    flash('error', 'Question not found!');
    back();
}

try {
    // delete all answers under this question
    delete($pdo, 'answers', $questionId, 'question_id');
    delete($pdo, 'questions', $questionId);
    flash('success', 'Question deleted successfully.');
    back();
} catch (\Throwable $th) {
    flash('error', 'An internal error occurred, please contact administrator if error persists: '
            . $th->getMessage());
    back();
}