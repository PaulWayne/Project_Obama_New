<?php

/*
 * Template Name: Product 3 Column
 */

get_header();

?>

    <div class="container">
        <div class="row">
            <div class="span12">

                <div class="breadcrumb">
                    <?php pixelart_breadcrumbs(); ?>
                </div>

                <?php
                $title = get_the_title();
                $title_parts = explode(' ', $title, 2);
                if( count($title_parts) > 1 ){
                    echo '<h1>'.$title_parts[0].' <span>'.$title_parts[1].'</span></h1>';
                }
                else{
                    echo '<h1>'.$title.'</h1>';
                }
                ?>

                <p class="small-desc"><?php echo get_post_meta(get_the_id(), 'page_desc', true);?></p>

            </div>
        </div>
        <div class="row">
            <div class="span12">

                <div class="row products-filter">
                    <p><a href="<?php echo ot_get_option('product_four');?>"><i class="icon-th"></i></a> <a href="<?php echo ot_get_option('product_three');?>" class="active"><i class="icon-th-large"></i></a></p>
                 </div>

                <div class="products-list products-list-simple">
                    <ul class="thumbnails">
                        <?php
                        $posts_per_page = ot_get_option('product_page');
                        $args = array(  'post_type'  => 'wpsc-product', 'posts_per_page'  => $posts_per_page, 'post_status'     => 'publish');
                        $query = new WP_Query( $args );
                        if ( $query->have_posts() ):  while ( $query->have_posts() ) : $query->the_post(); ?>
                        <li class="span4">
                            <div class="thumbnail">

                                <?php if(wpsc_the_product_thumbnail()) : ?>
                                    <a href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>" class="thumb"><img src="<?php echo wpsc_the_product_thumbnail(); ?>" alt="Product" /></a>
                                <?php endif; ?>

                                <p><a href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>"><?php echo wpsc_the_product_title();?></a></p>

                                <?php wpsc_the_product_price_display( array( 'price_text'=>'%s', 'output_old_price' => false, 'output_you_save'  => false, ) ); ?>

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
                        <?php  endwhile;  endif;  ?>

                    </ul>

                    <?php pixelart_pagination( $query->max_num_pages); ?>

                </div>

            </div>
        </div>
    </div>

<?php get_footer(); ?>