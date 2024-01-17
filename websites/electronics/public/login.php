<?php
require '../dbconnection.php';
require '../loadTemplate.php';

if(isSubmitted()) {
	formRequire('email', 'password');

	if(isValid()) {
		$data = ['email' => $_POST['email'], 'password' => $_POST['password']];
		$login = find($pdo, 'users', [['email', '=', $data['email']]]);

		if($login) {
            if(!password_verify(oldValue('password'), $login[0]['password'])) {
				flash('error', 'Wrong password, please try again');
			} else {
				flash('success', 'You have logged in successfully');
				flash('loggedin', true);
				flash('rank', $login[0]['rank']);
				flash('id', $login[0]['id']);
				redirect('index.php');
			}
		
		} else {
			flash('error', 'Email does not exist in our records');
		}
	}
}
$output = loadTemplate('../templates/login.html.php', ['loggedin' => $_SESSION['loggedin'] ?? false]);
$title = 'Login';
require '../templates/layout.html.php';