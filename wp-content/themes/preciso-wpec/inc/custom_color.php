<style type="text/css">

    @charset "utf-8";

    <?php $color = ot_get_option('custom_clr'); ?>

    <?php if( !empty($color) ): ?>
    .sub-menu li a:hover, h1 span, h2 span, h3 span, h4 span, h5 span, h6 span, .breadcrumb li a:hover, .header .log-reg a:hover, .header .cart .cart-content .mini-cart-info li h5 a:hover, .header .cart .cart-content .mini-cart-info li p, .navbar-inner .nav li .dropdown-menu li:hover a, .navbar-inner .nav li .dropdown-menu li.active a, .date a, .small-desc a, .about-list li .thumbnail .caption h3 a, address a, .products-filter p a:hover, .products-filter p a.active, .accordion-heading .accordion-toggle, .sidebar .nav-stacked li a:hover, .sidebar .nav-stacked li.active a, .sidebar p a, .products-list-small .nav-tabs a.active span, .products-list li .thumbnail p a:hover, .products-list li .rating i, .products-list li .thumbnail .price, .blog-list li a, .media-list a, .main-rating i, .table td a, .footer p a, .footer .footer-contact li a, .footer-links ul li a:hover, .copy p a {
        color: <?php echo $color; ?> !important;
    }
    .btn.p404, .btn.p404:hover, .header .cart.on i, .header .cart .cart-content .checkout .btn, .header .cart .cart-content .checkout .btn:hover, .navbar-inner .nav > li:hover, .navbar-inner .nav li.active a, .navbar-inner .nav li.active a:hover, .navbar-inner .nav li.dropdown.active .dropdown-toggle, .about-list li .thumbnail:hover .icon-service, .map-form button, .map-form button:hover, .products-filter p a.active i, .products-filter p a i:hover, .products-filter p a.active i:hover, .pagination ul li.active a, .pagination ul li.active a:hover, .products-list li .thumbnail .folio-detail a, .products-list li .thumbnail .folio-detail a:hover, .products-list li .thumbnail input[type=button], .products-list li:hover .thumbnail input[type=button]:hover, .products-list-small li:hover .thumbnail input[type=button]:hover, .add-list-detail:hover, .add-comp-detail:hover, .products-list li .thumbnail:hover .add-list:hover, .products-list li .thumbnail:hover .add-comp:hover, .blog-list li .blog-thumb a, .blog-list li .blog-thumb a:hover, .blog-list li .btn, .blog-list li .btn:hover, .media-list .media .media-body a.reply:hover, .write-review input[type=submit], .write-review input[type=submit]:hover, .input-quantity, .btn-add-cart, .main-checkout .btn, .main-checkout .btn:hover, .navbar-inner .nav > li:hover,  .navbar-inner .nav li.dropdown.open .dropdown-toggle, .navbar-inner .nav li.dropdown.active.open .dropdown-toggle {
        background: <?php echo $color; ?> !important;
    }
    .pagination ul li.active a, .pagination ul li.active a:hover {
        border-color: <?php echo $color; ?> !important;
    }
    .products-list li .thumbnail .new {
        background: <?php echo $color; ?> !important;
    }
    .products-list li .thumbnail .sale {
        background: <?php echo $color; ?> !important;
    }
    <?php endif; ?>

    <?php echo ot_get_option('custom_css');?>

</style>