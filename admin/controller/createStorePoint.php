<?php
include_once '../../config/database.php';
include_once '../../objects/StorePoint.php';

$database = new Database();
$db = $database->getConnection();
$storePoint = new StorePoint($db);

//get post data
$data = json_decode(file_get_contents("php://input"));

$storePoint->storeName = $data->storeName;
$storePoint->storeLocation = $data->storeLocation;
$storePoint->created = date(DATE_W3C);

if($storePoint->create()){
    echo 'Store point was created.';
}
else{
    echo 'Unable to create Store point.';
}