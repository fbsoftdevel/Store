<?php
include_once '../../config/database.php';
include_once '../../objects/ProductImage.php';

$database = new Database();
$db = $database->getConnection();
$productImage = new ProductImage($db);

//get post data
$data = json_decode(file_get_contents("php://input"));

$productImage->setDbid($data->dbid);
$productImage->setImagePath($data->imagePath);
$productImage->setProductReference($data->productReference);
$productImage->setSorting($data->sorting);
$productImage->setDescription($data->description);
$productImage->setCreated(date(DATE_W3C));

if($productImage->create()){
    echo 'Product image was created.';
}
else{
    echo 'Unable to create Product image.';
}