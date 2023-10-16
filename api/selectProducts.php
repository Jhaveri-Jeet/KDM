<?php
include('../includes/init.php');

$categoryid = $_POST['categoryId'];

$selectedProducts = select('SELECT Products.Id, Products.Name, ProductImages.ImageName FROM Products INNER JOIN ProductImages ON ProductImages.ProductId = Products.Id WHERE Products.CategoryId = ?', [$categoryid]);
header("Content-type:application/json");
echo json_encode($selectedProducts);
