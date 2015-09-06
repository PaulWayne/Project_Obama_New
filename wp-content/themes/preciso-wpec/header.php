<!doctype html>
<!--[if IE 9]><html class="ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 10]><html class="ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 11]><html class="ie11" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 11)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
    <head>

        <meta charset="<?php bloginfo( 'charset' ); ?>">

        <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;">

        <?php if( ot_get_option('favicon') ): ?>
                <link rel="icon" type="image/png" href="<?php echo ot_get_option('favicon'); ?>">
        <?php else: ?>
                <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
        <?php endif; ?>

        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

        <?php wp_head(); ?>

    </head>
    <body <?php body_class(); ?>>

        <div class="header">
            <div class="container">
                <div class="row">
                    <?php if( function_exists( 'wpsc_cart_item_count' ) ): ?>

                        <ul class="nav nav-pills span6">
                            <li><a href="<?php echo get_option('user_account_url'); ?>"><?php _e('Mon Compte', PIXELART); ?></a></li>
                            <li><a href="<?php echo get_option('shopping_cart_url'); ?>"><?php _e('Panier', PIXELART); ?></a></li>
                            <li><a href="<?php echo get_option('checkout_url'); ?>"><?php _e('Passer Commande', PIXELART); ?></a></li>
                        </ul>

                        <div class="cart">
                            <?php echo wpsc_shopping_cart(); ?>
                        </div>

                    <?php endif; ?>

                    <?php pixel_language_selector(); ?>

                    <?php if( is_user_logged_in() ) { ?>
                        <p class="log-reg">
                            <span><?php _e('Vous etes connecte', PIXELART); ?> <strong><?php global $current_user; get_currentuserinfo(); echo $current_user->user_login; ?></strong></span>
                            <a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="login-button"><?php _e('Se deconnecter', PIXELART); ?></a>
                        </p>
                    <?php }else{ ?>
                        <p class="log-reg">
                            <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('Se connecter', PIXELART); ?></a>
                            <a href="<?php echo wp_registration_url(); ?> "><?php _e('S\'inscrire', PIXELART); ?></a>
                        </p>
                    <?php } ?>

                    <div class="clearfix"></div>

                </div>
            </div>
        </div>

        <div id="logo">
            <?php
            $logo = ot_get_option('logo');
            if($logo)
            {
                ?>
                <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" /></a>
            <?php
            }else{
                ?>
                <h2><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h2>
            <?php
            }
            ?>
        </div>

        <hr class="bordered" />
        <div class="navbar-cont">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="navbar">
                            <div class="navbar-inner">
                                <div class="container"><a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse"><i class="icon-align-justify"></i></a>
                                    <div class="nav-collapse collapse navbar-responsive-collapse">

                                        <?php
                                        if ( has_nav_menu( 'main-menu' ) ) {
                                            $args = array(
                                                'theme_location'  => 'main-menu',
                                                'container'       => '',
                                                'menu_class' => 'nav',
                                            );
                                            wp_nav_menu( $args );
                                        }
                                        ?>

                                        <form method="get" id="searchform" action="<?php echo home_url(); ?>" class="header-search">
                                            <fieldset>
                                                <input type="text" class="field search" name="s" id="s" placeholder="<?php _e('RECHERCHE', PIXELART); ?>" onfocus="if (this.value == '<?php _e('RECHERCHE', PIXELART); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('RECHERCHE', PIXELART); ?>';}" />
                                                <button><i class="icon-search"><input type="submit" class="submit" name="submit" value="" /></i></button>
                                            </fieldset>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="bordered" />