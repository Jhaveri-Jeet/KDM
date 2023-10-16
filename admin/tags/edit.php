<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    header('Content-Type: application/json');

    $id = $_POST['id'];
    $productId = $_POST['product-id'];
    $tagName = $_POST['tag-name'];

    $query = "UPDATE `tags` SET `productId` = ?, `tagName` = ? WHERE `Id` = ?";
    $params = [$productId, $tagName, $id];
    execute($query, $params);

    echo json_encode(["status" => true, "message" => "Tags edited successfully."]);
    exit();
}


$title = "Edit Tags";
$products = selectOne("SELECT `Id`, `Name` FROM `Products`");


$id = $_GET['id'];
$tags = selectOne("SELECT * FROM `tags` WHERE `Id` = ?", [$id]);
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
                    <h1>Edit Tags</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/tags') ?>">Tags</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col col-md-12">
                <form onsubmit="return editTags(<?= $tags['Id'] ?>);">
                    <div class="card card-outline card-info">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="club">Select Product</label>
                                            <select class="custom-select" id="product" autofocus required>
                                                <?php foreach ($products as $product) { ?>
                                                    <option value="<?= $products['Id'] ?>" <?= $tags['ProductId'] == $products['Id'] ? " selected" : "" ?>><?= $products['Name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="activity-name">Tags Name</label>
                                            <input type="text" class="form-control" id="tag-name" placeholder="Enter Tag Name" required value="<?= $tags['TagName'] ?>">
                                        </div>
                                    </div>
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
<script src="<?= urlOf('admin/js/tags.js') ?>"></script>
<?php
require(pathOf('admin/includes/footer-part2.php'));
?>