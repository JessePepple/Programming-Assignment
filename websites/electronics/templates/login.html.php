
<h1>Welcome to Ed's Electronics</h1>

<p>Login with your email and password</p>

<hr />

<h2>Login</h2>
<form action="login.php" method="post">
	<label>Email</label> <input type="text" name="email" value="<?= oldValue('email') ?>" />
	<label>Password</label> <input type="password" name="password" />
	<input type="submit" name="submit" value="submit" />
</form>
