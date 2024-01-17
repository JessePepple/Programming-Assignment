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

<h2><?= ucwords($category['name']) ?? '' ?></h2>

<ul class="products">

    <?php
    if(!empty($products)):
        foreach($products as $product): ?>
        <li>
            <a href="/product.php?id=<?= $product['id'] ?? '' ?>">
                <h3><?= ucwords($product['name'] ?? '') ?></h3>
            </a>
            <p><?= ucfirst($product['description']) ?? '' ?></p>
            
            <div class="price">£<?= number_format($product['price'], 2) ?></div>
        </li>
        <?php
        endforeach;
    else: ?>
    <p>No products found</p>
    <?php 
    endif;
    ?>
</ul>