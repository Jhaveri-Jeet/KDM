<?php include('../../includes/styles.php'); ?>
<?php include('../../includes/header.php'); ?>

<?php

if (isset($_GET['id'])) {
    $subproductId = $_GET['id'];
    $selectsubproductinfo = selectOne('SELECT Category.Name as CategoryName, Products.Name as ProductName, SubProducts.Name as SubProductName, SubProductsImages.ImageName, SubProducts.Sku, SubProducts.Description FROM SubProducts INNER JOIN Category ON Category.Id = SubProducts.CategoryId INNER JOIN Products ON Products.Id = SubProducts.ProductId INNER JOIN SubProductsImages ON SubProductsImages.SubProductId = SubProducts.Id WHERE SubProducts.Id = ?', [$subproductId]);
    $selectcategoryandproductid = selectOne('SELECT Category.Id as CategoryId, Products.Id as ProductId, SubProducts.Id as SubproductId FROM SubProducts INNER JOIN Category ON SubProducts.CategoryId = Category.Id INNER JOIN Products ON Products.Id = SubProducts.ProductId WHERE SubProducts.Id = ?', [$subproductId]);
    $imagename = $selectsubproductinfo['ImageName'];
    $randomproducts = select("SELECT Products.Name as ProductName, SubProducts.Name as SubProductName, SubProducts.Id, SubProductsImages.ImageName FROM SubProducts INNER JOIN Products ON Products.Id = SubProducts.ProductId INNER JOIN SubProductsImages ON SubProductsImages.SubProductId = SubProducts.Id ORDER BY RAND() LIMIT 4");
}
?>
<!-- Shop Details Section Begin -->
<section class="shop-details">
    <div class="product__details__pic" style="background-color: white !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="<?= urlOf('') ?>">Home</a>
                        <a href="<?= urlOf('users/shop') ?>">Shop</a>
                        <a href="#"><?= $selectsubproductinfo['CategoryName'] ?></a>
                        <a href="#"><?= $selectsubproductinfo['ProductName'] ?></a>
                        <span><?= $selectsubproductinfo['SubProductName'] ?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-11">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="<?= urlOf("admin/assets/uploads/subproduct-images/$imagename") ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4><?= $selectsubproductinfo['SubProductName'] ?></h4>
                        <div class="product__details__btns__option">
                            <a onclick="enquiryBox.showModal()"><i class="fa fa-heart"></i> Create Enquiry</a>
                        </div>
                        <dialog id="enquiryBox" class="col-lg-6 col-md-6" style="border-radius: 10px;">
                            <div class="contact__form">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Company Name: " style="border-radius: 10px;" id="name">
                                            <input type="hidden" value="<?= $selectcategoryandproductid['CategoryId'] ?>" id="categoryid">
                                            <input type="hidden" value="<?= $selectcategoryandproductid['ProductId'] ?>" id="productid">
                                            <input type="hidden" value="<?= $selectcategoryandproductid['SubproductId'] ?>" id="subproductid">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="email" placeholder="Email: " style="border-radius: 10px;" id="email">
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="text" placeholder="Mobile Number: " style="border-radius: 10px;" id="mobile">
                                        </div>
                                        <div class="col-lg-12">
                                            <textarea placeholder="Description: " style="border-radius: 10px;" id="description"></textarea>
                                            <button type="button" class="site-btn" onclick="sendData()" style="border-radius: 10px;">Send Enquiry</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </dialog>
                        <div class="product__details__last__option">
                            <ul>
                                <li><span>SKU:</span> <?= $selectsubproductinfo['Sku'] ?></li>
                                <li><span>Category Name: </span><?= $selectsubproductinfo['CategoryName'] ?></li>
                                <li><span>Product Name: </span><?= $selectsubproductinfo['ProductName'] ?></li>
                                <li><span>Sub-Product Name: </span><?= $selectsubproductinfo['SubProductName'] ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Description</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p><?= $selectsubproductinfo['Description'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Related Products</h3>
            </div>
        </div>
        <div class="row">
            <?php foreach ($randomproducts as $randomproduct) {
                $imagename = $randomproduct['ImageName'];
                $subproductId = $randomproduct['Id']; ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="<?= urlOf("admin/assets/uploads/subproduct-images/$imagename") ?>" style="background-image: url('<?= urlOf("admin/assets/uploads/subproduct-images/$imagename") ?>');">
                        </div>
                        <div class="product__item__text">
                            <h6><?= $randomproduct['SubProductName'] ?></h6>
                            <a href="<?= urlOf("users/product-details?id=$subproductId") ?>" class="add-cart">+ Show Details</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Related Section End -->

<?php include('../../includes/footer.php'); ?>
<?php include('../../includes/scripts.php'); ?>

<script>
    function sendData() {
        let data = {
            categoryid: $('#categoryid ').val(),
            productid: $('#productid ').val(),
            subproductid: $('#subproductid ').val(),
            name: $('#name ').val(),
            email: $('#email ').val(),
            mobile: $('#mobile ').val(),
            description: $('#description ').val(),
        }
        $.post('../../api/addEnquiry.php', data, function(response) {
            enquiryBox.close();
            alert("Enquiry Submitted !");
        })
    }
</script>