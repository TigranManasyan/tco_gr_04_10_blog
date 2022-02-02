<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/Database.php";// miacnum enq mer database filin
class Post
{
    protected $db;
    public function __construct()
    {
        $mysqli = new Database();
        $this->db = $mysqli->connect();
    }
    public function index($index)
    {
        $INDEX_SQL= "SELECT * FROM `posts`";
        $result = $this->db->query($INDEX_SQL);
        $resultPost = $result->fetch_all(MYSQLI_ASSOC);


    }
    public function store($store){

    }
    
    //stexcel em function tvyalnnery popoxelu hamar ev argumentov sahmanel  em ayn tvyalnnery voronq petqa poxancven
    public function updateData($title,$content,$user_id){
        //$this obyekti operatori mijocov hasaneliutyun em unecel tvyalneri bazayin
        $db=$this->connect();
        //mysql update hramani mijocov sahmanel em ayn tvyalnery voronq petqa popoxven ev pahpanel em dranq update popoxakani mej
        $update="UPDATE `posts` SET `id`=Null, `title`='$title', `content`='$content', `published_at`=NOW(), `user_id`='$user_id' WHERE `user_id`=$user_id";
        //katarel em update popoxakani mej pahvac harcumy
        $result=$this->db->query($update);
    }

}
