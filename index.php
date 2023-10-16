<?php include('./includes/styles.php'); ?>
<?php include('./includes/header.php'); ?>
<?php
$banners = select('SELECT Category.Name, Category.Id, CategoryImages.ImageName FROM Category INNER JOIN CategoryImages ON CategoryImages.CategoryId = Category.Id ORDER BY RAND() LIMIT 3');
$products = select('SELECT Category.Name as CategoryName, Products.Name as ProductName,Products.Id as productId, ProductImages.ImageName, Category.Id FROM Products INNER JOIN Category ON Category.Id = Products.CategoryId INNER JOIN ProductImages ON ProductImages.ProductId = Products.Id ORDER BY RAND() LIMIT 12');
$categoryNames = select('SELECT * FROM Category');
$blogs = select('SELECT * FROM BlogPosts ORDER BY RAND() LIMIT 3');
?>
<style>
    @media (max-width: 768px) {
        .hero__items {
            height: 300px;
        }

        .hero__items p {
            display: none;
        }

        .hero__items a {
            display: none;
        }
    }
</style>
<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="<?= urlOf('img/hero/hero-3.png') ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <br>
                            <h2>Black Marvel</h2>
                            <p>Ethically crafted with an unwavering commitment to exceptional quality.</p>
                            <a href="<?= urlOf('users/shop') ?>" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="<?= urlOf('img/hero/hero-4.png') ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <br>
                            <h2>Feorus</h2>
                            <p>Ethically crafted with an unwavering commitment to exceptional quality.</p>
                            <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <?php $imagename = $banners[0]['ImageName'] ?>
                        <?php $id = $banners[0]['Id'] ?>
                        <img src="<?= urlOf("admin/assets/uploads/category-images/$imagename") ?>" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2><?= $banners[0]['Name'] ?></h2>
                        <a href="<?= urlOf("users/shop/?id=$id") ?>">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <?php $imagename = $banners[1]['ImageName'] ?>
                        <?php $id = $banners[1]['Id'] ?>
                        <img src="<?= urlOf("admin/assets/uploads/category-images/$imagename") ?>" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2><?= $banners[1]['Name'] ?></h2>
                        <a href="<?= urlOf("users/shop/?id=$id") ?>">Shop now</a>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <?php $imagename = $banners[2]['ImageName'] ?>
                        <?php $id = $banners[2]['Id'] ?>
                        <img src="<?= urlOf("admin/assets/uploads/category-images/$imagename") ?>" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2><?= $banners[2]['Name'] ?></h2>
                        <a href="<?= urlOf("users/shop/?id=$id") ?>">Shop now</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- Banner Section End -->
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Best Products</li>
                    <?php foreach ($categoryNames as $categoryName) { ?>
                        <li data-filter=".<?= str_replace(' ', '', $categoryName['Name']) ?>"><?= $categoryName['Name'] ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            <?php foreach ($products as $product) {
                $imagename =  $product['ImageName'];
                $id =  $product['productId'];
            ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix <?= str_replace(' ', '', $product['CategoryName']) ?>">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="<?= urlOf("admin/assets/uploads/product-images/$imagename") ?>" style="background-image: url('<?= urlOf("admin/assets/uploads/product-images/$imagename") ?>');">
                            <!-- <span class="label">New</span> -->
                        </div>
                        <div class="product__item__text">
                            <h6><?= $product['ProductName'] ?></h6>
                            <a href="<?= urlOf("users/sub-product/?id=$id") ?>" class="add-cart">+ Show more</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Product Section End -->
<!-- Latest Blog Section Begin -->
<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Latest News</span>
                    <h2>Our New Products</h2>
                </div>
            </div>
        </div>
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
<!-- Latest Blog Section End -->
<?php include('./includes/footer.php'); ?>
<?php include('./includes/scripts.php'); ?>
<script>
    function sendId(id) {
        $.post('<?= urlOf('users/shop/index.php') ?>', {
            id: id,
        }, function() {
            window.location = './users/shop';
        })
    }
</script>