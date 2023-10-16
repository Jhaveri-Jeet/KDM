<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));
require(pathOf('blog/utils.php'));

if (isset($_POST['blogPostMarkup'])) {

    $blogPostId = $_POST['id'];
    $blogPostTitle = $_POST['blogPostTitle'];
    $blogPostMarkup = $_POST['blogPostMarkup'];

    $row = selectOne("SELECT `ThumbnailFileName`, `ContentFileName` FROM `BlogPosts` WHERE `Id` = ?", [$blogPostId]);
    $thumbnailFileName = $row['ThumbnailFileName'];
    $blogFileName = $row['ContentFileName'];

    if (isset($_FILES['blogPostThumbnail'])) {
        if ($thumbnailFileName != null)
            deleteThumbnailFile($thumbnailFileName);
        else
            $thumbnailFileName = $blogFileName . '.' . pathinfo($_FILES['blogPostThumbnail']['name'], PATHINFO_EXTENSION);

        move_uploaded_file($_FILES['blogPostThumbnail']['tmp_name'], pathOf("admin/assets/uploads/blog-thumbnails/$thumbnailFileName"));
    } elseif ($_POST['removeThumbnail'] == 'Yes' && $thumbnailFileName != null) {
        deleteThumbnailFile($thumbnailFileName);
        $thumbnailFileName = null;
    }

    deleteBlogFile($blogFileName);
    createBlogFile($blogFileName, $blogPostMarkup);

    $query = "UPDATE `BlogPosts` SET `Title` = ?, `ThumbnailFileName` = ? WHERE `Id` = ?";
    $params = [$blogPostTitle, $thumbnailFileName, $blogPostId];

    execute($query, $params);

    header('Content-Type: application/json');
    echo json_encode(["status" => true, "message" => "Blog post updated successfully."]);

    exit();
} elseif (!isset($_GET['id'])) {
    header('Location: ' . urlOf('blog'));
    exit();
}

$title = "Edit Blog Post";
$blogPostId = $_GET['id'];

$row = selectOne("SELECT * FROM `BlogPosts` WHERE `Id` = ?", [$blogPostId]);
if (!$row) {
    header('Location: ' . urlOf('blog'));
    exit();
}

$blogPostTitle = $row['Title'];
$blogPostMarkup = readBlogFile($row['ContentFileName']);
$dateTime = $row['DateTime'];
$thumbnailFileName = $row['ThumbnailFileName'] != null ? urlOf('admin/assets/uploads/blog-thumbnails/' . $row['ThumbnailFileName']) : urlOf('assets/images/borders.png');

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
                    <h1>Edit Blog Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/blog') ?>">Blog Posts</a></li>
                        <li class="breadcrumb-item active">Edit Blog Post</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col col-md-12">
                <form onsubmit="return updateBlogPost(<?= $blogPostId ?>)">
                    <div class="card card-outline card-info">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="blog-post-title">Blog Title</label>
                                        </div>
                                        <div class="col text-right">
                                            <label>Created on date: <?= (new DateTime($dateTime, new DateTimeZone('Asia/Kolkata')))->format('d/m/Y H:i:s') ?></label>
                                        </div>
                                    </div>
                                    <input value="<?= $blogPostTitle ?>" type="text" class="form-control" id="blog-post-title" placeholder="Enter Blog Title here..." autofocus required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="blog-post-thumnail">Blog Thumbnail (Leave empty to keep the current thumbnail)</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" onclick="removeThumbnailToggled(this, '<?= $thumbnailFileName ?>')" />
                                        <label class="form-check-label text-red" for="remove-thumbnail">
                                            <strong>Remove Thumbnail?</strong>
                                        </label>
                                        <input type="hidden" id="remove-thumbnail" value="No" />
                                    </div>
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
                                <br><br>
                                <div class="form-group">
                                    <label for="blog-post-thumnail">Blog Content</label>
                                </div>
                                <div id="summernote">
                                    <?= $blogPostMarkup ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button id="btn-submit" type="submit" class="btn btn-success">
                                    <span id="btn-submit-text">Save</span>
                                    <span id="btn-submit-text-saved" style="display: none">Saved!</span>
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