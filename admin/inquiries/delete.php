<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

if (!isset($_GET['id']))
{
    header('Location: ' . urlOf('admin/inquiries'));
    exit();
}

$id = $_GET['id'];
execute("DELETE FROM `Contact` WHERE `Id` = ?", [$id]);

header('Location: ' . urlOf('admin/inquiries'));