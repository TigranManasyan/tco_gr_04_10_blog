<?php


if(isset($_SESSION['success_msg'])) {
    echo $_SESSION['success_msg'];
} else if(isset($_SESSION['fail_msg'])) {
    echo $_SESSION['fail_msg'];
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/views/includes/bootstrap.php"); ?>
</head>
<body>
<div class="container">

    <form action="./../../routes/web.php" method="post" >
        <div class="row">


            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1>Login</h1>
                <div class="mb-3">
                    <label for="email" class="form-label">User email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="example@mail.ru">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">User Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder=".....">
                </div>

                <button name="action" value="login" class="btn btn-primary">Login</button>
                <a href="http://blog.loc/views/auth/register.php">Create account</a>
                <a href="http://blog.loc/views/auth/forgot.php">Forgot password?</a>
            </div>
        </div>
        <div class="col-md-4"></div>

    </form>
</div>
</body>
</html>
