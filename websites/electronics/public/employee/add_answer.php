<?php
require '../../dbconnection.php';

adminLock();

if(!isSubmitted()) {
    flash('error', 'Invalid request!');
    back();
}

formRequire('message', 'question_id');

if(!isValid()) {
    back();
}

$question = find($pdo, 'questions', 'id', oldValue('question_id'));

if(!$question) {
    flash('error', 'Question was not found!');
    back();
}

try {
    $user = [];

    if(isset($_SESSION['id'])) {
        $user = find($pdo, 'users', 'id', $_SESSION['id']);
    }

    insert($pdo, 'answers', [
        'answered_by' => $user ? $user[0]['id'] : '0',
        'message' => oldValue('message'),
        'question_id' => oldValue('question_id')
    ]);

    // notify user of the added answer

    $to = $question[0]['email'];
    $subject = "An answer has been added to your question.";
    $msg = wordwrap(oldValue('message'), 70);

    mail($to, $subject, $msg);

    // update this question to show it has been answered
    update($pdo, 'questions', ['id' => oldValue('question_id'), 'answered' => '1'], 'id');
        
    flash('success', "Answer added successfully.");
    back();

} catch (\Throwable $th) {
    flash('error', 'An internal error occurred, please contact administrator if error persists: '
            . $th->getMessage());
    
    back();
}