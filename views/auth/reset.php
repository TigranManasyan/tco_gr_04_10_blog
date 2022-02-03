<?php
echo md5(1234);
session_start();

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
    <title>Reset password</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/views/includes/bootstrap.php"); ?>
</head>
<body>
<div class="container">

    <form action="./../../routes/web.php" method="post" >
        <div class="row">


            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1>Change Password</h1>
                <div class="mb-3">
                    <label for="old-password" class="form-label">Old Password</label>
                    <input type="password" name="old-password" class="form-control" id="old-password" placeholder="*****">
                </div>
                <div class="mb-3">
                    <label for="new-password" class="form-label">New Password</label>
                    <input type="password" name="new-password" class="form-control" id="new-password" placeholder="*****">
                </div>

                <button name="action" value="reset-password" class="btn btn-primary">Reset</button>
            </div>
        </div>
        <div class="col-md-4"></div>

    </form>
</div>
</body>
</html>
