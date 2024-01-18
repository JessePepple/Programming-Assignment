<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();
if(isSubmitted()) {
	formRequire('name');

	if(isValid()) {
		$data = ['name' => $_POST['name']];
		$categoryExists = find($pdo, 'categories', [['name', '=', $data['name']]]);

		if(!$categoryExists) {
            
            try {
                $category = insert($pdo, 'categories', $data);
                
                flash('success', 'Category created successfully.');
                redirect('add_category.php');
            } catch (\Throwable $th) {
                flash('error', 'An internal error occurred, please contact administrator if error persists: '
                    . $th->getMessage());
            }
		
		} else {
			flash('error', 'Category name already exists, please try another name');
		}
	}
}
$output = loadTemplate('../../templates/employee/add_category.html.php', [
    'loggedin' => $_SESSION['loggedin'] ?? false
]);
$title = 'Add Category';
require '../../templates/layout.html.php';