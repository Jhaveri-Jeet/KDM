<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

if (!isset($_GET['id']))
{
    header('Location: ' . urlOf('admin/category'));
    exit();
}

$categoryId = $_GET['id'];
$row = selectOne("SELECT * FROM `Category` WHERE `Id` = ?", [$categoryId]);

if (!$row) {
    header('Location: ' . urlOf('admin/category'));
    exit();
}

$categoryImages = select("SELECT `ImageName` FROM `CategoryImages` WHERE `CategoryId` = ?", [$categoryId]);
foreach ($categoryImages as $image) {
    unlink(pathOf("admin/assets/uploads/category-images/" . $image['ImageName']));
}

execute("DELETE FROM `CategoryImages` WHERE `CategoryId` = ?", [$categoryId]);
execute("DELETE FROM `Category` WHERE `Id` = ?", [$categoryId]);

// header('Location: ' . urlOf('admin/category'));
