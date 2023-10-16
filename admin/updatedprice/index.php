<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

$title = "Price";
$rows = select("SELECT `Id`, `Mobile` FROM `NewsLetter`");

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
                        <h1>NewsLetter</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= urlOf('admin/') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Manage NewsLetter</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="row">&nbsp;</div>
            <div class="card card-outline card-info">
                <div class="card-body">
                    <div class="col col-md-12">
                        <table class="table table-striped item-list">
                            <thead>
                                <tr>
                                    <th scope="col" class="item-list-number">Number</th>
                                    <th scope="col" class="item-list-title" style="width: 60%">Mobile</th>
                                    <th scope="col" class="item-list-actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($rows); $i++) {
                                    $id = $rows[$i]['Id']; ?>
                                    <tr>
                                        <th scope="row" class="item-list-number"><?= $i + 1 ?></th>
                                        <td class="item-list-name"><?= $rows[$i]['Mobile'] ?></td>
                                        <td class="item-list-actions">
                                            <div class="btn-group d-none d-lg-flex" role="group" aria-label="Actions">
                                               
                                                <a role="button" class="btn btn-danger" onclick="showDeleteUpdatedPriceConfirmation(<?= $rows[$i]['Id'] ?>)" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group-vertical d-lg-none" role="group" aria-label="Actions">
                                               
                                                <a role="button" class="btn btn-danger" onclick="showDeleteUpdatedPriceConfirmation(<?= $rows[$i]['Id'] ?>)" data-toggle="tooltip" data-placement="bottom" title="Delete">
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
                                                            Are you sure you want to delete this Price?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            <button id="btn-yes" type="button" class="btn btn-danger" onclick="deleteUpdatedPrice()">Yes</button>
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
<script src="<?= urlOf('admin/js/updatedprice.js') ?>"></script>
<?php
require(pathOf('admin/includes/footer-part2.php'));
?>