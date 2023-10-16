<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));
require(pathOf('blog/utils.php'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['blogPostTitle'] = $_POST['blogPostTitle'];
    $_SESSION['blogPostMarkup'] = $_POST['blogPostMarkup'];
    $_SESSION['blogPostThumbnail'] = $_POST['blogPostThumbnail'];
    
    exit();
}

if (isset($_SESSION['blogPostMarkup'])) {

    $blogPostTitle = $_SESSION['blogPostTitle'];
    $blogPostMarkup = $_SESSION['blogPostMarkup'];
    $thumbnail = $_SESSION['blogPostThumbnail'];
    $dateTime = 'now';

    unset($_SESSION['blogPostTitle']);
    unset($_SESSION['blogPostMarkup']);
} elseif (isset($_GET['id'])) {

    $row = selectOne("SELECT `Title`, `DateTime`, `ThumbnailFileName`, `ContentFileName` FROM `BlogPosts` WHERE `Id` = ?", [$_GET['id']]);
    if ($row == null || count($row) == 0)
        header('Location: ' . pathOf('/'));

    $blogPostTitle = $row['Title'];
    $blogPostMarkup = readBlogFile($row['ContentFileName']);
    $thumbnail = $row['ThumbnailFileName'];
    $dateTime = $row['DateTime'];
}

$title = "Blog Post Preview";

require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blog Post Preview</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/blog') ?>">Blog Posts</a></li>
                        <li class="breadcrumb-item active">Preview</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-body" id="preview">
                        <h1><?= $blogPostTitle ?></h1>
                        <h5>Date: <?= (new DateTime($dateTime, new DateTimeZone('Asia/Kolkata')))->format('d/m/Y H:i:s') ?></h5>
                        <br><br>
                        <?php if ($thumbnail !== null) { ?>
                            <img src="<?= str_starts_with($thumbnail, "data:image") ? $thumbnail : urlOf('admin/assets/uploads/blog-thumbnails/' . $thumbnail . '?' . time()) ?>" alt="blog post image" id="img-thumbnail" />
                            <br><br><br>
                        <?php } ?>
                        <?= $blogPostMarkup ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require(pathOf('admin/includes/footer-part1.php'));
require(pathOf('admin/includes/scripts.php'));
?>
<script src="<?= urlOf('admin/js/blog.js') ?>"></script>
<?php
require(pathOf('admin/includes/footer-part2.php'));
?>