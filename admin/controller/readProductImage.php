<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../objects/ProductImage.php';

$database = new Database();
$db = $database->getConnection();
$productImage = new ProductImage($db);

$stmt = $productImage->readAll();
$num = $stmt->rowCount();

$data="";

if($num>0){
    $x=1;
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $data.='{';
            $data.='"dbid":"' . $dbid . '",';
            $data.='"imagePath":"' . html_entity_decode($image_path) . '",';
            $data.='"productReference":"' . html_entity_decode($product_reference) . '",';
            $data.='"sorting":"' . html_entity_decode($sorting) . '",';
            $data.='"description":"' . html_entity_decode($description) . '",';
            $data.='"created":"' . $created . '",';
            $data.='"modified":"' . $modified . '"';
        $data .='}';
    $data .=$x<$num ? ',' : ''; $x++;
    }
}
echo '{"records":[' . $data . ']}';


