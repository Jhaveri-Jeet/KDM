<?php include('../../includes/styles.php'); ?>
<?php include('../../includes/header.php'); ?>

<?php

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $selectedProducts = select('SELECT SubProducts.Id, SubProducts.Name, SubProductsImages.ImageName FROM SubProducts INNER JOIN SubProductsImages ON SubProductsImages.SubProductId = SubProducts.Id WHERE SubProducts.ProductId = ?', [$productId]);
    $productName = selectOne('SELECT * FROM Products WHERE Id = ?', [$productId]);
}

// $categoryNames = select('SELECT * FROM Category');
// $productLists = select('SELECT Category.Name as CategoryName, Products.Name as ProductName, ProductImages.ImageName FROM Products INNER JOIN Category ON Category.Id = Products.CategoryId INNER JOIN ProductImages ON Products.Id = ProductImages.ProductId');
// $randomProducts = select('SELECT Products.Id, Products.Name, ProductImages.ImageName FROM Products INNER JOIN ProductImages ON ProductImages.ProductId = Products.Id GROUP BY RAND() LIMIT 12');
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="<?= urlOf('') ?>">Home</a>
                        <a href="<?= urlOf('users/shop') ?>">Shop</a>
                        <span><?= $productName['Name'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="col-lg-12">
            <div class="row" id="randomProducts">
                <?php if (isset($_GET['id'])) {
                    foreach ($selectedProducts as $selectedProduct) {
                        $imagename = $selectedProduct['ImageName'];
                        $subproductId = $selectedProduct['Id']; ?>
                        <div class="col-lg-3 col-md-7 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="">
                                    <img src="<?= urlOf("admin/assets/uploads/subproduct-images/$imagename") ?>" alt="">
                                </div>
                                <div class="product__item__text">
                                    <h6><?= $selectedProduct['Name'] ?></h6>
                                    <a href="<?= urlOf("users/product-details?id=$subproductId") ?>" class="add-cart">+ Show Details</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php  } ?>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<?php include('../../includes/footer.php'); ?>
<?php include('../../includes/scripts.php'); ?>