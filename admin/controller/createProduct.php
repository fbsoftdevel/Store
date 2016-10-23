<?php
include_once '../../config/database.php';
include_once '../../objects/Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

//get post data
$data = json_decode(file_get_contents("php://input"));

$product->setGroupRef($data->groupRef);
$product->setProductName($data->productName);
$product->setProductDescription($data->productDescription);
$product->setProductImg($data->productImage);
$product->setDiscount($data->discount);
$product->setBuyPrice($data->buyPrice);
$product->setSellPrice($data->sellPrice);
$product->setCreated(date(DATE_W3C));

if($product->create()){
    echo 'Product was created.';
}
else{
    echo 'Unable to create Product.';
}