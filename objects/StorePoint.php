<?php

/**
 * Object containing store point
 *
 * @author fabio
 */

include_once 'iTemplate.php';

class StorePoint implements iTemplate{
    private $conn;
    private $tableName = "store_point";
    
    public $dbid;
    public $storeName;
    public $storeLocation;
    public $created;
    public $modified;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function setDbid($param) {
        $this->dbid = $param;
    }
    public function getDbid() {
        return $this->dbid;
    }
    public function setStoreName($param) {
        $this->storeName = $param;        
    }
    public function getStoreName() {
        return $this->storeName;
    }
    public function setStoreLocation($param) {
        $this->storeLocation = $param;
    }
    public function getStoreLocation() {
        return $this->storeLocation;
    }
    public function setCreated($param) {
        $this->created = $param;
    }
    public function getCreated() {
        return $this->created;
    }
    public function setModified($param) {
        $this->modified = $param;
    }
    public function getModified() {
        return $this->modified;
    }
    public function create() {
        $query = "INSERT INTO " . $this->tableName . " SET store_name=:storeName, store_location=:storeLocation, created=:created";
       
        $stmt = $this->conn->prepare($query);
        
        $this->setStoreName(htmlspecialchars(strip_tags($this->getStoreName())));
        $this->setStoreLocation(htmlspecialchars(strip_tags($this->getStoreLocation())));
        
        $stmt->bindParam("storeName", $this->storeName);
        $stmt->bindParam("storeLocation", $this->storeLocation);
        $stmt->bindParam("created", $this->created);
        
        if($stmt->execute()){
            return true;
        }
        else{
            echo '<pre>';
            print_r($stmt->errorInfo());
            echo '</pre>';
            return false;
        }
    }
    public function readAll() {
        $query = "SELECT dbid, store_name, store_location, created, modified "
                . "FROM " . $this->tableName . ""
                . " ORDER BY dbid DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function readOne() {
        $query = "SELECT store_name, store_location, created, modified "
                . "FROM " . $this->tableName . ""
                . " WHERE dbid = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->dbid);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->setStoreName($row['store_name']);
        $this->setStoreLocation($row['store_location']);
    }
    public function update() {
        $query = "UPDATE " . $this->tableName . 
                " SET "
                . "store_name = :storeName,"
                . "store_location = :storeLocation"
                . " WHERE dbid = :dbid";
        
        $stmt = $this->conn->prepare($query);
        
        $this->setStoreName(htmlspecialchars(strip_tags($this->getStoreName())));
        $this->setStoreLocation(htmlspecialchars(strip_tags($this->getStoreLocation())));
        
        $stmt->bindParam('storeName', $this->storeName);
        $stmt->bindParam('storeLocation', $this->storeLocation);
        $stmt->bindParam('dbid', $this->dbid);
        
        if($stmt->execute()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function delete() {
        $query = "DELETE FROM " . $this->tableName . " WHERE dbid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->dbid);
        
        if($stmt->execute()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
