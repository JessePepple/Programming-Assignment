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
    update($pdo, 'questions', [
        'status' => '1',
        'id' => $questionId
    ], 'id');

    flash('success', 'Question has been approved successfully.');
    back();

} catch (\Throwable $th) {
    flash('error', 'An internal error occurred, please contact administrator if error persists: '
    . $th->getMessage());

    back();
}