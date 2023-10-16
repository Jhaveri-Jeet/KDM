<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="<?= urlOf('js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= urlOf('js/bootstrap.min.js') ?>"></script>
<script src="<?= urlOf('js/jquery.nice-select.min.js') ?>"></script>
<script src="<?= urlOf('js/jquery.nicescroll.min.js') ?>"></script>
<script src="<?= urlOf('js/jquery.magnific-popup.min.js') ?>"></script>
<script src="<?= urlOf('js/jquery.countdown.min.js') ?>"></script>
<script src="<?= urlOf('js/jquery.slicknav.js') ?>"></script>
<script src="<?= urlOf('js/mixitup.min.js') ?>"></script>
<script src="<?= urlOf('js/owl.carousel.min.js') ?>"></script>
<script src="<?= urlOf('js/main.js') ?>"></script>

<script>
    $('#dashboardlink').addClass('active');
    document.addEventListener("DOMContentLoaded", function() {
        // Get the current URL
        var currentURL = window.location.href;

        // Get all the navbar links
        var navLinks = document.querySelectorAll('.mobile-menu a');

        // Loop through each navbar link
        navLinks.forEach(function(link) {
            // Get the href value of the link
            var href = link.getAttribute('href');

            // Check if the current URL contains the href value
            if (currentURL.includes(href)) {
                $('#dashboardlink').removeClass('active');
                link.parentNode.classList.add('active');
            }
        });
    });
</script>
</body>

</html>