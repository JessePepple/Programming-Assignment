<?php
require '../dbconnection.php';

session_unset();
flash('success', "You're logged out successfully.");
redirect('index.php');