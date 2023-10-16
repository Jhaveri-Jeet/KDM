<?php include('../../includes/styles.php'); ?>
<?php include('../../includes/header.php'); ?>

<?php
$totalCategory = selectOne('SELECT COUNT(Id) as TotalCategory FROM Category');
$totalClient = selectOne('SELECT COUNT(Id) as TotalClients FROM EnquiryCart');
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>About Us</h4>
                    <div class="breadcrumb__links">
                        <a href="<?= urlOf('') ?>">Home</a>
                        <span>About Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- About Section Begin -->
<section class="about spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about__pic">
                    <img src="<?= urlOf('img/about/about-us.jpg') ?>" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>Who We Are ?</h4>
                    <p>KDM PVT. LTD. is a family run, manufacturer of turned brass component based in Jamnagar, also known as the ‘Brass City’.
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>What We Do ?</h4>
                    <p>
                        We have been established since 2000 and have experience of manufacturing for over 35 years. We manufacture an extensive range of turned brass components specific to your company requirements.</p>
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>Why Choose Us</h4>
                    <p>We have good quality and management system. We have enough technical and management staff, enough machinery and measuring devices. Our staffs have good technical and management experience in their respective fields.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->

<!-- Counter Section Begin -->
<section class="counter spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">
                        <h2 class="cn_num"><?= $totalClient['TotalClients'] ?></h2>
                    </div>
                    <span>Our <br />Clients</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">
                        <h2 class="cn_num"><?= $totalCategory['TotalCategory'] ?></h2>
                    </div>
                    <span>Total <br />Categories</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">
                        <h2 class="cn_num">5</h2>
                    </div>
                    <span>In <br />Country</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">
                        <h2 class="cn_num">98</h2>
                        <strong>%</strong>
                    </div>
                    <span>Happy <br />Customer</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Counter Section End -->

<!-- Team Section Begin -->
<section class="team spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Team</span>
                    <h2>Meet Our Team</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <img src="<?= urlOf('img/about/karan.jpg') ?>" alt="">
                    <h4>Karan Pipariya</h4>
                    <span>C.E.O</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <img src="<?= urlOf('img/about/Manojpatel-2.jpg') ?>" alt="">
                    <h4>Manoj Kathiria</h4>
                    <span>M.D</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Team Section End -->

<!-- Client Section Begin -->
<section class="clients spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Partner</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                <a href="https://www.omrudrafittings.com/" target="_blank" class="client__item"><img src="<?= urlOf('img/clients/om logo.png') ?>" alt=""></a>
            </div>
        </div>
    </div>
</section>
<!-- Client Section End -->

<!-- Certificates Section Begin -->
<section class="team spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Quality Certificates</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <a href="<?= urlOf('certificates/CERTIFICATE_ORMPL_ISO_9001-2015.pdf') ?>" target="_blank">
                        <img src="<?= urlOf('img/certificate-image/dnb-logo.jpg') ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <a href="<?= urlOf('certificates/DB.jpg') ?>" target="_blank">
                        <img src="<?= urlOf('img/certificate-image/dnb-logo.png') ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <a href="<?= urlOf('certificates/CERTIFICATE_ORMPL_BSI.pdf') ?>" target="_blank">
                        <img src="<?= urlOf('img/certificate-image/BSI-LOGO.jpg') ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <a href="<?= urlOf('certificates/Rohs-Om-Rudra.pdf') ?>" target="_blank">
                        <img src="<?= urlOf('img/certificate-image/rohs-logo.jpg') ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <a href="<?= urlOf('certificates/EN331-CE-OM-RUDRA.pdf') ?>" target="_blank">
                        <img src="<?= urlOf('img/certificate-image/ce-logo.jpg') ?>" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Certificates Section End -->

<?php include('../../includes/footer.php'); ?>
<?php include('../../includes/scripts.php'); ?>