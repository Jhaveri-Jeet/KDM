<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    header('Content-Type: application/json');

    $uploadedFiles = array();
    if (isset($_FILES['images'])) {

        $time = time();
        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            $tmpFileName = $_FILES['images']['tmp_name'][$i];
            $fileName = "$time-" . $_FILES['images']['name'][$i];

            $fileUploaded = move_uploaded_file($tmpFileName, pathOf("assets/uploads/product-images/$fileName"));
            if (!$fileUploaded) {
                echo json_encode(["status" => false, "message" => "Error uploading image(s)."]);
                exit();
            }

            array_push($uploadedFiles, $fileName);
        }
    }

    $id = $_POST['id'];
    $categoryId = $_POST['club-id'];
    $productName = $_POST['product-name'];
    $productDescription = $_POST['product-description'];

    $query = "UPDATE `Product` SET `ProductName` = ?, `Description` = ?, `CategoryId` = ? WHERE `Id` = ?";
    $params = [ $productName, $productDescription, $categoryId, $id];
    $updated = execute($query, $params);

    if ($updated) {
        foreach ($uploadedFiles as $file)
            execute("INSERT INTO `ProductImages` (`ProductId`, `ImageName`) VALUES (?, ?)", [$id, $file]);
    }

    echo json_encode(["status" => true, "message" => "Product edited successfully."]);
    exit();
}

$title = "Edit Product";
$categories = select("SELECT `Id`, `Name` FROM `Category`");

$id = $_GET['id'];
$product = select("SELECT * FROM `Products` WHERE `Id` = ?", [$id]);
$productImages = select("SELECT `Id`, `ImageName` FROM `ProductsImages` WHERE `ProductId` = ?", [$id]);

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
                    <h1>Edit Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/Products') ?>">Products</a></li>
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
                <form onsubmit="return editProduct(<?= $product['Id'] ?>);">
                    <div class="card card-outline card-info">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="club">Select Category</label>
                                            <select class="custom-select" id="category" autofocus required>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?= $category['Id'] ?>" <?= $product['CategoryId'] == $category['Id'] ? " selected" : "" ?>><?= $category['Name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="product-name">Product Name</label>
                                            <input type="text" class="form-control" id="product-name" placeholder="Enter Product Name" required value="<?= $product['ProductName'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="product-description">Product Description</label>
                                            <textarea class="form-control" id="product-description" placeholder="Enter Product Description" rows="5" required><?= $product['Description'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="images">Products Images</label>
                                            <div class="input-group">
                                                <?php foreach ($productImages as $image) { ?>
                                                    <div class="img-wrap" id="img-wrap-<?= $image['Id'] ?>">
                                                        <img id="delete-<?= $image['Id'] ?>" class="delete" src="<?= urlOf("admin/assets/images/delete.png") ?>" alt="delete image" onclick="deleteProductImage(<?= $image['Id'] ?>)" />
                                                        <span id="delete-spinner-<?= $image['Id'] ?>" class="delete-spinner spinner-border spinner-border-sm" role="status" style="display: none">
                                                            <span class="sr-only">Loading...</span>
                                                        </span>
                                                        <img id="img-preview-<?= $image['Id'] ?>" class="img-preview" src="<?= urlOf("admin/assets/uploads/product-images/" . $image['ImageName']) ?>" alt="Product image" />
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div>&nbsp;</div>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="images" multiple onchange="productImagesSelected();">
                                                    <label class="custom-file-label" for="images">Add images...</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-danger" onclick="clearProductImages()">Clear</span>
                                                </div>
                                            </div>
                                            <div>&nbsp;</div>
                                            <div>Preview</div>
                                            <div>&nbsp;</div>
                                            <div id="img-preview-list">
                                            </div>
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
<script src="<?= urlOf('admin/js/products.js') ?>"></script>
<?php
require(pathOf('admin/includes/footer-part2.php'));
?>