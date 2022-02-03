<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/Database.php";// miacnum enq mer database filin
class Post
{
    protected $db;
    protected $response = [];
    public function __construct()
    {
        $mysqli = new Database();
        $this->db = $mysqli->connect();
    }
    public function index()
    {
        $INDEX_SQL= "SELECT posts.*, users.first_name, users.last_name FROM `posts` 
                    INNER JOIN `users` ON posts.user_id = users.id";
        $result = $this->db->query($INDEX_SQL);
        $this->response = [
            'status' => 200,
            'data' => $result->fetch_all(MYSQLI_ASSOC)
        ];
        return json_encode($this->response);
    }

    public function store($title,$content,$user_id){
        $title = $this->db->real_escape_string($title);
        $content = $this->db->real_escape_string($content);
        $user_id = $this->db->real_escape_string($user_id);
        $STORE_SQL= "INSERT INTO `posts` VALUES (null, '$title', '$content', NOW(), '$user_id')";
        $result = $this->db->query($STORE_SQL);
        if($result) {
            $_SESSION['success_msg'] = 'Row successfully created!';
            header("location:blog.loc/views/home.php");
        } else {
            $_SESSION['fail_msg'] = 'Row not inserted!';
            header("location:blog.loc/views/home.php");
        }
    }

    //stexcel em function tvyalnnery popoxelu hamar ev argumentov sahmanel  em ayn tvyalnnery voronq petqa poxancven
    public function updateData($title,$content,$post_id){
        //$this obyekti operatori mijocov hasaneliutyun em unecel tvyalneri bazayin
        //mysql update hramani mijocov sahmanel em ayn tvyalnery voronq petqa popoxven ev pahpanel em dranq update popoxakani mej
        $update="UPDATE `posts` SET `title`='$title', `content`='$content' WHERE `id`=$post_id";
        //katarel em update popoxakani mej pahvac harcumy
        $result=$this->db->query($update);
        if($result) {
            $_SESSION['success_msg'] = 'Row successfully updated!';
            header("location:blog.loc/views/home.php");
        } else {
            $_SESSION['fail_msg'] = 'Row not updated!';
            header("location:blog.loc/views/home.php");
        }
    }

    public function  filter_by_title($title) {
        $INDEX_SQL= "SELECT * FROM `posts` WHERE `title` LIKE '%$title%'";
        $result = $this->db->query($INDEX_SQL);
        $this->response = [
            'status' => 200,
            'data' => $result->fetch_all(MYSQLI_ASSOC)
        ];
        return json_encode($this->response);
    }

    public function delete_post($id){
        $post = "DELETE FROM `posts` WHERE `id` = $id";
        $result = $this->db->query($post);

        if($result) {
            $_SESSION['success_msg'] = 'Row successfully deleted!';
            header("location:blog.loc/views/home.php");
        } else {
            $_SESSION['fail_msg'] = 'Row not deleted!';
            header("location:blog.loc/views/home.php");
        }
   }

   public function user_post($user_id) {
       $INDEX_SQL= "SELECT * FROM `posts` WHERE `user_id` = $user_id";
       $result = $this->db->query($INDEX_SQL);
       $this->response = [
           'status' => 200,
           'data' => $result->fetch_all(MYSQLI_ASSOC)
       ];
       return json_encode($this->response);
   }

}
