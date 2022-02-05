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

    public function edit($id)
    {
        $EDIT_SQL= "SELECT posts.*, users.first_name, users.last_name FROM `posts` 
                    INNER JOIN `users` ON posts.user_id = users.id WHERE `posts`.`id` = $id";
        $result = $this->db->query($EDIT_SQL);
        if($result->num_rows > 0) {
            $this->response = [
                'status' => 200,
                'data' => $result->fetch_all(MYSQLI_ASSOC)
            ];
        } else {
            $this->response = [
                'status' => 404,
            ];
        }

        return json_encode($this->response);
    }
    public function store($data){
        $title = $this->db->real_escape_string($data['title']);
        $content = $this->db->real_escape_string($data['content']);
        $user_id = $this->db->real_escape_string($data['user_id']);
        $STORE_SQL= "INSERT INTO `posts` VALUES (null, '$title', '$content', NOW(), '$user_id')";
        $result = $this->db->query($STORE_SQL);
        if($result) {
            $this->response = [
                'status' => 200,
                'msg' => 'Row successfully created!'
            ];
        } else {
            $this->response = [
                'status' => 200,
                'msg' => 'Row is not created!'
            ];
        }

        return json_encode($this->response);
    }

    //stexcel em function tvyalnnery popoxelu hamar ev argumentov sahmanel  em ayn tvyalnnery voronq petqa poxancven
    public function update($data, $post_id){
        $title = $this->db->real_escape_string($data['title']);
        $content = $this->db->real_escape_string($data['content']);
        //$this obyekti operatori mijocov hasaneliutyun em unecel tvyalneri bazayin
        //mysql update hramani mijocov sahmanel em ayn tvyalnery voronq petqa popoxven ev pahpanel em dranq update popoxakani mej
        $update="UPDATE `posts` SET `title`='$title', `content`='$content' WHERE `id`=$post_id";
        //katarel em update popoxakani mej pahvac harcumy
        $result=$this->db->query($update);
        if($result) {
            $this->response = [
                'status' => 200,
                'msg' => 'Row successfully updated!'
            ];
        } else {
            $this->response = [
                'status' => 200,
                'msg' => 'Row is not updated!'
            ];
        }
        return json_encode($this->response);

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
            $this->response = [
                'status' => 200,
                'msg' => 'Row successfully deleted!'
            ];
        } else {
            $this->response = [
                'status' => 200,
                'msg' => 'Row is not deleted!'
            ];
        }
        return json_encode($this->response);
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
