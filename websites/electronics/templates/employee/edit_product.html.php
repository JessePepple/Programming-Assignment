
<h1>Edit Product</h1>

<a href="/index.php">Home</a>
&raquo;
<a href="/employee/products.php">Products</a>
&raquo;
<span>Edit Product</span>
<br><br>
<hr />

<h2>Product</h2>
<form action="/employee/edit_product.php?id=<?= $product['id'] ?>" enctype="multipart/form-data" method="post">
    <label for="category">
        Category*
    </label>
    <select name="category" id="category" required>
        <option value="" disabled selected>Select Product Category</option>
        <?php if(!empty($categories)): ?>
            <?php foreach($categories as $category): ?>
                <option
                    value="<?= $category['id'] ?>"
                    <?= oldValue('category', $product['category_id']) == $category['id'] ? 'selected' : '' ?>
                    ><?= ucwords($category['name']) ?></option>
            <?php endforeach ?>
        <?php endif ?>
    </select>
	<label>Name*</label>
    <input type="text" name="name" value="<?= oldValue('name', $product['name']) ?>" placeholder="Enter product name" required />
	
    <label>Price*</label>
    <input type="text" name="price" value="<?= oldValue('price', $product['price']) ?>" placeholder="0.00" required />

    <label>Description*</label>
    <textarea name="description" placeholder="Enter description" required><?= oldValue('description', $product['description']) ?></textarea>

    <label>Manufacturer</label>
    <input type="text" name="manufacturer" placeholder="Enter manufacturer" value="<?= oldValue('manufacturer', $product['manufacturer']) ?>">

    <label>Image</label>
    <div style="width: 46%">

    <?php if(!empty($product['image'])): ?>
        <img src="<?= '/uploads' . '/' . $product['image'] ?>"
        
    style="width: 100%"
     alt="Product Image" />
    <?php endif ?>
    <input type="file" name="image" style="width: 100%; display: block" />
    </div>

    <input type="submit" name="submit" value="Edit" />
</form>
