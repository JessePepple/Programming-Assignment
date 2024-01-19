<h1>Questions</h1>

<a href="/index.php">Home</a>
&raquo;
<span>Questions</span>
<br><br>
<hr />
<div style="display: flex; align-items: center">
    <h2>Reviews</h2>
    <div style="margin-left: auto;">
        Filter:
        <select name="filter" id="filter" onchange="window.location = '/employee/questions.php?filter=' + this.value">
            <option value="all" <?= (isset($_GET['filter']) && $_GET['filter'] == 'all') ? 'selected': '' ?>>
                All Questions
            </option>
            <option value="answered" <?= (isset($_GET['filter']) && $_GET['filter'] == 'answered') ? 'selected': '' ?>>
                Answered Questions
            </option>
            <option value="unanswered" <?= (isset($_GET['filter']) && $_GET['filter'] == 'unanswered') ? 'selected': '' ?>>
                Unanswered Questions
            </option>
        </select>
    </div>
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
                    <?php
                    if($review['status'] == 0): ?>
                        <a href="/employee/approve_question.php?id=<?= $review['id'] ?>">Approve</a>
                    <?php
                    endif ?>
                    &nbsp;&nbsp;
                    <a href="/question.php?id=<?= $review['id'] ?>">Add Answer</a>
                    &nbsp;&nbsp;
                    <a href="/employee/delete_question.php?id=<?= $review['id'] ?>"
                        onclick="return confirm('Are you sure you want to delete this question?')"
                        style="color:red !important">
                        Delete
                    </a>
                </div>
            </li>
            <?php
        endforeach;
    else: ?>
        <p>No reviews yet</p>
        <?php
    endif; ?>
</ul>