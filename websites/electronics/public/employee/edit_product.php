<?php
require '../../dbconnection.php';
require '../../loadTemplate.php';

adminLock();
$productId = $_GET['id'] ?? 0;
$product = find($pdo, 'products', 'id', $productId);

if(!$productId || !$product) {
    flash('error', 'Product not found!');
    redirect('products.php');
}

if(isSubmitted()) {
	formRequire('name', 'category', 'description', 'price');

    if(isset($_POST['price']) && !is_numeric($_POST['price'])) {
        flash('validation',"Price must be a number!", true);
    }

	if(isValid()) {

        $newFileName =  null;

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
            'image' => (!empty($newFileName)) ? $newFileName : $product[0]['image'],
            'category_id' => $_POST['category'],
            'price' => $_POST['price'],
            'manufacturer' => $_POST['manufacturer'],
            'id' => $productId
        ];
       
        try {
            $product = update($pdo, 'products', $data, 'id');
            
            flash('success', 'Product updated successfully.');

            redirect('edit_product.php?id=' . $productId);
        } catch (\Throwable $th) {
            flash('error', 'An internal error occurred, please contact administrator if error persists: '
                . $th->getMessage());
        }
	
	}
}
$output = loadTemplate('../../templates/employee/edit_product.html.php', [
    'categories' => $navCategories,
    'product' => $product[0]
]);
$title = 'Edit Product';
require '../../templates/layout.html.php';