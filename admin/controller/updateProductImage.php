<?php

include_once '../../config/database.php';
include_once '../../objects/ProductImage.php';

$database = new Database();
$db = $database->getConnection();
$productImage = new ProductImage($db);

$data = json_decode(file_get_contents("php://input"));
$productImage->setDbid($data->dbid);
$productImage->setImagePath($data->imagePath);
$productImage->setProductReference($data->productReference);
$productImage->setSorting($data->sorting);
$productImage->setDescription($data->description);

if($productImage->update()){
    echo 'Product image was updated.';
}
 else {
    echo 'Unable to update Product image.';
}
