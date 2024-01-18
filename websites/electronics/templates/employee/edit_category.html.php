
<h1>Edit Category</h1>

<a href="/index.php">Home</a>
&raquo;
<a href="/employee/categories.php">Categories</a>
&raquo;
<span>Edit Category</span>
<br><br>
<hr />

<h2>Category</h2>
<form action="/employee/edit_category.php?id=<?= $id ?>" method="post">
	<label>Name</label>
    <input type="text" name="name" value="<?= oldValue('name', ($category['name'] ?? '')) ?>" />
	<input type="submit" name="submit" value="Edit" />
</form>
