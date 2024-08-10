<?php
include '../config/database.php';

if (isset($_POST['submit'])) {
    //1. Get the Data from Login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2. SQL to check whether the user with username and password exits or not
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    //3. Execute the Query
    $res = mysqli_query($conn, $sql);

    //4. Count rows to check whether the user exits or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = "<div class='success'>Login Successfully!</div>";
        $_SESSION['user'] = $username;
        header('location:' .SITEURL.'admin/');
    } else {
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match!</div>";
        header('location:' .SITEURL.'admin/login.php');
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login - Food Order System</title>
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1> <br>
        <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (isset($_SESSION['no-login-user'])) {
                echo $_SESSION['no-login-user'];
                unset($_SESSION['no-login-user']);
            }
        ?>
        <br>
        <!--Login form starts here-->
        <form action="" method="post" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"> <br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"> <br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary"> <br><br>
        </form>
        <!--Login form ends here-->

        <p class="text-center">Created By - <a href="#">Temur Beknazarov</a></p>
    </div>
</body>
</html>
