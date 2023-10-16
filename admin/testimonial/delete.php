<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

if (!isset($_GET['id']))
{
    header('Location: ' . urlOf('admin/testimonial'));
    exit();
}

$id = $_GET['id'];
$row = selectOne("SELECT * FROM `Testimonial` WHERE `Id` = ?", [$id]);

unlink(pathOf("assets/uploads/product-images/{$row['ImageName']}"));
execute("DELETE FROM `Testimonial` WHERE `Id` = ?", [$id]);

header('Location: ' . urlOf('admin/testimonial'));
