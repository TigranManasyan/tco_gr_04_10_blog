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
    <title>New Post</title>
    <link rel="stylesheet" href="http://blog.loc/public/css/style.css" >
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="http://blog.loc/public/js/main.js"></script>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/views/includes/bootstrap.php' ?>

</head>
<body id="new-post">
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/views/includes/navbar.php' ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>New Post</h2>
            <form id="save-post">
                <input type="hidden" id="user_id" value="<?= $user['id'] ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter Title">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Post content</label>
                    <textarea class="form-control" id="content" rows="3" placeholder="Text ..."></textarea>
                </div>

                <button class="btn btn-primary">Save</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
</body>
</html>
