<h1>Questions</h1>

<a href="/index.php">Home</a>
&raquo;
<span>Questions</span>
<br><br>
<hr />
<div style="display: flex; align-items: center">
    <h2>My Questions</h2>
</div>

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
                <div class="details" style="margin-top: 15px;">
                   <?php if($review['status'] == 0): ?>
                        <span style="color:orange">Pending Approval</span>&nbsp;&nbsp;
                    <?php endif ?>
                    <a href="/question.php?id=<?= $review['id'] ?>">View Answers</a>
                </div>
            </li>
            <?php
        endforeach;
    else: ?>
        <p>No reviews yet</p>
        <?php
    endif; ?>
</ul>