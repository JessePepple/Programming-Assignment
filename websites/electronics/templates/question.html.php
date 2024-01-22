<h1><?= ucwords($product['name']) ?? '' ?></h1>

<a href="/index.php">Home</a>
&raquo;
<a href="/product.php?id=<?= $product['id'] ?>"><?= ucwords($product['name']) ?></a>
&raquo;
<span>Reviews</span>
<br><br>

<hr />

<h4>Review</h4>
<ul class="reviews">
    <li>
        <p><?= $question['message'] ?></p>
        <div class="details">
            <strong><?= $question['email'] ?></strong>
            <em><?= humanDate($question['date']) ?></em>
        </div>
    </li>
</ul>

<h4>Answers</h4>
<ul class="reviews">
    <?php
    if(!empty($answers)):
        foreach($answers as $review):
            ?>
            <li>
                <p><?= $review['message'] ?></p>
                <div class="details">
                    <strong><?= $review['email'] ?></strong>
                    <em><?= humanDate($review['date']) ?></em>
                </div>
            </li>
            <?php
        endforeach;
    else: ?>
        <p>No answers yet</p>
        <?php
    endif; ?>
   
</ul>
<h4>Add Answer</h4>
<?php
if(isAdmin()): ?>

    <form action="/employee/add_answer.php" method="post">

    <label>Answer</label>
    <textarea name="message" placeholder="Enter answer here"></textarea>
    <input type="hidden" name="question_id" value="<?= $question['id'] ?>" />
    <input type="submit" name="submit" value="Submit" />
    </form>
<?php endif ?>
