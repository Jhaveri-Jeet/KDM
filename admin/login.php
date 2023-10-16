<?php
require("../includes/init.php");

if (isset($_SESSION['LoggedInUserId']))
{
    header('Location: ' . urlOf('admin/'));
    exit();
}

if (isset($_POST['username']))
{
    header('Content-Type: application/json');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $row = selectOne("SELECT Id FROM `Users` WHERE `Username` = ? AND `Password` = ? ", [$username, $password]);

    if (!$row)
        echo json_encode(["status" => false, "message" => "Wrong username or password"]);
    else
    {
        $_SESSION['LoggedInUserId'] = $row['Id'];
        echo json_encode(["status" => true, "message" => "Logged in!"]);
    }

    exit();
}

require(pathOf("admin/includes/header.php"));
require(pathOf("admin/includes/nav.php"));
require(pathOf("admin/includes/sidebar.php"));
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Admin Panel Login</h3>
                        </div>
                        <form onsubmit="return login()">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button id="btn-submit" type="submit" class="btn btn-primary btn-login" id="btn-save-details">
                                    <span id="btn-submit-text">Submit</span>
                                    <span id="btn-submit-text-saved" style="display: none">Logged in!</span>
                                    <div id="btn-submit-spinner" class="spinner-border spinner-border-sm" role="status" style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div id="message">

                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
</div>
<?php
require(pathOf('admin/includes/footer-part1.php'));
require(pathOf('admin/includes/scripts.php'));
?>
<script src="<?= urlOf('admin/js/auth.js') ?>"></script>
<?php
require(pathOf('admin/includes/footer-part2.php'));
?>