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

            $fileUploaded = move_uploaded_file($tmpFileName, pathOf("admin/assets/uploads/product-images/$fileName"));

            if (!$fileUploaded) {
                echo json_encode(["status" => false, "message" => "Error uploading image(s)."]);
                exit();
            }

            array_push($uploadedFiles, $fileName);
        }
    }

    $categoryId = $_POST['category-id'];
    $productName = $_POST['product-name'];
    $productDescription = $_POST['product-description'];

    $query = "INSERT INTO `Products` (`Name`, `Description`, `CategoryId`) VALUES (?, ?, ?)";
    $params = [$productName, $productDescription, $categoryId];

    $inserted = execute($query, $params);

    if ($inserted) {
        $productId = lastInsertId();
        foreach ($uploadedFiles as $file)
            execute("INSERT INTO `ProductImages` (`ProductId`, `ImageName`) VALUES (?, ?)", [$productId, $file]);
    }

    echo json_encode(["status" => true, "message" => "Product created successfully."]);
    exit();

}

$title = "Create New Product";
$categories = select("SELECT `Id`, `Name` FROM `Category`");

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
                    <h1>Create New Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/Products') ?>">Products</a></li>
                        <li class="breadcrumb-item active">Create New</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col col-md-12">
                <form onsubmit="return createProduct();">
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
                                                <option value="<?= $category['Id'] ?>"><?= $category['Name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="product-name">Product Name</label>
                                            <input type="text" class="form-control" id="product-name"
                                                placeholder="Enter Product Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="product-description">Product Description</label>
                                            <textarea class="form-control" id="product-description"
                                                placeholder="Enter Product Name" rows="5" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="images">Product Images</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="images" multiple
                                                        onchange="productImagesSelected();">
                                                    <label class="custom-file-label" for="images">Select
                                                        images...</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-danger"
                                                        onclick="clearProductImages()">Clear</span>
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
                                    <span id="btn-submit-text">Create</span>
                                    <span id="btn-submit-text-saved" style="display: none">Created!</span>
                                    <div id="btn-submit-spinner" class="spinner-border spinner-border-sm" role="status"
                                        style="display: none">
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