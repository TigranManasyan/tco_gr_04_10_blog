<?php

    require_once "./../app/models/Auth.php";
    $action = "";
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
    } else if($_GET['action']) {
        $action = $_GET['action'];
    }

    $auth = new Auth();

    if($action === 'register') {
        $auth->register([]);

    }
