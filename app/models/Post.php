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
}