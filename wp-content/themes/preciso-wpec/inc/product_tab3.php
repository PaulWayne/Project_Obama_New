<ul class="thumbnails">
    <?php
    $cthree_id = ot_get_option('product_tab3_cat');
    if( $cthree_id )
    {
        $c_args = array(
            'post_type'  => 'wpsc-product',
            'posts_per_page'  => -1,
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'wpsc_product_category',
                    'field' => 'id',
                    'terms' => $cthree_id
                )
            )
        );
    }
    else
    {
        $c_args = array(  'post_type'  => 'wpsc-product', 'posts_per_page'  => -1, 'post_status' => 'publish' );
    }
    $tab3_query = new WP_Query( $c_args );
    if ( $tab3_query->have_posts() ):
        while ( $tab3_query->have_posts() ) :
            $tab3_query->the_post();
            ?>
            <li class="span2">
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
                                        <input type="submit" value="<?php _e('Add To Cart', 'wpsc'); ?>" name="Buy" class="wpsc_buy_button btn" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
                                    <?php endif; ?>
                                    <div class="wpsc_loading_animation text-center">
                                        <img title="Loading" alt="Loading" src="<?php echo wpsc_loading_animation_url(); ?>" />
                                        <?php _e('Updating cart...', 'wpsc'); ?>
                                    </div>
                                </div>
                            <?php endif ; ?>
                        <?php endif ; ?>
                    </form>

                    <?php
                    $product = get_post_meta($post->ID, 'product_label', true);
                    if( $product == 'new' ) {
                        ?>
                        <span class="new"><?php _e('NEW', PIXELART); ?></span>
                    <?php
                    } elseif( $product == 'sell' )  {
                        ?>
                        <span class="sale"><?php _e('SALE', PIXELART); ?></span>
                    <?php
                    }
                    ?>

                </div>
            </li>
        <?php
        endwhile;wp_reset_query();
    endif;
    ?>
</ul>