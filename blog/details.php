<?php
require '../includes/init.php';

$title = "Blog Post";

require pathOf('blog/utils.php');

if (!isset($_GET['id'])) {
    header('Location: ' . urlOf('blog'));
    exit();
}
$blogAll = select("SELECT * FROM `BlogPosts`");


$blogPost = selectOne("SELECT * FROM `BlogPosts` WHERE `Id` = ?", [$_GET['id']]);

$blogPostTitle = $blogPost['Title'];
$blogPostMarkup = readBlogFile($blogPost['ContentFileName']);
$dateTime = (new DateTime($blogPost['DateTime']))->format('d/m/Y H:i:s');
$thumbnailFileName = $blogPost['ThumbnailFileName'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Mobile = $_POST['Mobile'];
    $query = "INSERT INTO `NewsLetter`(`Mobile`) VALUES (?)";
    $params = [$mobile];
    execute($query, $params);

    header('Content-Type: application/json');
    echo json_encode(["status" => true, "message" => "Inquiry sent successfully."]);
}

?>

<head>
    <meta charset="utf-8">
    <title><?= isset($GLOBALS['title']) ? ($GLOBALS['title'] . ' - ') : '' ?>Calibre Aluminium Extrusion</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="<?= urlOf('assets/images/logo.png') ?>" rel="icon">
    <link href="<?= urlOf('lib/google-fonts/nunito.css') ?>" rel="stylesheet">
    <link href="<?= urlOf('lib/font-awesome/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= urlOf('lib/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= urlOf('lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
    <link href="<?= urlOf('lib/animate/animate.min.css') ?>" rel="stylesheet">
    <link href="<?= urlOf('lib/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= urlOf('css/style.css') ?>" rel="stylesheet">
    <link href="<?= urlOf('css/app.css') ?>" rel="stylesheet">

</head>
<div class="container-fluid">
    <div class="row">
        <div class="col-3 border">
            <div class="col text-center mt-5 sticky-top align-col-3">
                <div style="width:100%; height: 150px;background-image: url('http://localhost<?= urlOf('assets/images/logo-without-bg.png') ?>');background-size: contain;background-repeat: no-repeat;background-position: center;">

                </div>
                <!-- <img src="<?= urlOf("assets/images/logo-without-bg.png") ?>"
                                alt="Logo" style="" /> -->
                <h2 class="text-color">Calibre Aluminium Extrusion</h2>

                <div>
                    <h6 class="col-height">Subscribe for Price Updates</h6>
                </div>
                <div class="col-sm-12">
                    <form onsubmit="return createNewsLetter();">
                        <input type="text" placeholder="Enter Mobile Number" class="form-control form-control-lg" style="border-color:red" name="Mobile" id="Mobile">
                        <button id="btn-submit" type="submit" class="btn btn-danger w-50 py-2 mt-2" style="border-radius:10px !important">
                            <span id="btn-submit-text">Subscribe</span>
                            <span id="btn-submit-text-saved" style="display: none">Inquiry Sent!</span>
                            <div id="btn-submit-spinner" class="spinner-border spinner-border-sm" role="status" style="display: none">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </form>
                </div>
                <div class="col-height">
                    <h6>Copyright ©2023 All rights reserved | by <a href="https://calibrealuminium.com/" class="text-color">Calibre Aluminium Extrusion</a> </h6>
                </div>
            </div>
            <!-- <h1 class="navbar-brand sticky-lg-top" href="#">Calibre Aluminium Extrusion</h1> -->
            <!-- <nav id="navbar-example3" class="navbar navbar-light bg-light flex-column align-items-stretch p-3">
                
            </nav> -->
        </div>
        <div class="col-6 border">
            <section id="blog" class="blog-area pt-125 pb-130 blog-post-display align-col-3">
                <div class="container">
                    <div class="row">
                        <div class="col col-2 col-sm-2 col-md-2 col-lg-2">
                            <h2><a href="<?= urlOf('blog') ?>" style="color: #e31e25; margin-left: 10px"><b><i class="lni-arrow-left-circle"></i></b></a></h2>
                        </div>
                        <div class="col col-8 col-sm-8 col-md-8 col-lg-8 text-center mt-5">
                            <h2><?= $blogPostTitle ?></h2>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col text-center">
                            <img src="<?= urlOf("assets/uploads/blog-thumbnails/$thumbnailFileName") ?>" alt="blog post image" style="width: 80%; object-fit: cover;" />
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <?= $blogPostMarkup ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-3 border" style="background-color:#f8f9fb">
            <!-- Recent Post Start -->
            <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                    <h3 class="mb-0 mt-3">Most Popular Blogs</h3>
                </div>
                <?php foreach ($blogAll as $blogs) : ?>
                    <div class="d-flex rounded overflow-hidden mb-3">
                        <img src="<?= urlOf("assets/uploads/blog-thumbnails/{$blogs['ThumbnailFileName']}") ?>" alt="blog post image" style="width: 20%;height: 20%; object-fit: cover;" />

                        <a href="#" class="h1 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">
                            <h5><?= $blogs["Title"] ?></h5>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Recent Post End -->
        </div>
    </div>
</div>



<?php
require(pathOf('includes/footer-part1.php'));
require(pathOf('includes/scripts.php'));
?>

<?php
require(pathOf('includes/footer-part2.php'));
?>