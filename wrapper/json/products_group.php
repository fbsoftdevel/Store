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

$product_groups = array();

if($num>0){
    $x=1;
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $product_groups[] = $row;
    }
}
print_r(json_encode($product_groups));
