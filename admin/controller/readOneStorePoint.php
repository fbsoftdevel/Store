<?php

include_once '../../config/database.php';
include_once '../../objects/StorePoint.php';

$database = new Database();
$db = $database->getConnection();
$storePoint = new StorePoint($db);

$data = json_decode(file_get_contents("php://input"));
$storePoint->setDbid($data->dbid);
$storePoint->readOne();

$storePoint_arr[] = array(
    "dbid"=>$storePoint->getDbid(),
    "storeName"=> $storePoint->getStoreName(),
    "storeLocation"=>$storePoint->getStoreLocation()
);
print_r(json_encode($storePoint_arr));
