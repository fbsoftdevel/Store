<?php
include_once '../../config/database.php';
include_once '../../objects/ProductGroup.php';

$database = new Database();
$db = $database->getConnection();
$productGroup = new ProductGroup($db);

//get post data
$data = json_decode(file_get_contents("php://input"));

$productGroup->setStoreRef($data->storeRef);
$productGroup->setGroupName($data->groupName);
$productGroup->setDiscount($data->discount);
$productGroup->setGroupDescription($data->groupDescription);
$productGroup->setCreated(date(DATE_W3C));

if($productGroup->create()){
    echo 'Product group was created.';
}
else{
    echo 'Unable to create Product group.';
}