<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../objects/Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$stmt = $product->readAll();
$num = $stmt->rowCount();

$data = "";

if ($num > 0) {
    $x = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $data .= '{';
        $data .= '"dbid":"' . $dbid . '",';
        $data .= '"groupRef":"' . html_entity_decode($group_ref) . '",';
        $data .= '"productName":"' . html_entity_decode($product_name) . '",';
        $data .= '"discount":"' . $discount . '",';
        $data .= '"productDescription":"' . html_entity_decode($product_description) . '",';
        $data .= '"productImg":"' . $product_img . '",';
        $data .= '"buyPrice":"' . $buy_price . '",';
        $data .= '"sellPrice":"' . $sell_price . '",';
        $data .= '"created":"' . $created . '",';
        $data .= '"modified":"' . $modified . '"';
        $data .= '}';
        $data .= $x < $num ? ',' : '';
        $x++;
    }
}
echo '{"records":[' . $data . ']}';


