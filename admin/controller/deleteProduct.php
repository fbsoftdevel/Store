<?php

include_once '../../config/database.php';
include_once '../../objects/Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));
$product->setDbid($data->dbid);

if($product->delete()){
    echo "Product was deleted.";
}
 else {
    echo 'Unable to delete object';
}

