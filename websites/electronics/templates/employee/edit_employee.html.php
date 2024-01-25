
<h1>Edit Employee Details</h1>
<a href="/index.php">Home</a>
&raquo;
<a href="/employee/employees.php">Employees</a>
&raquo;
<span>Edit Employee</span>
<br><br>
<hr />

<h2>Employee</h2>
<form action="/employee/edit_employee.php?id=<?= $employee['id'] ?>" method="post" autocomplete="off">
    <label>Full Name</label> <input type="text" name="fullname" value="<?= oldValue('fullname', $employee['name']) ?>" />
	<label>Email</label> <input type="email" name="email" value="<?= oldValue('email', $employee['email']) ?>" />
	<label>Password(<small>Leave empty if you don't intend to change)</small></label> <input type="password" name="password" autocomplete="new-password"/>
    <input type="hidden" name="employee_id" value="<?= $employee['id'] ?>">
	<input type="submit" name="submit" value="Edit Details" />
</form>
