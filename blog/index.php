<?php
require '../includes/init.php';
$title = "Blog";
$headerName = 'Blog';
$headerTitle = 'Blog Main Page';
require pathOf('includes/header.php');
require pathOf('includes/red-header.php');


$latestBlogPosts = select("SELECT * FROM `BlogPosts` ORDER BY `DateTime` DESC")
?>
    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row">
                <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                    <h1 class="mb-0">Blog</h1>
                </div>
            </div>
            <div class="row g-5">
                <!-- Blog list Start -->
                <div class="col-lg-12">
                    <div class="row g-5">
                        <?php foreach ($latestBlogPosts as $blogPost): ?>
                        <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden text-center p-3">
                                    <img class="img-fluid" src="<?= urlOf("assets/uploads/blog-thumbnails/{$blogPost['ThumbnailFileName']}") ?>" alt="" style="height: 12rem" />
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i><?= (new DateTime($blogPost['DateTime']))->format('d M, Y') ?></small>
                                    </div>
                                    <h4 class="mb-3 h-25"><?= $blogPost['Title'] ?></h4>
                                    <a class="read-more-link text-uppercase" href="<?= urlOf('blog/details.php?id=' . $blogPost['Id']) ?>" target="_blank">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Blog list End -->
            </div>
        </div>
    </div>
    <!-- Blog End -->
<?php
require(pathOf('includes/footer-part1.php'));
require(pathOf('includes/scripts.php'));
?>

<?php
require(pathOf('includes/footer-part2.php'));
?>