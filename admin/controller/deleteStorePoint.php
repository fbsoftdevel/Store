<?php

include_once '../../config/database.php';
include_once '../../objects/StorePoint.php';

$database = new Database();
$db = $database->getConnection();
$storePoint = new StorePoint($db);

$data = json_decode(file_get_contents("php://input"));
$storePoint->setDbid($data->dbid);

if($storePoint->delete()){
    echo "Store point was deleted.";
}
 else {
    echo 'Unable to delete object';
}

