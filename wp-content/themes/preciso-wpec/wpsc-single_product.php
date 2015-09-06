<?php
	global $wp_query;
	$image_width  = get_option( 'single_view_image_width' );
	$image_height = get_option( 'single_view_image_height' );
	
?>

<div id="single_product_page_container">

    <?php do_action( 'wpsc_top_of_products_page' ); ?>

	<div class="single_product_display group">

        <?php while ( wpsc_have_products() ) : wpsc_the_product(); ?>

            <div class="productcol">

                <?php do_action('wpsc_product_before_description', wpsc_the_product_id(), $wp_query->post); ?>

                <form class="product_form" enctype="multipart/form-data" action="<?php echo esc_url( wpsc_this_page_url() ); ?>" method="post" name="1" id="product_<?php echo wpsc_the_product_id(); ?>">
                    <div class="container">
                        <div class="row">

                            <div class="span3">

                                <ul class="media-gallery">
                                    <?php if ( wpsc_the_product_thumbnail() ) : ?>
                                        <li><a rel="<?php echo wpsc_the_product_title(); ?>" class="<?php echo wpsc_the_product_image_link_classes(); ?>" href="<?php echo esc_url( wpsc_the_product_image() ); ?>">
                                            <img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail(); ?>"/>
                                        </a></li>
                                        <?php pixel_wpsc_images_for_product( wpsc_the_product_id() ); ?>
                                    <?php else: ?>
                                        <li><a href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>">
                                            <img class="no-image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="No Image" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo WPSC_CORE_THEME_URL; ?>wpsc-images/noimage.png" width="<?php echo get_option('product_image_width'); ?>" height="<?php echo get_option('product_image_height'); ?>" />
                                        </a></li>
                                    <?php endif; ?>
                                </ul>

                            </div>
                            <div class="span9">

                                <div class="breadcrumb">
                                    <?php pixelart_breadcrumbs(); ?>
                                </div>

                                <?php
                                $title = wpsc_the_product_title();
                                $title_parts = explode(' ', $title, 2);
                                if( count($title_parts) > 1 ){
                                    echo '<h1>'.$title_parts[0].' <span>'.$title_parts[1].'</span></h1>';
                                }
                                else{
                                    echo '<h1>'.$title.'</h1>';
                                }
                                ?>

                                <ul class="nav nav-stacked product-info">

                                    <?php if(wpsc_show_stock_availability()): ?>
                                    <li>
                                        <strong><?php _e('Disponibilité', PIXELART); ?></strong>
                                        <?php if(wpsc_product_has_stock()) : ?>
                                            <?php _e('En Stock', PIXELART); ?>
                                        <?php else: ?>
                                            <?php _e('Epuise', PIXELART); ?>
                                        <?php endif; ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if (wpsc_have_custom_meta()) : ?>
                                        <?php while ( wpsc_have_custom_meta() ) : wpsc_the_custom_meta(); ?>
                                        <li>
                                            <?php
                                                if (stripos(wpsc_custom_meta_name(),'g:') !== FALSE) continue;
                                            if( wpsc_custom_meta_name() == 'product_label' || wpsc_custom_meta_name() == 'product_type' ){}
                                            else{
                                                ?>
                                                <strong><?php echo wpsc_custom_meta_name(); ?></strong>
                                                <?php echo wpsc_custom_meta_value(); ?>
                                                <?php
                                            }
                                            ?>
                                        </li>
                                        <?php endwhile; ?>
                                    <?php endif; ?>

                                </ul>

                                <?php if(!wpsc_product_is_donation()) : ?>

                                    <div class="main-price"><?php wpsc_the_product_price_display(); ?></div>

                                    <p class="shipping-price">
                                    <?php if(wpsc_show_pnp()) : ?>
                                        <?php _e('Livraison', PIXELART); ?> <i><?php echo wpsc_product_postage_and_packaging(); ?></i>
                                    <?php endif; ?>
                                    </p>

                                    <?php if(wpsc_product_has_multicurrency()) : ?>
                                        <?php echo wpsc_display_product_multicurrency(); ?>
                                    <?php endif; ?>

                                <?php endif; ?>

                                <?php do_action ( 'wpsc_product_form_fields_begin' ); ?>

                                <?php if (wpsc_have_variation_groups()) { ?>
                                <div class="select-option">
                                    <fieldset>
                                        <h5><?php _e('Options Disponibles', PIXELART); ?></h5>
                                        <?php while (wpsc_have_variation_groups()) : wpsc_the_variation_group(); ?>
                                            <select class="wpsc_select_variation" name="variation[<?php echo wpsc_vargrp_id(); ?>]" id="<?php echo wpsc_vargrp_form_id(); ?>">
                                                <?php while (wpsc_have_variations()) : wpsc_the_variation(); ?>
                                                    <option value="<?php echo wpsc_the_variation_id(); ?>" <?php echo wpsc_the_variation_out_of_stock(); ?>><?php echo wpsc_the_variation_name(); ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        <?php endwhile; ?>
                                    </fieldset>
                                </div>
                                <?php } ?>

                                <?php if((get_option('hide_addtocart_button') == 0) &&  (get_option('addtocart_or_buynow') !='1')) :
                                    if(wpsc_product_has_stock()) :

                                        if(wpsc_product_external_link(wpsc_the_product_id()) != '') :
                                            $action = wpsc_product_external_link( wpsc_the_product_id() ); ?>
                                            <input type="submit" value="<?php echo wpsc_product_external_link_text( wpsc_the_product_id(), __( 'ACHETEZ MAINTENANT', PIXELART ) ); ?>" class="wpsc_buy_button btn btn-add-cart" onclick="return gotoexternallink('<?php echo esc_url( $action ); ?>', '<?php echo wpsc_product_external_link_target( wpsc_the_product_id() ); ?>')">
                                        <?php else: ?>
                                            <input type="submit" value="<?php _e('Ajouter au Panier', PIXELART); ?>" name="Buy" class="wpsc_buy_button btn btn-add-cart" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
                                        <?php endif; ?>

                                        <?php if(wpsc_product_is_donation()) : ?>
                                            <fieldset>
                                                <input type="text" id="donation_price_<?php echo wpsc_the_product_id(); ?>" name="donation_price" class="input-quantity" value="<?php echo wpsc_calculate_price(wpsc_the_product_id()); ?>" size="6" />
                                                <span class="input-quantity-text"><?php _e('Dons', PIXELART); ?></span>
                                            </fieldset>
                                        <?php else : ?>
                                            <?php if(wpsc_has_multi_adding()): ?>
                                                <fieldset>
                                                    <div class="wpsc_quantity_update">
                                                        <input type="text" id="wpsc_quantity_update_<?php echo wpsc_the_product_id(); ?>" name="wpsc_quantity_update" size="2" value="1" class="input-quantity" placeholder="Qty" />
                                                        <input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
                                                        <input type="hidden" name="wpsc_update_quantity" value="true" />
                                                    </div>
                                                    <span class="input-quantity-text"><?php _e('Quantite', PIXELART); ?></span>
                                                </fieldset>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    <?php
                                    else : endif ;
                                endif ; ?>

                                <div class="clearfix"></div>

                                <div class="accordion" id="accordion2">
                                    <div class="accordion-group">
                                        <div class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"><?php _e('Description', PIXELART); ?></a></div>
                                        <div id="collapseOne" class="accordion-body collapse in">
                                            <div class="accordion-inner">
                                          <?php echo wpsc_the_product_additional_description(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ( wpsc_product_has_personal_text() ) : ?>
                                        <div class="accordion-group">
                                            <div class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree"><?php _e('Personalize this Product', PIXELART); ?></a></div>
                                            <div id="collapseThree" class="accordion-body collapse">
                                                <div class="accordion-inner">
                                                    <?php if ( wpsc_product_has_personal_text() ) : ?>
                                                        <h5><?php _e( 'Personalize Your Product', PIXELART ); ?></h5>
                                                        <p><?php _e( 'Complete this form to include a personalized message with your purchase.', PIXELART ); ?></p>
                                                        <fieldset class="write-review">
                                                            <textarea cols='55' rows='5' name="custom_text"></textarea>
                                                        </fieldset>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( wpsc_product_has_supplied_file() ) : ?>
                                        <div class="accordion-group">
                                            <div class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour"><?php _e('Upload a File', PIXELART); ?></a></div>
                                            <div id="collapseFour" class="accordion-body collapse">
                                                <div class="accordion-inner">
                                                    <?php if ( wpsc_product_has_supplied_file() ) : ?>
                                                        <h5><?php _e( 'Upload a File', PIXELART ); ?></h5>
                                                        <p><?php _e( 'Select a file from your computer to include with this purchase.', PIXELART ); ?></p>
                                                        <input type="file" name="custom_file" />
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php $terms = get_the_terms(get_the_ID(), 'product_tag' ); ?>
                                    <?php if ( $terms ) : ?>
                                        <div class="accordion-group">
                                            <div class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive"><?php _e('Tags Produits', PIXELART); ?></a></div>
                                            <div id="collapseFive" class="accordion-body collapse">
                                                <div class="accordion-inner">
                                                    <p>
                                                        <?php
                                                        $draught_links = array();
                                                        foreach ( $terms as $term ) {
                                                            $draught_links[] = $term->name;
                                                        }
                                                        $on_draught = join( ", ", $draught_links );
                                                        echo $on_draught;
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <input type="hidden" value="add_to_cart" name="wpsc_ajax_action" />
                                <input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id" />
                                <?php if( wpsc_product_is_customisable() ) : ?>
                                    <input type="hidden" value="true" name="is_customisable"/>
                                <?php endif; ?>
                                <?php do_action ( 'wpsc_product_form_fields_end' ); ?>

                            </div>

                        </div>

                    </div>
                </form>

                <form onsubmit="submitform(this);return false;" action="<?php echo esc_url( wpsc_this_page_url() ); ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_extra_<?php echo wpsc_the_product_id(); ?>">
                    <input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="prodid"/>
                    <input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="item"/>
                </form>

		    </div>

        <?php
        endwhile;
        do_action( 'wpsc_theme_footer' );
        ?>

    </div>

</div>

<?php
    $port = ot_get_option('related_port');
    if( $port == 'yes' ){
        pixel_related_products();
    }
    elseif( $port == 'no' ){}
    else{
        pixel_related_products();
    }
?>

