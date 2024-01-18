<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();

$catId = $_GET['id'] ?? 0;

$category = find($pdo, 'categories', 'id', $catId);

if(!$category) {
    flash('error', 'Category not found!');
    redirect('categories.php');
}

if(isSubmitted()) {
	formRequire('name');

	if(isValid()) {
		$data = ['name' => $_POST['name'], 'id' => $catId];
		$categoryExists = find($pdo, 'categories', [
            ['name', '=', $data['name']],
            ['id', '<>', $catId]
        ]);

		if(!$categoryExists) {
            
            try {
                $category = update($pdo, 'categories', $data,'id');
                
                flash('success', 'Category updated successfully.');
                redirect('edit_category.php?id=' . $catId);
            } catch (\Throwable $th) {
                flash('error', 'An internal error occurred, please contact administrator if error persists: '
                    . $th->getMessage());
            }
		
		} else {
			flash('error', 'Category name already exists, please try another name');
		}
	}
}
$output = loadTemplate('../../templates/employee/edit_category.html.php', [
    'id' => $catId,
    'category' => $category[0],
]);

$title = 'Edit Category';
require '../../templates/layout.html.php';