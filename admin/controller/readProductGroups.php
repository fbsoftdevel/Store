<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../objects/ProductGroup.php';

$database = new Database();
$db = $database->getConnection();
$productGroup = new ProductGroup($db);

$stmt = $productGroup->readAll();
$num = $stmt->rowCount();

$data="";

if($num>0){
    $x=1;
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $data.='{';
            $data.='"dbid":"' . $dbid . '",';
            $data.='"storeRef":"' . html_entity_decode($store_ref) . '",';
            $data.='"groupName":"' . html_entity_decode($group_name) . '",';
            $data.='"discount":"' . $discount . '",';
            $data.='"groupDescription":"' . html_entity_decode($group_description) . '",';
            $data.='"created":"' . $created . '",';
            $data.='"modified":"' . $modified . '"';
        $data .='}';
    $data .=$x<$num ? ',' : ''; $x++;
    }
}
echo '{"records":[' . $data . ']}';


