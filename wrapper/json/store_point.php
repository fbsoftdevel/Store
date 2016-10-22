<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../objects/StorePoint.php';

$database = new Database();
$db = $database->getConnection();
$storePoint = new StorePoint($db);

$stmt = $storePoint->readAll();
$num = $stmt->rowCount();

$store_points = array();

if($num>0){
    $x=1;
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $store_points[] = $row;
    }
}
print_r(json_encode($store_points));