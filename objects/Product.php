<?php

include_once 'iTemplate.php';

/**
 * Description of Product
 *
 * @author fabio
 */
class Product implements iTemplate {

    private $conn;
    private $tableName = "products";
    public $dbid;
    public $productName;
    public $groupRef;
    public $buyPrice;
    public $sellPrice;
    public $discount;
    public $productDescription;
    public $productImg;
    public $created;
    public $modified;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getDbid() {
        return $this->dbid;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function getGroupRef() {
        return $this->groupRef;
    }

    public function getBuyPrice() {
        return $this->buyPrice;
    }

    public function getSellPrice() {
        return $this->sellPrice;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function getProductDescription() {
        return $this->productDescription;
    }

    public function getProductImg() {
        return $this->productImg;
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

    public function setProductName($productName) {
        $this->productName = $productName;
    }

    public function setGroupRef($groupRef) {
        $this->groupRef = $groupRef;
    }

    public function setBuyPrice($buyPrice) {
        $this->buyPrice = $buyPrice;
    }

    public function setSellPrice($sellPrice) {
        $this->sellPrice = $sellPrice;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
    }

    public function setProductDescription($productDescription) {
        $this->productDescription = $productDescription;
    }

    public function setProductImg($productImg) {
        $this->productImg = $productImg;
    }

    public function setCreated($created) {
        $this->created = $created;
    }

    public function setModified($modified) {
        $this->modified = $modified;
    }

    public function create() {
        $query = "INSERT INTO " . $this->tableName . " SET group_ref=:groupRef, product_name=:productName, product_description=:productDescription, product_img=:productImg, discount=:discount, buy_price=:buyPrice, sell_price=:sellPrice, created=:created";

        $stmt = $this->conn->prepare($query);

        $this->setGroupRef(htmlspecialchars(strip_tags($this->getGroupRef())));
        $this->setProductName(htmlspecialchars(strip_tags($this->getProductName())));
        $this->setProductDescriptio(htmlspecialchars(strip_tags($this->getProductDescription())));
        $this->setProductImg($this->getProductImg());
        $this->setDiscount($this->getDiscount());
        $this->setBuyPrice($this->getBuyPrice());
        $this->setSellPrice($this->getSellPrice());

        $stmt->bindParam("groupRef", $this->groupRef);
        $stmt->bindParam("productName", $this->productName);
        $stmt->bindParam("productDescription", $this->productDescription);
        $stmt->bindParam("productImg", $this->productImg);
        $stmt->bindParam("discount", $this->discount);
        $stmt->bindParam("buyPrice", $this->buyPrice);
        $stmt->bindParam("sellPrice", $this->sellPrice);
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
        $query = "SELECT dbid, group_ref, product_name, product_description, product_img, discount, buy_price, sell_price, created, modified"
                . " FROM " . $this->tableName . ""
                . " ORDER BY dbid DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT group_ref, product_name, product_description, product_img, discount, buy_price, sell_price, created, modified"
                . " FROM " . $this->tableName . ""
                . " WHERE dbid = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->dbid);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->setGroupRef($row['group_ref']);
        $this->setProductName($row['product_name']);
        $this->setProductDescription($row['product_description']);
        $this->setProductImg($row['product_img']);
        $this->setDiscount($row['discount']);
        $this->setBuyPrice($row['buy_price']);
        $this->setSellPrice($row['sell_price']);
    }

    public function update() {
        $query = "UPDATE " . $this->tableName .
                " group_ref=:groupRef, "
                . "product_name=:productName, "
                . "product_description=:productDescription, "
                . "product_img=:productImg, "
                . "discount=:discount, "
                . "buy_price=:buyPrice, "
                . "sell_price=:sellPrice"
                . " WHERE dbid = :dbid";

        $stmt = $this->conn->prepare($query);

        $this->setGroupRef(htmlspecialchars(strip_tags($this->getGroupRef())));
        $this->setProductName(htmlspecialchars(strip_tags($this->getProductName())));
        $this->setProductDescription(htmlspecialchars(strip_tags($this->getProductDescription())));
        $this->setProductImg($this->getProductImg());
        $this->setDiscount($this->getDiscount());
        $this->setBuyPrice($this->getBuyPrice());
        $this->setSellPrice($this->getSellPrice());

        $stmt->bindParam("groupRef", $this->groupRef);
        $stmt->bindParam("productName", $this->productName);
        $stmt->bindParam("productDescription", $this->productDescription);
        $stmt->bindParam("productImg", $this->productImg);
        $stmt->bindParam("discount", $this->discount);
        $stmt->bindParam("buyPrice", $this->buyPrice);
        $stmt->bindParam("sellPrice", $this->sellPrice);

        $stmt->bindParam('dbid', $this->dbid);

        if ($stmt->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
