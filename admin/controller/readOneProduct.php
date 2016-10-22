<?php

include_once '../../config/database.php';
include_once '../../objects/Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));
$product->setDbid($data->dbid);
$product->readOne();

$product_arr[] = array(
    "dbid" => $product->getDbid(),
    "groupRef" => $product->getGroupRef(),
    "productName" => $product->getProductName(),
    "productDescription" => $product->getProductDescription(),
    "productImg" => $product->getProductImg(),
    "discount" => $product->getDiscount(),
    "buyPrice" => $product->getBuyPrice(),
    "sellPrice" => $product->getSellPrice()
);
print_r(json_encode($product_arr));

