<style>
    .products a {
        color: #92B2BF !important;
    }
</style>
<h1>Products</h1>

<a href="/index.php">Home</a>
&raquo;
<span>Products</span>
<br><br>
<hr />
<style>
    .reviews a {
        color: #92B2BF !important;
    }
</style>
<div style="display: flex; align-items: center">
    <h2>Products</h2>
    <a href="/employee/add_product.php"
        style="margin-left: auto;">+New Product</a>
</div>

<ul class="products">

    <?php
    if(!empty($products)):
        foreach($products as $product): ?>
        <li>
            <a href="/product.php?id=<?= $product['id'] ?? '' ?>">
                <h3><?= ucwords($product['name'] ?? '') ?></h3>
            </a>
            <p><?= $product['description'] ?? '' ?></p>
            
            <div class="price">£<?= number_format($product['price'], 2) ?></div>
            <div class="details">
                <a href="/employee/edit_product.php?id=<?= $product['id'] ?? '' ?>" style="color:green !important">Edit</a>
                <a href="/employee/delete_product.php?id=<?= $product['id'] ?? '' ?>" 
                    onclick="return confirm('Are you sure you want to delete this product?')"
                    style="color:red !important">Delete</a>
            </div>
        </li>
        <?php
        endforeach;
    else: ?>
    <p>No products found</p>
    <?php 
    endif;
    ?>
</ul>