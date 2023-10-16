<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

$title = "Testimonial";
$rows = select("SELECT `Id`, `Name`, `Description`, `ImageName` FROM `Testimonial`");

require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));

?>
<div class="content-wrapper">
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Testimonial</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= urlOf('admin/') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Testimonial</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col" style="text-align: end">
                    <a role="button" class="btn btn-success" href="<?= urlOf('admin/testimonial/create.php') ?>">Create New</a>
                </div>
            </div>
            <div class="row">&nbsp;</div>
            <div class="card card-outline card-info">
                <div class="card-body">
                    <div class="col col-md-12">
                        <table class="table table-striped product-list">
                            <thead>
                                <tr>
                                    <th class="name">Name</th>
                                    <th class="description hide-on-small">Description</th>
                                    <th class="actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($rows); $i++) {
                                    $id = $rows[$i]['Id']; ?>
                                    <tr>
                                        <td class="number"><?= $i + 1 ?></td>
                                        <td class="name"><?= $rows[$i]['Name'] ?></td>
                                        <td class="description hide-on-small"><?= $rows[$i]['Description'] ?></td>
                                        <td class="actions">
                                            <div class="btn-group d-none d-lg-flex" role="group" aria-label="Actions">
                                                <a role="button" class="btn btn-primary" href="<?= urlOf("admin/testimonial/edit.php?id=$id") ?>" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <a role="button" class="btn btn-danger" onclick="showDeleteTestimonialConfirmation(<?= $rows[$i]['Id'] ?>)" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group-vertical d-lg-none" role="group" aria-label="Actions">
                                                <a role="button" class="btn btn-primary" href="<?= urlOf("admin/testimonial/edit.php?id=$id") ?>" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <a role="button" class="btn btn-danger" onclick="showDeleteTestimonialConfirmation(<?= $rows[$i]['Id'] ?>)" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </div>
                                            <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete-title" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modal-delete-title">Cofirmation</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this product?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            <button id="btn-yes" type="button" class="btn btn-danger" onclick="deleteTestimonial()">Yes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
        </section>
    </div>
</div>
<?php
require(pathOf('admin/includes/footer-part1.php'));
require(pathOf('admin/includes/scripts.php'));
?>
<script src="<?= urlOf('admin/js/testimonial.js') ?>"></script>
<?php
require(pathOf('admin/includes/footer-part2.php'));
?>