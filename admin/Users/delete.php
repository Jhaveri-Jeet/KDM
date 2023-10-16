<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

if (!isset($_GET['id']))
{
    header('Location: ' . urlOf('admin/Users'));
    exit();
}

$userId = $_GET['id'];
$row = selectOne("SELECT * FROM `Users` WHERE `Id` = ?", [$userId]);

if (!$row) {
    header('Location: ' . urlOf('admin/Users'));
    exit();
}

execute("DELETE FROM `Users` WHERE `Id` = ?", [$userId]);
header('Location: ' . urlOf('admin/Users'));
