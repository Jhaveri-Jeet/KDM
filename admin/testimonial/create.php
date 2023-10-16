<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    header('Content-Type: application/json');

    $time = time();
    $tmpFileName = $_FILES['image']['tmp_name'];
    $fileName = "$time-" . $_FILES['image']['name'];

    $fileUploaded = move_uploaded_file($tmpFileName, pathOf("assets/uploads/testimonial-images/$fileName"));
    if (!$fileUploaded) {
        echo json_encode(["status" => false, "message" => "Error uploading image(s)."]);
        exit();
    }

    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = "INSERT INTO `Testimonial` SET `Name` = ?, `Description` = ?, `ImageName` = ?";
    $params = [$name, $description, $fileName];
    execute($query, $params);

    header('Content-Type: application/json');
    echo json_encode(["status" => true, "message" => "Product created successfully."]);

    exit();
}

$title = "Create New Testimonial";

require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create New Testimonial</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/testimonial') ?>">Testimonial</a></li>
                        <li class="breadcrumb-item active">Create New</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col col-md-12">
                <form onsubmit="return createTestimonial();">
                    <div class="card card-outline card-info">
                        <div class="card-body">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <label for="testimonial-name">Name</label>
                                    <input type="text" class="form-control" id="testimonial-name" placeholder="Enter Name" autofocus required />
                                </div>
                            </div>
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <label for="testimonial-description">Description</label>
                                    <textarea class="form-control" id="testimonial-description" placeholder="Enter Description" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="image">Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="testimonial-image" required onchange="testimonialImageSelected();">
                                                    <label class="custom-file-label" for="product-image">Select images...</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-danger" onclick="clearTestimonialImage()">Clear</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <strong>Preview</strong>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div id="img-preview-list">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="btn-submit" type="submit" class="btn btn-success">
                                <span id="btn-submit-text">Create</span>
                                <span id="btn-submit-text-saved" style="display: none">Created!</span>
                                <div id="btn-submit-spinner" class="spinner-border spinner-border-sm" role="status" style="display: none">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </button>
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
<script src="<?= urlOf('admin/js/testimonial.js') ?>"></script>
<?php
require(pathOf('admin/includes/footer-part2.php'));
?>