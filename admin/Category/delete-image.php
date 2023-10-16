<?php

require('../../includes/init.php');
header('Content-Type: application/json');

if (!isset($_GET['id']))
{
    echo json_encode(['status' => false, 'message' => 'Could not delete image.']);
    exit();
}

$id = $_GET['id'];

$image = selectOne("SELECT `ImageName` FROM `CategoryImages` WHERE `Id` = ?", [$id]);
unlink(pathOf('admin/assets/uploads/category-images/' . $image['ImageName']));

execute("DELETE FROM `CategoryImages` WHERE `Id` = ?", [$id]);
echo json_encode(['status' => true, 'message' => 'Image deleted.']);
