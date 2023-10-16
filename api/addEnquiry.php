<?php

include('../includes/init.php');

$categoryId = $_POST['categoryid'];
$productId = $_POST['productid'];
$subproductId = $_POST['subproductid'];
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$description = $_POST['description'];

$query = "INSERT INTO `EnquiryCart`(`CategoryId`, `ProductId`, `SubProductId`, `CompanyName`, `E-Mail`, `Mobile`, `Description`) VALUES (?,?,?,?,?,?,?)";
$params = [$categoryId, $productId, $subproductId, $name, $email, $mobile, $description];

execute($query, $params);
