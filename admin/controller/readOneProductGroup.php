<?php

include_once '../../config/database.php';
include_once '../../objects/ProductGroup.php';

$database = new Database();
$db = $database->getConnection();
$productGroup = new ProductGroup($db);

$data = json_decode(file_get_contents("php://input"));
$productGroup->setDbid($data->dbid);
$productGroup->readOne();

$productGroup_arr[] = array(
    "dbid"=>$productGroup->getDbid(),
    "storeRef"=>$productGroup->getStoreRef(),
    "groupName"=>$productGroup->getGroupName(),
    "discount"=> $productGroup->getDiscount(),
    "groupDescription"=>$productGroup->getGroupDescription()
);
print_r(json_encode($productGroup_arr));

