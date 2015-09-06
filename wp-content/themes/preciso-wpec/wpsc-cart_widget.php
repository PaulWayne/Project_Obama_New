    <?php if(isset($cart_messages) && count($cart_messages) > 0) { ?>
        <?php foreach((array)$cart_messages as $cart_message) { ?>
          <span class="cart_message"><?php echo esc_html( $cart_message ); ?></span>
        <?php } ?>
    <?php } ?>

    <?php if(wpsc_cart_item_count() > 0): ?>
        <i class="icon-shopping-cart on"></i>
    <?php else: ?>
        <i class="icon-shopping-cart"></i>
    <?php endif; ?>

    <p><?php echo wpsc_cart_total_widget( false, false ,false ); ?> <span>( <?php printf( _n('%d', '%d', wpsc_cart_item_count(), 'wpsc'), wpsc_cart_item_count() ); ?> )</span></p>

    <div class="cart-content">

        <?php if(wpsc_cart_item_count() > 0): ?>

            <div class="shoppingcart">
                <div class="mini-cart-info">
                    <h4><?php _e('Panier', PIXELART); ?></h4>
                    <ul>
                        <?php while(wpsc_have_cart_items()): wpsc_the_cart_item(); ?>
                            <li class="clearfix">
                                <a href="#"><img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_cart_item_name(); ?>" title="<?php echo wpsc_cart_item_name(); ?>" src="<?php echo wpsc_cart_item_image(); ?>"/></a>
                                <div class="mini-cart-detail">
                                    <h5><?php do_action ( "wpsc_before_cart_widget_item_name" ); ?><a href="<?php echo esc_url( wpsc_cart_item_url() ); ?>"><?php echo wpsc_cart_item_name(); ?></a><?php do_action ( "wpsc_after_cart_widget_item_name" ); ?></h5>
                                    <em><?php echo wpsc_cart_item_quantity(); ?> <?php _e('article', PIXELART); ?></em>
                                    <p><?php echo wpsc_cart_item_price(); ?></p>
                                </div>
                                <form action="" method="post" class="adjustform">
                                    <input type="hidden" name="quantity" value="0" />
                                    <input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
                                    <input type="hidden" name="wpsc_update_quantity" value="true" />
                                    <input class="remove_button" type="submit" />
                                </form>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <div class="mini-cart-total">
                    <ul>
                        <li><?php _e('Sous-total:', PIXELART); ?> <span><?php echo wpsc_cart_total_widget( false, false ,false ); ?></span></li>
                    </ul>
                    <p class="total"><?php _e('Total:', PIXELART); ?><?php echo wpsc_cart_total_widget( false, false ,false ); ?></p>
                </div>
                <div class="checkout">
                    <form action='<?php echo home_url(); ?>' method='post' class='wpsc_empty_the_cart'>
                        <input type='hidden' name='wpsc_ajax_action' value='empty_cart' />
                        <a target='_parent' href='<?php echo esc_url( add_query_arg( 'wpsc_ajax_action', 'empty_cart', remove_query_arg( 'ajax' ) ) ); ?>' class="emptycart btn"><?php echo __('Vider le Panier', 'wpsc'); ?></a>
                    </form>
                    <a target="_parent" href="<?php echo esc_url( get_option( 'shopping_cart_url' ) ); ?>" title="<?php esc_html_e('Passer Commande', PIXELART); ?>" class="gocheckout btn btn-checkout"><?php esc_html_e('Passer Commande', PIXELART); ?></a>
                </div>
            </div>

        <?php else: ?>

            <div class="mini-cart-info">
                <h4><?php _e('Panier', PIXELART); ?></h4>
                <p class="empty">
                    <?php _e('Vide! pas de produits dans le panier.', PIXELART); ?>
                </p>
            </div>

        <?php endif; ?>

    </div>

    <?php wpsc_google_checkout();?>