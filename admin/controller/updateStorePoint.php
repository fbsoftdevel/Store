<?php

include_once '../../config/database.php';
include_once '../../objects/StorePoint.php';

$database = new Database();
$db = $database->getConnection();
$storePoint = new StorePoint($db);

$data = json_decode(file_get_contents("php://input"));
$storePoint->setDbid($data->dbid);
$storePoint->setStoreName($data->storeName);
$storePoint->setStoreLocation($data->storeLocation);

if($storePoint->update()){
    echo 'Store point was updated.';
}
 else {
    echo 'Unable to update Store point.';
}

