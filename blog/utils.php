<?php

function createBlogFile($fileName, $content)
{
    $file_path = pathOf("admin/assets/uploads/blog-files/$fileName");
    file_put_contents($file_path, $content);
}

function readBlogFile($fileName)
{
    $file_path = pathOf("admin/assets/uploads/blog-files/$fileName");
    return file_get_contents($file_path);
}

function deleteBlogFile($fileName)
{
    $file_path = pathOf("admin/assets/uploads/blog-files/$fileName");
    unlink($file_path);
}

function deleteThumbnailFile($fileName)
{
    $file_path = pathOf("admin/assets/uploads/blog-thumbnails/$fileName");
    unlink($file_path);
}