<?php include('../../includes/styles.php'); ?>
<?php include('../../includes/header.php'); ?>
<?php $blogs = select('SELECT * FROM BlogPosts'); ?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-blog set-bg" data-setbg="<?= urlOf('img/breadcrumb-bg.jpg') ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Our Blog</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <?php foreach ($blogs as $blog) { ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="<?= urlOf('admin/assets/uploads/blog-thumbnails/') . $blog['ThumbnailFileName'] ?>"></div>
                        <div class="blog__item__text">
                            <span><img src="<?= urlOf('img/icon/calendar.png') ?>" alt=""> <?= date("d-m-Y", strtotime($blog['DateTime'])) ?></span>
                            <h5><?= $blog['Title'] ?></h5>
                            <!-- <a href="#">Read More</a> -->
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Blog Section End -->

<?php include('../../includes/footer.php'); ?>
<?php include('../../includes/scripts.php'); ?>