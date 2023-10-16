<?php include('../../includes/styles.php'); ?>
<?php include('../../includes/header.php'); ?>

<?php

if (isset($_GET['id'])) {
    $categoryid = $_GET['id'];
    $selectedProducts = select('SELECT Products.Id, Products.Name, ProductImages.ImageName FROM Products INNER JOIN ProductImages ON ProductImages.ProductId = Products.Id WHERE Products.CategoryId = ?', [$categoryid]);
}

$categoryNames = select('SELECT * FROM Category');
$productLists = select('SELECT Category.Name as CategoryName, Products.Name as ProductName, ProductImages.ImageName FROM Products INNER JOIN Category ON Category.Id = Products.CategoryId INNER JOIN ProductImages ON Products.Id = ProductImages.ProductId');
$randomProducts = select('SELECT Products.Id, Products.Name, ProductImages.ImageName FROM Products INNER JOIN ProductImages ON ProductImages.ProductId = Products.Id GROUP BY RAND() LIMIT 12');
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
                        <span>Shop</span>
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
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <?php foreach ($categoryNames as $categoryName) { ?>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne" data-categoryid="<?= $categoryName['Id'] ?>"><?= $categoryName['Name'] ?></a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p><a onclick="enquiryBox.showModal()" style="color: black;" target="_blank"><i class="fa fa-download"></i> Download PDF</a></p>
                                <dialog id="enquiryBox" class="col-lg-6 col-md-6" style="border-radius: 10px;">
                                    <div class="contact__form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-lg-12" style="margin-bottom: 20px; width: 100%; display: grid; place-items: center;">
                                                    <select name="" id="downloadPdf">
                                                        <option value="KDM Bath Accessories.pdf">KDM Bath Accessories</option>
                                                        <option value="KDM Building Hardware.pdf">KDM Building Hardware</option>
                                                        <option value="KDM Ciramic Bath.pdf">KDM Ciramic Bath</option>
                                                        <option value="KDM Door Handle Design.pdf">KDM Door Handle Design</option>
                                                        <option value="KDM Faucet & Tap Catalog 2023.pdf">KDM Faucet & Tap Catalog</option>
                                                        <option value="KDM Flexi Houses Bath.pdf">KDM Flexi Houses Bath</option>
                                                        <option value="KDM Plastic.pdf">KDM Plastic</option>
                                                        <option value="KDM Plumbing Pipe.pdf">KDM Plumbing Pipe</option>
                                                        <option value="KDM S.S wash basin.pdf">KDM S.S wash basin</option>
                                                        <option value="KDM Tiles 60x60 Full body.pdf">KDM Tiles 60x60 Full body</option>
                                                        <option value="KDM Tiles 60x60CM DC.pdf">KDM Tiles 60x60CM DC</option>
                                                        <option value="KDM Tiles 80x80CM DC.pdf">KDM Tiles 80x80CM DC</option>
                                                        <option value="KDM Tiles 120x240CM GVT SLAB.pdf">KDM Tiles 120x240CM GVT SLAB</option>
                                                        <option value="KDM Tiles Glossy marble 1000x1000.pdf">KDM Tiles Glossy marble 1000x1000</option>
                                                        <option value="KDM Tiles Matte 1000x1000.pdf">KDM Tiles Matte 1000x1000</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Company Name: " style="border-radius: 10px;" id="name">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="email" placeholder="Email: " style="border-radius: 10px;" id="email">
                                                </div>
                                                <div class="col-lg-12">
                                                    <input type="text" placeholder="Mobile Number: " style="border-radius: 10px;" id="mobile">
                                                </div>
                                                <div class="col-lg-12">
                                                    <textarea placeholder="Description: " style="border-radius: 10px;" id="description"></textarea>
                                                    <button type="button" class="site-btn" onclick="sendData()" style="border-radius: 10px;">Download PDF</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </dialog>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="randomProducts">
                    <?php if (!isset($_GET['id'])) {
                        foreach ($randomProducts as $randomProduct) {
                            $imagename = $randomProduct['ImageName'];
                            $productId = $randomProduct['Id']; ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="">
                                        <img src="<?= urlOf("admin/assets/uploads/product-images/$imagename") ?>" alt="">
                                    </div>
                                    <div class="product__item__text">
                                        <h6><?= $randomProduct['Name'] ?></h6>
                                        <a href="<?= urlOf("users/sub-product/?id=$productId") ?>" class="add-cart">+ Show More</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($_GET['id'])) {
                        foreach ($selectedProducts as $selectedProduct) {
                            $imagename = $selectedProduct['ImageName'];
                            $productId = $selectedProduct['Id']; ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="">
                                        <img src="<?= urlOf("admin/assets/uploads/product-images/$imagename") ?>" alt="">
                                    </div>
                                    <div class="product__item__text">
                                        <h6><?= $selectedProduct['Name'] ?></h6>
                                        <a href="<?= urlOf("users/sub-product/?id=$productId") ?>" class="add-cart">+ Show More</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php  } ?>
                </div>
                <div class="row" id="selectedProducts">

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<?php include('../../includes/footer.php'); ?>
<?php include('../../includes/scripts.php'); ?>

<script>
    $('#selectedProducts').hide();
    $(document).ready(function() {
        $(".card a").on("click", function() {
            let categoryId = $(this).data("categoryid");

            $.post('../../api/selectProducts.php', {
                categoryId: categoryId
            }, function(response) {
                let tbodyHtml = "";
                for (let i = 0; i < response.length; i++) {
                    let temp = `
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="">
                                <img src="<?= urlOf('admin/assets/uploads/product-images/') ?>${response[i]['ImageName']}" alt="">
                            </div>
                            <div class="product__item__text">
                                <h6>${response[i]['Name']}</h6>
                                <a href="<?= urlOf('users/sub-product/?id=') ?>${response[i]['Id']}" class="add-cart">+ Show More</a>
                            </div>
                        </div>
                    </div>
                `;
                    tbodyHtml += temp;
                }
                $('#randomProducts').hide();
                $('#selectedProducts').show();
                document.getElementById("selectedProducts").innerHTML = tbodyHtml;
            })
        });
    });

    function sendId(id) {
        $.post('<?= urlOf('users/sub-product/index.php') ?>', {
            id: id,
        }, function() {
            window.location = './users/sub-product';
        })
    }

    function sendData() {
        let pdfLocation = $('#downloadPdf option:selected').val();
        window.location.href = "../../pdfs/" + pdfLocation;
        let data = {
            name: $('#name').val(),
            email: $('#email').val(),
            mobile: $('#mobile').val(),
            description: $('#description').val(),
        }
        $.post('../../api/addEnquiryForPdf.php', data, function(response) {
            enquiryBox.close();
            // alert("Enquiry Submitted !");
        })
    }
</script>