<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/Database.php";
class Auth {
    protected $db;
    public function __construct() {
        $mysqli =  new Database();
        $this->db = $mysqli->connect();
    }

    public function check_email($email) {
        $EMAIL_SQL = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $this->db->query($EMAIL_SQL);
        return ($result->num_rows == 1) ? true : false;
    }

    public function verify_email($email) {
        $SQL_FOR_VERIFY = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $this->db->query($SQL_FOR_VERIFY);
        $resultUser = $result->fetch_all(MYSQLI_ASSOC);
        $user_id = md5($resultUser[0]['id']);
        $verify_url = "<a href='http://blog.loc/lib/verifyEmail.php?user_id=$user_id&email=$email'>Verify</a>";
        mail($email, "Verify Profile", $verify_url, 'Content-type: text/html; charset=utf8');

    }

    public function register($data) {
        if(!$this->check_email($data['email'])) {
            $first_name = $this->db->real_escape_string($data['first_name']);
            $last_name = $this->db->real_escape_string($data['last_name']);
            $avatar = $this->db->real_escape_string($data['avatar']);
            $email = $this->db->real_escape_string($data['email']);
            $password = $this->db->real_escape_string($data['password']);

            $SQL_REGISTER_USER = "INSERT INTO `users` VALUES (
                            null, 
                            '$first_name',
                            '$last_name',
                            '$avatar',
                            0,
                            0,
                            '$email',
                            '$password', 
                            1, 
                            NOW()
                            ) ";

            $result_Register = $this->db->query($SQL_REGISTER_USER);
            if($result_Register) {
                $this->verify_email($email);
            }
        }
    }

    public function login($data) {
//        print_r($data); exit;
        $email = $this->db->real_escape_string($data['email']);
        $password = $this->db->real_escape_string($data['password']);
        $SQL_FOR_LOGIN = "SELECT id, first_name, last_name, email, verify_at, avatar, role_id, created_at FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
        $result = $this->db->query($SQL_FOR_LOGIN);
        if($result->num_rows > 0) {
            $user = $result->fetch_all(MYSQLI_ASSOC)[0];
            $this->db->query("UPDATE `users` SET `status` = 1 WHERE `email` = '$email'");
//            print_r($user); exit;
            if($user['verify_at'] == 1) {
                $_SESSION['checked_user'] = $user;
                if($user['role_id'] == 1) {
                    header("location:http://blog.loc/views/dashboard/dashboard.php");
                } else {
                    header("location:http://blog.loc/views/home.php");
                }
            } else {
                return "Verificatian ancac chi";
            }
        } else {
            return "Incorrect login or password";
        }
    }

    public function change_password($data) {
        $old_password = $this->db->real_escape_string($data['old_password']);
        $new_password = $this->db->real_escape_string($data['new_password']);
        $SQL_FOR_SELECT_USER = "SELECT * FROM `users` WHERE `password` = '$old_password'";
        $result = $this->db->query($SQL_FOR_SELECT_USER);
        if($result->num_rows > 0) {
            $result_change_password = $this->db->query("UPDATE `users` SET `password` = '$new_password'");
            if($result_change_password) {
                $_SESSION['success_msg'] = 'Password has been changed';
                if($result->fetch_all(MYSQLI_ASSOC)[0]['role_id'] == 1) {
                    header("location:http://blog.loc/views/dashboard/dashboard.php");
                } else {
                    header("location:http://blog.loc/views/home.php");
                }
            }
        }
    }

    public function forgot_password($email) {
        $fake_password = "blog_" . time() . "_" . rand(1,10);

        $SQL_FOR_FORGOT = "UPDATE `users` SET `password` = md5('$fake_password') WHERE `email` = '$email'";
        $result = $this->db->query($SQL_FOR_FORGOT);
        $msg = "<div>
                    <h2>Forgot Password</h2>
                    <p>Your fake password: $fake_password</p>
                    <p>Please change your password for security.</p>
                    <p><a href='http://blog.loc/views/auth/login.php'>Got to Login page</a></p>
                </div>";
        $send_email = mail($email, "Forgot Password", $msg, 'Content-type: text/html; charset=utf8');
        if($send_email) {
            $_SESSION['success_msg'] = "Check your email please!";
            header("location:http://blog.loc/views/auth/login.php");
        }
    }

    public function logout($id) {
        $this->db->query("UPDATE `users` SET `status` = 0 WHERE `id` = '$id'");
        session_destroy();
        header("location:http://blog.loc/views/auth/login.php");
    }
}

