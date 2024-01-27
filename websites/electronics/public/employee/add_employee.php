<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();

if(isSubmitted()) {
	formRequire('fullname', 'email', 'password');

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
                'rank' => '1'
            ]);

            flash('success', 'Employee added successfully. They can now login.');
            redirect('add_employee.php');

        } catch (\Exception $e) {
            flash('error', 'An internal server error occurred, please contact administrator: ' . $e->getMessage());
        }
	}
}
$output = loadTemplate('../../templates/employee/add_employee.html.php');
$title = 'Add Employee';

require '../../templates/layout.html.php';