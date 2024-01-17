<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Ed's Electronics</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="/electronics.css" />
        <style>
            li a {
                color: #fff !important;
                font-size: 16px; 
            }
            .reviews a, .products a {
                color: #92B2BF !important;
            }
        </style>
	</head>

	<body>

        <!-- Page header -->
        <header>
        <h1>Ed's Electronics</h1>


        <ul>
            <li><a href="/index.php">Home</a></li>
            <?php if(!isLogged()): ?>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <?php endif ?>
            <li>Products
                <ul>
                    <?php
                    if(!empty($navCategories)):
                        foreach($navCategories as $category): ?>
                            <li><a href="/category.php?id=<?= $category['id'] ?>"><?= ucwords($category['name']) ?></a></li>
                        <?php
                        endforeach;
                    endif ?>

                </ul>
            </li>

            <?php if(isLogged()): ?>
                <li><a href="/logout.php">Logout</a></li>
            <?php endif ?>

        </ul>

        <address>
            <p>We are open 9-5, 7 days a week. Call us on
                <strong>01604 11111</strong>
            </p>
        </address>



    </header>
        <main>

        <!-- Main content -->
        <?= $output ?>
        </main>
        <!-- Page footer -->
        <aside>
            <?php
            if(isLogged()): ?>
            <ul 
            style="list-style-type: none;
                font-size: 16px; margin-bottom: 30px;">
                <?php if(isAdmin()): ?>
                <li>
                    <a href="/employee/products.php">Products</a>
                </li>
                <li>
                    <a href="/employee/categories.php">Categories</a>
                </li>
                <li>
                    <a href="/employee/questions.php">Questions</a>
                </li>
                <li>
                    <a href="/employee/employees.php">Employees</a>
                </li>
                <?php endif ?>
                <li>
                    <a href="/questions.php">My Questions</a>
                </li>
            </ul>
            <?php endif ?>
        <h1><a href="#">Featured Product</a></h1>
        <p><strong>Gaming PC</strong></p>
        <p>Brand new 8 core computer with an RTX 4080 </p>

        </aside>

        <footer>
        &copy; Ed's Electronics <?= date('Y') ?>
        </footer>

    </body>

</html>

