
<h1>Welcome to Ed's Electronics</h1>

<p>Please create an account below</p>

<hr />

<h2>Register</h2>
<form action="register.php" method="post">
    <label>Full Name</label> <input type="text" name="fullname" value="<?= oldValue('fullname') ?>" />
	<label>Email</label> <input type="email" name="email" value="<?= oldValue('email') ?>" />
	<label>Password</label> <input type="password" name="password" />
    <label>Password Confirmation</label> <input type="password" name="password_confirm" />
	<input type="submit" name="submit" value="submit" />
</form>
