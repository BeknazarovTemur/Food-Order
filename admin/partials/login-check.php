<?php
//Authorization - Access Control
//Check whether the user is logged in or not
if (!isset($_SESSION['user'])) { //If user session is not set
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
    header("location:" .SITEURL.'admin/login.php');
}