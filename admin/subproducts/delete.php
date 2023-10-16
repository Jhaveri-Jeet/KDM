<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

if (!isset($_GET['id']))
{
    header('Location: ' . urlOf('admin/subproducts'));
    exit();
}

$productId = $_GET['id'];
$row = selectOne("SELECT * FROM `SubProducts` WHERE `Id` = ?", [$productId]);

if (!$row) {
    header('Location: ' . urlOf('admin/subproducts'));
    exit();
}

$productImages = select("SELECT `ImageName` FROM `SubProducts` WHERE `Id` = ?", [$productId]);
foreach ($productImages as $image) {
    unlink(pathOf("assets/uploads/subproduct-images/" . $image['ImageName']));
}

// execute("DELETE FROM `ProductsImages` WHERE `ProductId` = ?", [$productId]);
execute("DELETE FROM `SubProducts` WHERE `Id` = ?", [$productId]);

header('Location: ' . urlOf('admin/SubProducts'));
