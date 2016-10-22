<?php

include_once '../../config/database.php';
include_once '../../objects/ProductImage.php';

$database = new Database();
$db = $database->getConnection();
$productImage = new ProductImage($db);

$data = json_decode(file_get_contents("php://input"));
$productImage->setDbid($data->dbid);

if($productImage->delete()){
    echo "Product image group was deleted.";
}
 else {
    echo 'Unable to delete object';
}

