<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

if (!isset($_GET['id']))
{
    header('Location: ' . urlOf('admin/Products'));
    exit();
}

$productId = $_GET['id'];
$row = selectOne("SELECT * FROM `Products` WHERE `Id` = ?", [$productId]);

if (!$row) {
    header('Location: ' . urlOf('admin/Products'));
    exit();
}

$productImages = select("SELECT `ImageName` FROM `ProductsImages` WHERE `ProductId` = ?", [$productId]);
foreach ($productImages as $image) {
    unlink(pathOf("assets/uploads/product-images/" . $image['ImageName']));
}

execute("DELETE FROM `ProductsImages` WHERE `ProductId` = ?", [$productId]);
execute("DELETE FROM `Products` WHERE `Id` = ?", [$productId]);

header('Location: ' . urlOf('admin/Products'));
