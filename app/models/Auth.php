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

    }

    public function logout() {

    }
}
