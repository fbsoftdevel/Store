<?php
class Database
{
    //database info
    //user=store
    //password=ZGYjaCXLGCT42A2n
    private $host = "localhost";
    private $db_name = "store_catalog";
    private $username = "store";
    private $password = "8WQ95e9urAqf8sYj";
    public $conn;
	
    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
            return $this->conn;
    }
}