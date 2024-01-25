<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();
$empId = $_GET['id'] ?? 0;

$employee = find($pdo, 'users', 'id', $empId);

if(!$employee) {
    flash('error', 'Employee not found!');
    back();
}

if(isSubmitted()) {
	formRequire('fullname', 'email');

    // make sure email doesn't exist already
    $emailExists = find($pdo, 'users', [['email', '=', oldValue('email')], ['id', '<>', oldValue('employee_id')]]);

    if($emailExists) {
        flash('validation',"Email already exists!", true);
    }

	if(isValid()) {
        $passHash = password_hash(oldValue('password'), PASSWORD_DEFAULT);

        try {
            update($pdo, 'users', [
                'name' => oldValue('fullname'),
                'email' => oldValue('email'),
                'id' => oldValue('employee_id')
            ], 'id');

            if(oldValue('password') != null) {

                // when password is set we change the employee password
                $passHash = password_hash(oldValue('password'), PASSWORD_DEFAULT);

                update($pdo, 'users', [
                    'password' => $passHash,
                    'id' => oldValue('employee_id')
                ], 'id');
            }

            flash('success', 'Employee updated successfully. They can now login.');
            redirect('edit_employee.php?id='. oldValue('employee_id'));

        } catch (\Exception $e) {
            flash('error', 'An internal server error occurred, please contact administrator: ' . $e->getMessage());
        }
	}
}
$output = loadTemplate('../../templates/employee/edit_employee.html.php', ['employee' => $employee[0]]);
$title = 'Edit Employee';

require '../../templates/layout.html.php';