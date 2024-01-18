
<h1>Add New Product</h1>

<a href="/index.php">Home</a>
&raquo;
<a href="/employee/products.php">Products</a>
&raquo;
<span>New Product</span>
<br><br>
<hr />

<h2>Product</h2>
<form action="/employee/add_product.php" enctype="multipart/form-data" method="post">
    <label for="category">
        Category*
    </label>
    <select name="category" id="category" required>
        <option value="" disabled selected>Select Product Category</option>
        <?php if(!empty($categories)): ?>
            <?php foreach($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= ucwords($category['name']) ?></option>
            <?php endforeach ?>
        <?php endif ?>
    </select>
	<label>Name*</label>
    <input type="text" name="name" value="<?= oldValue('name') ?>" placeholder="Enter product name" required />
	
    <label>Price*</label>
    <input type="text" name="price" value="<?= oldValue('price', '') ?>" placeholder="0.00" required />

    <label>Description*</label>
    <textarea name="description" placeholder="Enter description" required><?= oldValue('description') ?></textarea>

    <label>Manufacturer</label>
    <input type="text" name="manufacturer" placeholder="Enter manufacturer" value="<?= oldValue('manufacturer') ?>">

    <label>Image</label>
    <input type="file" name="image">

    <input type="submit" name="submit" value="Add" />
</form>
