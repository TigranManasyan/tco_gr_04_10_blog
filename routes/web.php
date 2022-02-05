<?php
    session_start();
    //Function
    require_once "./../lib/file_upload.php";
    require_once "./../lib/form_input.php";
    require_once "./../lib/password.php";

    //Models
    require_once "./../app/models/Auth.php";
    require_once "./../app/models/Post.php";


    $action = "";
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
    } else if($_GET['action']) {
        $action = $_GET['action'];
    }

    $auth = new Auth();
    $post = new Post();

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

//        print_r($_POST); exit;
         $auth->login([
            'email' => inp($_POST['email']),
            'password' => inp(hash_password($_POST['password']))
        ]);
    } else if($action == 'reset-password') {

//        print_r($_POST); exit;
        $auth->change_password([
            'old_password' => inp(hash_password($_POST['old-password'])),
            'new_password' => inp(hash_password($_POST['new-password']))
        ]);
    } else if($action == 'logout') {
        $auth->logout($_GET['user_id']);
    } else if($action == 'all-posts') {
//        echo 1; exit;
       echo $post->index();
    } else if($action == 'forgot') {
        $auth->forgot_password($_POST['email']);
    } else if($action == 'new-post') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $user_id = $_POST['user_id'];
        echo $post->store([
            'title' => inp($title),
            'content' => inp($content),
            'user_id' => inp($user_id)
        ]);
    } else if($action == 'edit-post') {
//        echo $_GET['post_id']; exit;
        echo $post->edit($_GET['post_id']);
    } else if($action == 'update-post') {
        $title = $_POST['title'];
//        echo $title;
        $content = $_POST['content'];
        $user_id = $_POST['user_id'];
        $post_id = $_POST['post_id'];
        echo $post->update([
            'title' => inp($title),
            'content' => inp($content),
            'user_id' => inp($user_id)
        ], $_POST['post_id']);
    } else if($action == 'delete_post') {
        echo $post->delete_post($_GET['post_id']);
    } else if($action == 'my-posts') {
        echo $post->user_post($_GET['user_id']);
    }
