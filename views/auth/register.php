<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/views/includes/bootstrap.php"); ?>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="./../../routes/web.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="John">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Smith">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="avatar" class="form-label">User avatar</label>
                        <input type="file" name="avatar" class="form-control" id="avatar">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">User email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="example@mail.ru">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">User Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder=".....">
                    </div>
                </div>
            </div>
            <button name="action" value="register" class="btn btn-primary">Register</button>
            <a href="http://blog.loc/views/auth/login.php">Go to login page</a>
        </form>
    </div>
</body>
</html>