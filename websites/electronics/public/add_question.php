<?php
require '../dbconnection.php';

if(!isSubmitted()) {
    flash('error', 'Invalid request!');
    back();
}

formRequire('email', 'message', 'product_id');

if(!isValid()) {
    back();
}

try {
    insert($pdo, 'questions', [
        'email' => oldValue('email'),
        'message' => oldValue('message'),
        'product_id' => oldValue('product_id')
    ]);

    // notify all admin users about the added question
    $admins = find($pdo, 'users', 'rank', '1');

    if($admins) {
        foreach($admins as $admin) {
            $to = $admin['email'];
            $subject = "A New question was asked.";
            $msg = "Login to see all questions";

            mail($to, $subject, $msg);
        }
    }
    flash('success', "Review added successfully, your review will be visible once approved.");
    redirect('product.php?id=' . oldValue('product_id'));

} catch (\Throwable $th) {
    flash('error', 'An internal error occurred, please contact administrator if error persists: '
            . $th->getMessage());
    
    back();
}