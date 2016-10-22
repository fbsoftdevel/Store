<?php

include_once '../../config/database.php';
include_once '../../objects/ProductGroup.php';

$database = new Database();
$db = $database->getConnection();
$productGroup = new ProductGroup($db);

$data = json_decode(file_get_contents("php://input"));
$productGroup->setDbid($data->dbid);

if($productGroup->delete()){
    echo "Product group was deleted.";
}
 else {
    echo 'Unable to delete object';
}

