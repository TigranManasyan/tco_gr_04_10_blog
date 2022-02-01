<?php
session_start();
if(!isset($_SESSION['checked_user'])) {
    $_SESSION['msg'] = 'Login please!';
    header("location:http://blog.loc/views/auth/login.php");
} else {
    $user = $_SESSION['checked_user'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="http://blog.loc/public/css/style.css" >

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/views/includes/bootstrap.php' ?>

</head>
<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/views/includes/navbar.php' ?>
</body>
</html>
