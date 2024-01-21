<h1><?= ucwords($product['name']) ?? '' ?></h1>

<a href="/index.php">Home</a>
&raquo;
<a href="/category.php?id=<?= $product['category_id'] ?>"><?= $category['name'] ?></a>
&raquo;
<span><?= ucwords($product['name']) ?></span>
<br><br>

<hr />
<?php
if(!empty($product['image'])): ?>
    <img src="/uploads/<?= $product['image'] ?>" 
    alt="<?= $product['name'] ?>"
    style="width:100%" />

<?php endif ?>

<h4>Product details</h4>
<p><?= ucfirst($product['description']) ?></p>

<div class="price">£<?= number_format($product['price'], 2) ?></div>

<h4>Product reviews</h4>
<ul class="reviews">
    <?php
    if(!empty($reviews)):
        foreach($reviews as $review):
            ?>
            <li>
                <p><?= $review['message'] ?></p>
                <div class="details">
                    <strong><?= $review['email'] ?></strong>
                    <em><?= humanDate($review['date']) ?></em>
                </div>
                <?php 
                $questionAns = getAnswers($review['id'], $pdo);
                if(!empty($questionAns)): ?>
                <h4>Answers</h4>
                <ul class="reviews">
                    <?php foreach($questionAns as $answer): ?>
                        <li>
                            <p><?= $answer['message'] ?></p>
                            <div class="details">
                                <strong><?= $answer['email'] ?></strong>
                                <em><?= humanDate($answer['date']) ?></em>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <?php
                endif; ?>
                

            </li>
            <?php
        endforeach;
    else: ?>
        <p>No reviews yet</p>
        <?php
    endif; ?>
   
</ul>

<h4>Add Review</h4>

<form action="/add_question.php" method="post">

<?php
if(!isLogged()): ?>
    <label>Email</label>
    <input type="email" name="email" placeholder="Enter your email" />
<?php else: ?>
    <input type="hidden" name="email" value="<?= !empty($user) ? $user['email'] : '' ?>" />
<?php endif ?>
<label>Review</label>
<textarea name="message"  placeholder="Enter review here"></textarea>
<input type="hidden" name="product_id" value="<?= $product['id'] ?>" />
<input type="submit" name="submit" value="Submit" />
</form>
