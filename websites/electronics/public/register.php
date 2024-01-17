<?php
require '../dbconnection.php';
require '../loadTemplate.php';

if(isSubmitted()) {
	formRequire('fullname', 'email', 'password', 'password_confirm');

    if(oldValue('password') != oldValue('password_confirm')) {
        flash('validation',"Your passwords don't match!", true);
    }

    // make sure email doesn't exist already
    $emailExists = find($pdo, 'users', [['email', '=', oldValue('email')]]);

    if($emailExists) {
        flash('validation',"Email already exists!", true);
    }

	if(isValid()) {
        $passHash = password_hash(oldValue('password'), PASSWORD_DEFAULT);

        try {
            insert($pdo, 'users', [
                'name' => oldValue('fullname'),
                'email' => oldValue('email'),
                'password' => $passHash,
            ]);

            flash('success', 'You have registered successfully, please login');
            redirect('login.php');

        } catch (\Exception $e) {
            flash('error', 'An internal server error occurred, please contact administrator: ' . $e->getMessage());
        }
	}
}
$output = loadTemplate('../templates/register.html.php');
$title = 'Register';

require '../templates/layout.html.php';