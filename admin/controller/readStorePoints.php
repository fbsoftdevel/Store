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

$data="";

if($num>0){
    $x=1;
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $data.='{';
            $data.='"dbid":"' . $dbid . '",';
            $data.='"storeName":"' . html_entity_decode($store_name) . '",';
            $data.='"storeLocation":"' . $store_location . '",';
            $data.='"created":"' . $created . '",';
            $data.='"modified":"' . $modified . '"';
        $data .='}';
    $data .=$x<$num ? ',' : ''; $x++;
    }
}
echo '{"records":[' . $data . ']}';

