<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();
if(isSubmitted()) {
	formRequire('name', 'category', 'description', 'price');

    if(isset($_POST['price']) && is_nan($_POST['price'])) {
        flash('validation',"Price must be a number!", true);
    }

	if(isValid()) {

        $newFileName =  '';

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
    
            // uploaded file details
        
            $fileTmpPath = $_FILES['image']['tmp_name'];
        
            $fileName = $_FILES['image']['name'];
        
            $fileSize = $_FILES['image']['size'];
        
            $fileType = $_FILES['image']['type'];
        
            $fileNameCmps = explode(".", $fileName);
        
            $fileExtension = strtolower(end($fileNameCmps));
        
            // removing extra spaces
        
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        
            // file extensions allowed
        
            $allowedfileExtensions = ['jpg', 'gif', 'png', 'webp', 'jpeg', 'JPG', 'GIF', 'PNG'];
        
            if (in_array($fileExtension, $allowedfileExtensions)){
            
                $uploadFileDir = '/websites/electronics/public/uploads';
        
                $destPath = $uploadFileDir . '/' . $newFileName;
        
                try {
                    move_uploaded_file($fileTmpPath, $destPath);
                    flash('success', 'File uploaded successfully.');
                } catch (\Throwable $th) {
                    flash('message', 'An internal error occured, contact administrator if error persists: '
                    . $th->getMessage());
                }
                
            }
        }

		$data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'image' => $newFileName,
            'category_id' => $_POST['category'],
            'price' => $_POST['price'], 
            'manufacturer' => $_POST['manufacturer'],
        ];
       
        try {
            $product = insert($pdo, 'products', $data);
            
            flash('success', 'Product created successfully.');
            redirect('add_product.php');
        } catch (\Throwable $th) {
            flash('error', 'An internal error occurred, please contact administrator if error persists: '
                . $th->getMessage());
        }
	
	}
}
$output = loadTemplate('../../templates/employee/add_product.html.php', [
    'categories' => $navCategories
]);
$title = 'Add Product';
require '../../templates/layout.html.php';