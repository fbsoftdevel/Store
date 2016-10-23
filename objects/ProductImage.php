<?php

include_once 'iTemplate.php';

/**
 * Description of Product
 *
 * @author fabio
 */
class ProductImage implements iTemplate {

    private $conn;
    private $tableName = "product_images";
    
    public $dbid;
    public $description;
    public $imagePath;
    public $productReference;
    public $sorting;
    public $created;
    public $modified;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getDbid() {
        return $this->dbid;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getImagePath() {
        return $this->imagePath;
    }

    public function getProductReference() {
        return $this->productReference;
    }

    public function getSorting() {
        return $this->sorting;
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

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setImagePath($imagePath) {
        $this->imagePath = $imagePath;
    }

    public function setProductReference($productReference) {
        $this->productReference = $productReference;
    }

    public function setSorting($sorting) {
        $this->sorting = $sorting;
    }

    public function setCreated($created) {
        $this->created = $created;
    }

    public function setModified($modified) {
        $this->modified = $modified;
    }

    
    public function create() {
        $query = "INSERT INTO " . $this->tableName . " SET image_path=:imagePath, product_reference=:productReference, sorting=:sorting, description=:description, created=:created";

        $stmt = $this->conn->prepare($query);

        $this->setImagePath(htmlspecialchars(strip_tags($this->getImagePath())));
        $this->setProductReference(htmlspecialchars(strip_tags($this->getProductReference())));
        $this->setDescription(htmlspecialchars(strip_tags($this->getDescription())));
        $this->setSorting($this->getSorting());

        $stmt->bindParam("imagePath", $this->imagePath);
        $stmt->bindParam("productReference", $this->productReference);
        $stmt->bindParam("sorting", $this->sorting);
        $stmt->bindParam("description", $this->description);
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
        $query = "SELECT dbid, image_path, product_reference, sorting, description, created, modified"
                . " FROM " . $this->tableName . ""
                . " ORDER BY dbid DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT image_path, product_reference, sorting, description, created, modified"
                . " FROM " . $this->tableName . ""
                . " WHERE dbid = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->dbid);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->setImagePath($row['image_path']);
        $this->setProductReference($row['product_reference']);
        $this->setSorting($row['sorting']);
        $this->setDescription($row['description']);
        
    }

    public function update() {
        $query = "UPDATE " . $this->tableName .
                " image_path=:imagePath, "
                . "product_reference=:productReference, "
                . "sorting=:sorting, "
                . "description=:description"
                . " WHERE dbid = :dbid";

        $stmt = $this->conn->prepare($query);

        $this->setImagePath(htmlspecialchars(strip_tags($this->getImagePath())));
        $this->setProductReference(htmlspecialchars(strip_tags($this->getProductReference())));
        $this->setDescription(htmlspecialchars(strip_tags($this->getProductDescription())));
        $this->setSorting($this->getSorting());

        $stmt->bindParam("imagePath", $this->imagePath);
        $stmt->bindParam("productReference", $this->productReference);
        $stmt->bindParam("sorting", $this->sorting);
        $stmt->bindParam("description", $this->description);

        $stmt->bindParam('dbid', $this->dbid);

        if ($stmt->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
