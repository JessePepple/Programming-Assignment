
<h1>Employees</h1>

<a href="/index.php">Home</a>
&raquo;
<span>Employees</span>
<br><br>
<hr />
<style>
    .reviews a {
        color: #92B2BF !important;
    }
</style>
<div style="display: flex; align-items: center">
    <h2>Employees</h2>
    <a href="/employee/add_employee.php"
        style="margin-left: auto;">+New Employee</a>
</div>

<ul class="products">

    <?php
    if(!empty($employees)):
        foreach($employees as $employee): ?>
        <li>
           
            <h3><?= ucwords($employee['email'] ?? '') ?></h3>
          
            <div class="details">
                <a href="/employee/edit_employee.php?id=<?= $employee['id'] ?? '' ?>" style="color:green !important">Edit</a>
                <a href="/employee/delete_employee.php?id=<?= $employee['id'] ?? '' ?>" 
                    onclick="return confirm('Are you sure you want to delete this Employee?')"
                    style="color:red !important">Delete</a>
            </div>
        </li>
        <?php
        endforeach;
    else: ?>
    <p>No Employees found</p>
    <?php 
    endif;
    ?>
</ul>