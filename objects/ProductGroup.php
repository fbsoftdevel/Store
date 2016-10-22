<?php

/**
 * Object containing product_group & functions
 *
 * @author fabio
 */
include_once 'iTemplate.php';

class ProductGroup implements iTemplate {

    private $conn;
    private $tableName = "products_group";
    public $dbid;
    public $storeRef;
    public $groupName;
    public $discount;
    public $groupDescription;
    public $created;
    public $modified;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getDbid() {
        return $this->dbid;
    }

    public function getStoreRef() {
        return $this->storeRef;
    }

    public function getGroupName() {
        return $this->groupName;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function getGroupDescription() {
        return $this->groupDescription;
    }

    public function getCreated() {
        return $this->created;
    }

    public function getModified() {
        return $this->modified;
    }

    public function setDbid($dbid) {
        $this->dbid = $dbid;
    }

    public function setStoreRef($storeRef) {
        $this->storeRef = $storeRef;
    }

    public function setGroupName($groupName) {
        $this->groupName = $groupName;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
    }

    public function setGroupDescription($groupDescription) {
        $this->groupDescription = $groupDescription;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    public function setModified($modified) {
        $this->modified = $modified;
    }

    public function create() {
        $query = "INSERT INTO " . $this->tableName . " SET store_ref=:storeRef, group_name=:groupName, discount=:discount, group_description=:groupDescription, created=:created";

        $stmt = $this->conn->prepare($query);

        $this->setStoreRef(htmlspecialchars(strip_tags($this->getStoreRef())));
        $this->setGroupName(htmlspecialchars(strip_tags($this->getGroupName())));
        $this->setDiscount($this->getDiscount());
        $this->setGroupDescription(htmlspecialchars(strip_tags($this->getGroupDescription())));

        $stmt->bindParam("storeRef", $this->storeRef);
        $stmt->bindParam("groupName", $this->groupName);
        $stmt->bindParam("discount", $this->discount);
        $stmt->bindParam("groupDescription", $this->groupDescription);
        $stmt->bindParam("created", $this->created);

        if ($stmt->execute()) {
            return true;
        } else {
            echo '<pre>';
            print_r($stmt->errorInfo());
            echo '</pre>';
            return false;
        }
    }

    public function delete() {
        $query = "DELETE FROM " . $this->tableName . " WHERE dbid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->dbid);

        if ($stmt->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function readAll() {
        $query = "SELECT dbid, store_ref, group_name, discount, group_description, created, modified "
                . "FROM " . $this->tableName . ""
                . " ORDER BY dbid DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT store_ref, group_name, discount, group_description, created, modified "
                . "FROM " . $this->tableName . ""
                . " WHERE dbid = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->dbid);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->setStoreRef($row['store_ref']);
        $this->setGroupName($row['group_name']);
        $this->setDiscount($row['discount']);
        $this->setGroupDescription($row['group_description']);
    }

    public function update() {
        $query = "UPDATE " . $this->tableName .
                " SET "
                . "store_ref = :storeNRef,"
                . "group_name = :groupName"
                . "discount = :discount"
                . "group_description = :groupDescription"
                . " WHERE dbid = :dbid";

        $stmt = $this->conn->prepare($query);

        $this->setStoreRef(htmlspecialchars(strip_tags($this->getStoreRef())));
        $this->setGroupName(htmlspecialchars(strip_tags($this->getGroupName())));
        $this->setDiscount(htmlspecialchars(strip_tags($this->getDiscount())));
        $this->setGroupDescription(htmlspecialchars(strip_tags($this->getGroupDescription())));

        $stmt->bindParam("storeRef", $this->storeRef);
        $stmt->bindParam("groupName", $this->groupName);
        $stmt->bindParam("discount", $this->discount);
        $stmt->bindParam("groupDescription", $this->groupDescription);

        $stmt->bindParam('dbid', $this->dbid);

        if ($stmt->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
