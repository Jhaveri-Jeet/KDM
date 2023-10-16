<?php

require("../../includes/init.php");
require(pathOf('admin/includes/auth.php'));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $userName = $_POST['userName'];
    $userPassword = $_POST['userPassword'];

    $query = "UPDATE `Users` SET `Name` = ?, `Password` = ? WHERE `Id` = ?";
    $params = [$userName, $userPassword, $id];

    execute($query, $params);

    header('Content-Type: application/json');
    echo json_encode(["status" => true, "message" => "User edited successfully."]);

    exit();
} elseif (!isset($_GET['id'])) {
    header('Location: ' . urlOf('admin/Users'));
    exit();
}

$title = "Edit Club";

$id = $_GET['id'];
$query = "SELECT * FROM `Users` WHERE `Id` = ?";
$user = selectOne($query, [$id]);

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
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= urlOf('admin/clubs') ?>">Users</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col col-md-12">
                <form onsubmit="return editUser(<?= $id ?>);">
                    <div class="card card-outline card-info">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="club-name">User Name</label>
                                            <input type="text" class="form-control" id="user-name" placeholder="Enter User Name" autofocus required value="<?= $user['Name'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="user-password">User Password</label>
                                            <input type="text" class="form-control" id="user-password" placeholder="Enter Password Name" value="<?= $user['Password'] ?>" required>
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
<script src="<?= urlOf('admin/js/users.js') ?>"></script>
<?php
require(pathOf('admin/includes/footer-part2.php'));
?>