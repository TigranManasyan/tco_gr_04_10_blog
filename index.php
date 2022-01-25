<?php
    session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php require_once "./views/includes/bootstrap.php"; ?>
</head>
<body>
    <?php require_once "./views/includes/navbar.php"; ?>

</body>
</html>

<?php
    mail(
            "manasyan.tigran@mail.ru",
            "Test Mail",
            "Hello I am test mail!"
    );

?>