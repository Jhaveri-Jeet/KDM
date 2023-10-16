<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

if (!isset($_GET['id']))
{
    header('Location: ' . urlOf('admin/tags'));
    exit();
}

$tagId = $_GET['id'];
$row = selectOne("SELECT * FROM `tags` WHERE `Id` = ?", [$tagId]);

if (!$row) {
    header('Location: ' . urlOf('admin/tags'));
    exit();
}
execute("DELETE FROM `tags` WHERE `Id` = ?", [$tagId]);

header('Location: ' . urlOf('admin/tags'));
