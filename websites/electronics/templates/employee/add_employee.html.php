
<h1>Add Employee</h1>
<a href="/index.php">Home</a>
&raquo;
<a href="/employee/employees.php">Employees</a>
&raquo;
<span>New Employee</span>
<br><br>
<hr />

<h2>Employee</h2>
<form action="/employee/add_employee.php" method="post">
    <label>Full Name</label> <input type="text" name="fullname" value="<?= oldValue('fullname') ?>" />
	<label>Email</label> <input type="email" name="email" value="<?= oldValue('email') ?>" />
	<label>Password</label> <input type="password" name="password" />
	<input type="submit" name="submit" value="Add" />
</form>
