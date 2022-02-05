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
    <title>All posts</title>
    <link rel="stylesheet" href="http://blog.loc/public/css/style.css" >
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="http://blog.loc/public/js/main.js"></script>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/views/includes/bootstrap.php' ?>

</head>
<body id="all-posts">
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/views/includes/navbar.php' ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <a class="btn btn-primary mt-2 mb-2" href="http://blog.loc/views/posts/new_post.php">Create New Post</a>
                <h2>Post List</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Published</th>
                            <th>Author</th>
                        </tr>
                    </thead>
                    <tbody id="post-list">


                    </tbody>
                </table>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>
</html>
