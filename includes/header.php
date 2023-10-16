<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div id="mobile-menu-wrap"></div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="<?= urlOf('') ?>"><img src="<?= urlOf('img/logo.png') ?>" alt="" style="margin-left: -20px; margin-top: -10px;" height="50%" width="60%"></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="" id="dashboardlink"><a href="<?= urlOf('') ?>">Home</a></li>
                            <li><a href="<?= urlOf('users/shop') ?>">Shop</a></li>
                            <li><a href="<?= urlOf('users/blog') ?>">Blog</a></li>
                            <li><a href="<?= urlOf('users/about') ?>">About Us</a></li>
                            <li><a href="<?= urlOf('users/contact') ?>">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->