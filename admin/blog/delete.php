<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));
require(pathOf('blog/utils.php'));


if (!isset($_GET['id'])) {
    header('Location: ' . urlOf('admin/blog'));
    exit();
}

$blogPostId = $_GET['id'];
$row = selectOne("SELECT `ThumbnailFileName`, `ContentFileName` FROM `BlogPosts` WHERE `Id` = ?", [$blogPostId]);

if (!$row) {
    header('Location: ' . urlOf('admin/blog'));
    exit();
}

$blogFileName = $row['ContentFileName'];
$thumbnailFileName = $row['ThumbnailFileName'];

deleteBlogFile($blogFileName);
deleteThumbnailFile($thumbnailFileName);

execute("DELETE FROM `BlogPosts` WHERE `Id` = ?", [$blogPostId]);

header('Location: ' . urlOf('admin/blog'));
