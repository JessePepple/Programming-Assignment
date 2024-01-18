
<h1>Create New Category</h1>

<a href="/index.php">Home</a>
&raquo;
<a href="/employee/categories.php">Categories</a>
&raquo;
<span>New Category</span>
<br><br>
<hr />

<h2>Category</h2>
<form action="/employee/add_category.php" method="post">
	<label>Name</label> <input type="text" name="name" value="<?= oldValue('name') ?>" />
	<input type="submit" name="submit" value="Add" />
</form>
