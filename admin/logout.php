<?php
include '../config/database.php';

session_destroy();

header("location:" .SITEURL.'admin/login.php');
