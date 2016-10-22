<?php

include_once '../../config/database.php';
include_once '../../objects/ProductGroup.php';

$database = new Database();
$db = $database->getConnection();
$productGroup = new ProductGroup($db);

$data = json_decode(file_get_contents("php://input"));
$productGroup->setDbid($data->dbid);
$productGroup->setStoreRef($data->storeRef);
$productGroup->setGroupName($data->groupName);
$productGroup->setDiscount($data->discount);
$productGroup->setGroupDescription($data->groupDescription);

if($productGroup->update()){
    echo 'Product group was updated.';
}
 else {
    echo 'Unable to update Product group.';
}
