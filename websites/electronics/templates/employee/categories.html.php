
<h1>Categories</h1>

<a href="/index.php">Home</a>
&raquo;
<span>Categories</span>
<br><br>
<hr />
<style>
    .reviews a {
        color: #92B2BF !important;
    }
</style>
<div style="display: flex; align-items: center">
    <h2>Categories</h2>
    <a href="/employee/add_category.php"
        style="margin-left: auto;">+New Category</a>
</div>

<ul class="reviews">
    <?php
    if(!empty($categories)):
        foreach($categories as $category): ?>
        <li>
            <a href="/category.php?id=<?= $category['id'] ?? '' ?>">
                <?= ucwords($category['name'] ?? '') ?>
            </a>
            <div class="details">
                <a href="/employee/edit_category.php?id=<?= $category['id'] ?? '' ?>" style="color:green !important">Edit</a>
                <a href="/employee/delete_category.php?id=<?= $category['id'] ?? '' ?>" 
                    onclick="return confirm('Are you sure you want to delete this category?')"
                    style="color:red !important">Delete</a>
            </div>
        </li>
        <?php
        endforeach;
    else: ?>
    <p>No categories found</p>
    <?php 
    endif;
    ?>
</ul>