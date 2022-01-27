<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Database.php";
    function print_r_pre($array) {
        echo "<pre>";
            print_r($array);
        echo "<pre>";
    }
    class Verify {
        protected $db;
        public function __construct() {
            $mysqli =  new Database();
            $this->db = $mysqli->connect();
        }

        public function verifyAt($email) {
            $email = $this->db->real_escape_string($email);
            $GET_USER_SQL = "SELECT * FROM `users` WHERE `email` = '$email'";
            $resultGetUser = $this->db->query($GET_USER_SQL);
            $user = $resultGetUser->fetch_all(MYSQLI_ASSOC)[0];
            $user_id = $user['id'];
            $verify_at = $user['verify_at'];
            if($verify_at) {
                $_SESSION['fail_msg'] = "Duq arden verifikacia ancel eq";
                header("location:http://blog.loc/views/auth/login.php");
            } else {
                $SQL_VERIFY_AT = "UPDATE `users` SET `verify_at` = 1 WHERE `id` = '$user_id'";
                $result = $this->db->query($SQL_VERIFY_AT);
                if($result) {
                    $_SESSION['success_msg'] = "Duq ancel eq verifikacian";
                    header("location:http://blog.loc/views/auth/login.php");
                } else {
                    $_SESSION['fail_msg'] = "Pordzeq mi poqr ush";
                    header("location:http://blog.loc/views/auth/login.php");
                }
            }

        }
    }

    $verify = new Verify();
    $verify->verifyAt($_GET['email']);