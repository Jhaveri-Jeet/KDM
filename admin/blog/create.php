<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));
require(pathOf('blog/utils.php'));

if (isset($_POST['blogPostMarkup'])) {
    $blogPostTitle = $_POST['blogPostTitle'];
    $blogPostMarkup = $_POST['blogPostMarkup'];

    $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
    $currentDateTime = $dateTime->format('Y-m-d H:i:s');
    $currentTimestamp = $dateTime->getTimestamp();

    $blogFileName = "$currentTimestamp.txt";
    createBlogFile("$blogFileName", $blogPostMarkup);

    $thumbnailFileName = null;
    if (isset($_FILES['blogPostThumbnail'])) {
        $ext = pathinfo($_FILES['blogPostThumbnail']['name'], PATHINFO_EXTENSION);
        $thumbnailFileName = "$blogFileName.$ext";
        move_uploaded_file($_FILES['blogPostThumbnail']['tmp_name'], pathOf("admin/assets/uploads/blog-thumbnails/$thumbnailFileName"));
    }

    $query = "INSERT INTO `BlogPosts` (`Title`, `DateTime`, `ThumbnailFileName`, `ContentFileName`) VALUES (?, ?, ?, ?)";
    $params = [$blogPostTitle, $currentDateTime, $thumbnailFileName, $blogFileName];

    execute($query, $params);

    header('Content-Type: application/json');
    echo json_encode(["status" => true, "message" => "Blog post created successfully."]);

    exit();
}

$title = "New Blog Post";
$thumbnailFileName = urlOf('assets/images/borders.png');

require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>New Blog Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/blog') ?>">Blog Posts</a></li>
                        <li class="breadcrumb-item active">New Blog Post</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col col-md-12">
                <form onsubmit="return createBlogPost();">
                    <div class="card card-outline card-info">
                        <div class="card-body">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="blog-post-title">Blog Title</label>
                                        </div>
                                        <div class="col text-right">
                                            <label>Date: <?= (new DateTime('now', new DateTimeZone('Asia/Kolkata')))->format('d/m/Y') ?></label>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="blog-post-title" placeholder="Enter Blog Title here..." autofocus required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="blog-post-thumnail">Blog Thumbnail</label>
                                    <br>
                                    <div class="input-group" id="blog-post-thumbnail-group">
                                        <input type="file" class="form-control" id="blog-post-thumbnail" onchange="previewThumbnail()" placeholder="Select a Blog Post Thumbnail">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-info" onclick="clearThumbnail('<?= $thumbnailFileName ?>');">Clear</button>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <img src="<?= $thumbnailFileName ?>?<?= time() ?>" id="img-thumbnail" />
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="summernote">Blog Content</label>
                                </div>
                                <div id="summernote">

                                </div>
                            </div>
                            <div class="card-footer">
                                <button id="btn-preview" type="button" class="btn btn-info" onclick="showPreview()">Preview</button>
                                <button id="btn-submit" type="submit" class="btn btn-success">
                                    <span id="btn-submit-text">Create</span>
                                    <span id="btn-submit-text-saved" style="display: none">Created!</span>
                                    <div id="btn-submit-spinner" class="spinner-border spinner-border-sm" role="status" style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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