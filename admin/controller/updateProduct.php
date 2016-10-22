<?php

include_once '../../config/database.php';
include_once '../../objects/Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$product->setDbid($data->dbid);
$product->setGroupRef($data->groupRef);
$product->setProductName($data->productName);
$product->setProductDescription($data->productDescription);
$product->setProductImg($data->productImg);
$product->setDiscount($data->discount);
$product->setBuyPrice($data->buyPrice);
$product->setSellPrice($data->sellPrice);

if ($product->update()) {
    echo 'Product was updated.';
} else {
    echo 'Unable to update Product.';
}
