<?php

    /*-----------------------------------------------------------------------------------*/
    /*	Featured Product
    /*-----------------------------------------------------------------------------------*/
    function featured_products( $atts, $content = null ) {
        extract(shortcode_atts( array(
            'heading' => '',
            'posts_per_page' => '',
        ), $atts ) );
        global $post;
        if( empty($posts_per_page) )
        {
            $posts_per_page = 4;
        }
        global $post;
        $sticky = get_option( 'sticky_products' );
        ob_start();
        ?>
        </div>
        <div class="products-list">
            <div class="container">
                <div class="span12">

                    <?php
                    $title_parts = explode(' ', $heading, 2);
                    echo '<h3><span>'.$title_parts[0].' </span> '.$title_parts[1].' </h3>'
                    ?>

                    <ul class="thumbnails">
                        <?php
                        $f_args = array(
                            'post_type'         => 'wpsc-product',
                            'posts_per_page'    => $posts_per_page,
                            'post_status'       => 'publish',
                            'post__in'          => $sticky
                        );
                        $featured_query = new WP_Query( $f_args );
                        if ( $featured_query->have_posts() ):
                            while ( $featured_query->have_posts() ) :
                                $featured_query->the_post();
                                ?>

                                <li class="span3">
                                    <div class="thumbnail">

                                        <?php if(wpsc_the_product_thumbnail()) : ?>
                                            <a href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>" class="thumb"><img src="<?php echo wpsc_the_product_thumbnail(); ?>" alt="Product" /></a>
                                        <?php endif; ?>

                                        <p><a href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>"><?php echo wpsc_the_product_title();?></a></p>

                                        <?php wpsc_the_product_price_display( false, false, false ); ?>

                                        <form class="product_form"  enctype="multipart/form-data" action="<?php echo esc_url( $action ); ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_<?php echo wpsc_the_product_id(); ?>" >
                                            <?php do_action ( 'wpsc_product_form_fields_begin' ); ?>
                                            <input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
                                            <input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>
                                            <?php if((get_option('hide_addtocart_button') == 0) &&  (get_option('addtocart_or_buynow') !='1')) : ?>
                                                <?php if(wpsc_product_has_stock()) : ?>
                                                    <div class="wpsc_buy_button_container">
                                                        <?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
                                                            <?php $action = wpsc_product_external_link( wpsc_the_product_id() ); ?>
                                                            <input class="wpsc_buy_button" type="submit" value="<?php echo wpsc_product_external_link_text( wpsc_the_product_id(), __( 'Buy Now', 'wpsc' ) ); ?>" onclick="return gotoexternallink('<?php echo esc_url( $action ); ?>', '<?php echo wpsc_product_external_link_target( wpsc_the_product_id() ); ?>')">
                                                        <?php else: ?>
                                                            <input type="submit" value="<?php _e('Ajout Panier', 'wpsc'); ?>" name="Buy" class="wpsc_buy_button btn" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif ; ?>
                                            <?php endif ; ?>
                                        </form>

                                        <?php
                                        $product = get_post_meta($post->ID, 'product_label', true);
                                        if( $product == 'new' ) {
                                            ?>
                                            <span class="new"><?php _e('NOUVEAU', PIXELART); ?></span>
                                        <?php
                                        } elseif( $product == 'sell' )  {
                                            ?>
                                            <span class="sale"><?php _e('SOLDE', PIXELART); ?></span>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </li>

                            <?php
                            endwhile;
                        endif;
                        ?>
                    </ul>

                    <hr />
                </div>
            </div>
        </div>
        <div class="container">
        <?php
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }
    add_shortcode('featured_products', 'featured_products');


    /*-----------------------------------------------------------------------------------*/
    /*	Services
    /*-----------------------------------------------------------------------------------*/

    function services( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'heading' => '',
            'posts_per_page' => '',
        ), $atts));

        if( empty($posts_per_page) )
        {
            $posts_per_page = 4;
        }

        ob_start();
        ?>

        <div class="row">
            <div class="span12">
                <?php
                $title = $heading;
                $title_parts = explode(' ', $title, 2);
                echo '<h2 class="text-center margin-top margin-bottom">'.$title_parts[0].' <span>'.$title_parts[1].'</span></h2>'
                ?>

                <ul class="thumbnails about-list">
                    <?php
                    $services_args = array( 'post_type' => 'services', 'posts_per_page' => $posts_per_page );

                    $services_query = new WP_Query( $services_args );

                    if ( $services_query->have_posts() ):
                        while ( $services_query->have_posts() ) :
                            $services_query->the_post();
                            $icon = get_post_meta(get_the_id(), 'services_icon', true);
                            $subtitle = get_post_meta(get_the_id(), 'subtitle', true);
                            ?>
                            <li class="span3">
                                <div class="thumbnail">
                                    <?php
                                    if( has_post_thumbnail() ) {
                                        the_post_thumbnail('services');
                                    }else{
                                    ?>
                                        <i class="icon-<?php echo $icon; ?>  icon-service"></i>
                                        <?php
                                    }
                                        ?>


                                    <div class="caption">
                                        <h3><a href="#"><?php the_title(); ?></a></h3>
                                        <em><?php echo $subtitle; ?></em>
                                        <div class="clearfix"></div>
                                        <?php echo the_excerpt(); ?>
                                    </div>
                                </div>
                            </li>

                        <?php
                        endwhile;
                    endif;
                    ?>
                </ul>

                <hr />
            </div>

        </div>

        <?php
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }
    add_shortcode('services', 'services');



    /*-----------------------------------------------------------------------------------*/
    /*	Latest Work
    /*-----------------------------------------------------------------------------------*/
    function latest_work( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'heading' => '',
            'posts_per_page' => ''
        ), $atts));
        if(empty($posts_per_page))
        {
            $posts_per_page = 4;
        }
        ob_start();
        ?>
        <div class="row">
            <div class="span12">
                <div class="products-list products-list-simple">
                    <?php
                    $title_parts = explode(' ', $heading, 2);
                    echo '<h2 class="text-center margin-top margin-bottom">'.$title_parts[0].' <span>'.$title_parts[1].'</span></h2>'
                    ?>
                    <ul class="thumbnails">
                        <?php
                        $args = array(
                            'post_type' => 'portfolio',
                            'posts_per_page' => $posts_per_page
                        );
                        $post = new WP_Query( $args );
                        while ( $post->have_posts() ) : $post->the_post();
                            $thumb_id = get_post_thumbnail_id();
                            $thumb_url = wp_get_attachment_image_src( $thumb_id, 'full' );
                            ?>
                            <li class="span3">
                                <div class="thumbnail">
                                    <?php
                                        if( has_post_thumbnail() )
                                        {
                                            the_post_thumbnail('port_one');
                                            ?>
                                            <div class="folio-detail">
                                                <a href="<?php $port = ot_get_option('port'); if( $port == 'single_simple' ) { the_permalink(); } elseif( $port == 'light_box' )  {  echo $thumb_url[0];}else{the_permalink();}  ?>" class="<?php $port = ot_get_option('port'); if( $port == 'single_simple' ) { echo 'single_page_post'; } elseif( $port == 'light_box' )  {  echo 'view-fancybox';}else{echo 'single_page_post';}  ?>" rel="tag"><i class="icon-camera"></i></a>
                                            </div>
                                        <?php
                                        }
                                    ?>
                                </div>
                            </li>
                        <?php
                        endwhile;
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }
    add_shortcode('latest_work', 'latest_work');



    /*-----------------------------------------------------------------------------------*/
    /*	Clients
    /*-----------------------------------------------------------------------------------*/
    function clients( $atts, $content = null ) {
        extract(shortcode_atts(array(
        ), $atts));
        ob_start();
        ?>
        <div class="brands">
            <ul class="thumbnails" style="margin-left: 0;">
                <?php
                $clients = ot_get_option('our_client_section');
                if($clients)
                {
                    foreach($clients as $client)
                    {
                        echo '<li class="span2">
                                    <a href="'.$client['client_url'].'"><img src="'.$client['client_logo'].'" alt="" class="thumbnail" /></a>
                              </li>';
                    }
                }
                ?>
            </ul>
        </div>
        <?php
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }
    add_shortcode('clients', 'clients');



    /*-----------------------------------------------------------------------------------*/
    /*	Team Members
    /*-----------------------------------------------------------------------------------*/
    function team( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'heading' => '',
            'posts_per_page' => ''
        ), $atts));
        if(empty($posts_per_page))
        {
            $posts_per_page = 4;
        }
        ob_start();
        ?>
        <div class="row">
            <div class="span12">
                <ul class="thumbnails about-list">
                    <?php
                    $args = array(
                        'post_type' => 'team',
                        'posts_per_page' => $posts_per_page
                    );
                    $team = new WP_Query( $args );
                    while ( $team->have_posts() ) : $team->the_post();
                        $post_id = get_the_ID();
                        ?>
                        <li class="span3">
                            <div class="thumbnail">
                                <?php
                                if( has_post_thumbnail() ) {
                                    the_post_thumbnail();
                                }?>
                                <div class="caption">
                                    <h3><a href="<?php echo get_post_meta($post_id, 'link', true); ?>"><?php the_title(); ?></a></h3>
                                    <em><?php echo get_post_meta($post_id, 'designation', true); ?></em>
                                    <div class="footer-social">
                                        <?php
                                        $social_icons = array(
                                            'facebook'   => array( 'name'=>'facebook',    'link'=>get_post_meta($post_id, 'fb', true) ),
                                            'twitter'    => array( 'name'=>'twitter',     'link'=>get_post_meta($post_id, 'tw', true) ),
                                            'gplus'      => array( 'name'=>'google-plus', 'link'=>get_post_meta($post_id, 'gp', true) ),
                                            'pinterest'  => array( 'name'=>'pinterest',   'link'=>get_post_meta($post_id, 'pin', true) )
                                        );
                                        foreach( $social_icons as $social_icon => $social_meta ){
                                            $link  = $social_meta['link'];
                                            $class = $social_meta['name'];
                                            if(!empty($link)){
                                                echo '<a href="'.$link.'" class="icon-'.$class.'"><img src="'.get_template_directory_uri().'/img/'.$class.'-icon.png" alt="'.$class.'" /></a>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php echo the_excerpt(); ?>
                                </div>
                                <?php
                                    $skills = get_post_meta($post_id, 'skills', true);
                                    if($skills){
                                        foreach( $skills as $skill  ){
                                            if(!empty($skill)){
                                                echo '<div class="progress">
                                                        <div class="bar" style="width: '.$skill['skill_value'].'%">'.$skill['title'].'</div>
                                                    </div>';
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </li>
                    <?php
                    endwhile;
                    ?>
                </ul>
            </div>
        </div>
        <?php
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }
    add_shortcode('team', 'team');