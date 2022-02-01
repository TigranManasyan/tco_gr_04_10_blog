<?php
    //Function
    require_once "./../lib/file_upload.php";
    require_once "./../lib/form_input.php";
    require_once "./../lib/password.php";

    //Models
    require_once "./../app/models/Auth.php";


    $action = "";
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
    } else if($_GET['action']) {
        $action = $_GET['action'];
    }

    $auth = new Auth();

    if($action == 'register') {

        if(isset($_POST['first_name'])
            && isset($_POST['last_name'])
            && isset($_POST['email'])
            && isset($_POST['password'])
        ) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $avatar = "";
            if(strlen(upload($_FILES['avatar'])) > 0) {
                $avatar = upload($_FILES['avatar']);
            }

            echo $auth->register([
                'first_name' => inp($first_name),
                'last_name' => inp($last_name),
                'avatar' => $avatar,
                'email' => inp($email),
                'password' => inp(hash_password($password)),
            ]);
        }

    } else if($action == 'login') {

         $auth->login([
            'email' => inp($_POST['email']),
            'password' => inp(hash_password($_POST['password']))
        ]);
    } else if($action == 'logout') {
        $auth->logout();
    }
