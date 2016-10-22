<?php

include_once '../../config/database.php';
include_once '../../objects/ProductImage.php';

$database = new Database();
$db = $database->getConnection();
$productImage = new ProductImage($db);

$data = json_decode(file_get_contents("php://input"));
$productImage->setDbid($data->dbid);
$productImage->readOne();

$productImage_arr[] = array(
    "dbid"=>$productImage->getDbid(),
    "imagePath"=>$productImage->getImagePath(),
    "productReference"=>$productImage->getProductReference(),
    "sorting"=>$productImage->getSorting(),
    "escription"=>$productImage->getDescription()
);
print_r(json_encode($productImage_arr));

