<?php
$shortcode_page_ids = get_option('wpsc_shortcode_page_ids');
global $wpsc_cart, $wpdb, $wpsc_checkout, $wpsc_gateway, $wpsc_coupons, $wpsc_registration_error_messages;
$wpsc_checkout = new wpsc_checkout();
$alt = 0;
$coupon_num = wpsc_get_customer_meta( 'coupon' );
if( $coupon_num )
    $wpsc_coupons = new wpsc_coupons( $coupon_num );

if(wpsc_cart_item_count() < 1) :
    ?>
    <p class="margin-bottom main-checkout text-center"><?php _e('Oops, votre panier est vide.', PIXELART); ?> <br><br> <a class='btn btn-checkout' style="float: none;" href="<?php echo esc_url( get_option( "product_list_url" ) ); ?>"><?php _e('Visiter la boutique', PIXELART); ?></a></p>
    <?php
    return;
endif;
?>


<div id="checkout_page_container">

    <h4 class="margin-bottom"><?php _e('Recapitulatif de votre commande', PIXELART); ?></h4>

    <?php if(isset($_SESSION['WpscGatewayErrorMessage']) && $_SESSION['WpscGatewayErrorMessage'] != '') :?>
        <h5><?php echo $_SESSION['WpscGatewayErrorMessage']; ?></h5>
    <?php endif; ?>

    <?php do_action('wpsc_before_form_of_shopping_cart'); ?>

    <?php if( ! empty( $wpsc_registration_error_messages ) ): ?>
        <p class="validation-error">
            <?php foreach( $wpsc_registration_error_messages as $user_error ) echo $user_error."<br />\n";?>
        </p>
    <?php endif; ?>

    <?php
    $misc_error_messages = wpsc_get_customer_meta( 'checkout_misc_error_messages' );
    if( ! empty( $misc_error_messages ) ): ?>
        <div class='login_error'>
            <?php foreach( $misc_error_messages as $user_error ){?>
                <p class='validation-error'><?php echo $user_error; ?></p>
            <?php } ?>
        </div>
    <?php
    endif;  ?>

    <table class="table table-hover">

        <tr class="first">
            <th>&nbsp;</th>
            <th class="p-name" ><?php _e('Produit', PIXELART); ?></th>
            <th class="p-qty"><?php _e('Quantite', PIXELART); ?></th>
            <th><?php _e('Prix Unitaire', PIXELART); ?></th>
            <th><cite><?php _e('Total', PIXELART); ?></cite></th>
        </tr>

        <?php do_action ( "wpsc_before_checkout_cart_row" ); ?>

        <?php while (wpsc_have_cart_items()) : wpsc_the_cart_item(); ?>

            <?php
            $alt++;
            if ($alt %2 == 1)
                $alt_class = 'alt';
            else
                $alt_class = '';
            ?>

            <tr class="product_row product_row_<?php echo wpsc_the_cart_item_key(); ?> <?php echo $alt_class;?>">

                <td class="thumb-cart firstcol wpsc_product_image wpsc_product_image_<?php echo wpsc_the_cart_item_key(); ?>">
                    <?php if('' != wpsc_cart_item_image()): ?>
                        <?php do_action ( "wpsc_before_checkout_cart_item_image" ); ?>
                        <img src="<?php echo wpsc_cart_item_image(); ?>" alt="<?php echo wpsc_cart_item_name(); ?>" title="<?php echo wpsc_cart_item_name(); ?>" class="product_image" />
                        <?php do_action ( "wpsc_after_checkout_cart_item_image" ); ?>
                    <?php else: ?>
                        <div class="item_no_image">
                            <?php do_action ( "wpsc_before_checkout_cart_item_image" ); ?>
                            <a href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>">
                                <span><?php _e('No Image',PIXELART); ?></span>
                            </a>
                            <?php do_action ( "wpsc_after_checkout_cart_item_image" ); ?>
                        </div>
                    <?php endif; ?>
                </td>

                <td class="p-name wpsc_product_name wpsc_product_name_<?php echo wpsc_the_cart_item_key(); ?>">
                    <?php do_action ( "wpsc_before_checkout_cart_item_name" ); ?>
                    <h5><a href="<?php echo esc_url( wpsc_cart_item_url() );?>"><?php echo wpsc_cart_item_name(); ?></a></h5>
                    <?php do_action ( "wpsc_after_checkout_cart_item_name" ); ?>
                </td>

                <td class="wpsc_product_quantity wpsc_product_quantity_<?php echo wpsc_the_cart_item_key(); ?>">
                    <form action="<?php echo esc_url( get_option( 'shopping_cart_url' ) ); ?>" method="post" class="adjustform qty">
                        <input type="text" name="quantity" size="2" value="<?php echo wpsc_cart_item_quantity(); ?>" class="input-small input-quantity" style="float: none;" />
                        <input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
                        <input type="hidden" name="wpsc_update_quantity" value="true" />
                        <input class="btn btn-general" type="submit" value="<?php _e('Modifier', PIXELART); ?>" />
                    </form>
                </td>

                <td><?php echo wpsc_cart_single_item_price(); ?></td>

                <td class="wpsc_product_price wpsc_product_price_<?php echo wpsc_the_cart_item_key(); ?>">
                    <span class="pricedisplay"><?php echo wpsc_cart_item_price(); ?></span>
                    <form action="<?php echo esc_url( get_option( 'shopping_cart_url' ) ); ?>" method="post" class="adjustform remove">
                        <input type="hidden" name="quantity" value="0" />
                        <input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
                        <input type="hidden" name="wpsc_update_quantity" value="true" />
                        <input type="submit" value="<?php _e('-', PIXELART); ?>" class="remove" />
                    </form>
                </td>

            </tr>

            <?php do_action ( "wpsc_after_checkout_cart_row" ); ?>

        <?php endwhile; ?>

    </table>

    <?php if(wpsc_uses_coupons()): ?>
        <div class="text-right">
            <h5 style="margin-bottom: 15px;"><?php _e('Utiliser un coupon', PIXELART); ?></h5>
            <form  method="post" class="text-right" action="<?php echo esc_url( get_option( 'shopping_cart_url' ) ); ?>">
                <span class="input-small"><?php _e('Saisir le numero du coupon:', PIXELART); ?></span>
                <input type="text" name="coupon_num" id="coupon_num" value="<?php echo $wpsc_cart->coupons_name; ?>" />
                <input type="submit" class="btn btn-general" value="<?php _e('Update', PIXELART) ?>" />
            </form>
            <?php if(wpsc_coupons_error()): ?>
                <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><?php _e('Desole!', PIXELART); ?></strong> <?php _e('Le coupon est invalide ou expire.', PIXELART); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="main-cart-total">
        <ul>
            <li><?php _e('Sous-Total:', PIXELART); ?> <span><?php echo wpsc_cart_total_widget(false,false,false);?></span></li>
           <?php if($wpsc_cart->coupons_amount>0){?> <li><?php _e('Coupon:', PIXELART); ?> <span> <?php echo wpsc_coupon_amount(); ?></span></li><?php }else echo '';?>
            <li><?php _e('Frais de livraison:', PIXELART); ?> <span><?php echo wpsc_cart_shipping(); ?></span></li>
            <?php
            $wpec_taxes_controller = new wpec_taxes_controller();
            if($wpec_taxes_controller->wpec_taxes_isenabled()):
                ?>
                <li><?php echo wpsc_display_tax_label(true); ?>: <?php echo wpsc_cart_tax(); ?></li>
            <?php endif; ?>
        </ul>
        <p class="total"><?php _e('Total:', PIXELART); ?> <span><?php echo wpsc_cart_total(); ?></span>
    </div>

    <div class='clear margin-bottom'></div>

</div>

<?php if ( wpsc_show_user_login_form() && !is_user_logged_in() ): ?>
    <div class="wpsc_registration_form">
        <fieldset class='wpsc_registration_form'>
            <h4 style="margin-bottom: 30px;"><?php _e('Client', PIXELART);?></h4>
            <?php
            $args = array(
                'remember' => false,
                // 'redirect' => home_url( $_SERVER['REQUEST_URI'] )
            );
            wp_login_form( $args );
            ?>
            <div class="wpsc_signup_text"><?php _e('Si inscrit, identifiez-vous ici.', PIXELART);?></div>
        </fieldset>
    </div>
<?php endif; ?>

<form class='wpsc_checkout_forms' action='<?php echo esc_url( get_option( 'shopping_cart_url' ) ); ?>' method='post' enctype="multipart/form-data">

    <?php if(wpsc_show_user_login_form()):
        global $current_user;
        get_currentuserinfo();   ?>
        <div class="wpsc_registration_form">
            <fieldset class='wpsc_registration_form wpsc_right_registration'>
                <h4 style="margin-bottom: 30px;"><?php _e('Nouveau Client', PIXELART);?></h4>
                <label><?php _e('Nom d\'utilisateur:', PIXELART); ?></label>
                <input type="text" name="log" id="log" value="" size="20"/><br/>
                <label><?php _e('Mot de passe:', PIXELART); ?></label>
                <input type="password" name="pwd" id="pwd" value="" size="20" /><br />
                <label><?php _e('E-mail', PIXELART); ?>:</label>
                <input type="text" name="user_email" id="user_email" value="" size="20" /><br />
                <div class="wpsc_signup_text"><?php _e('La connexion est facile et automatique! Remplir ce formulaire pour completer votre inscription
                 N\'oubliez pas votre login et mot de passe pour vous connecter la prochaine fois!', PIXELART);?></div>
            </fieldset>
        </div>
        <div class="clear margin-bottom"></div>
    <?php endif; ?>

    <?php
    $misc_error_messages = wpsc_get_customer_meta( 'checkout_misc_error_messages' );
    if( ! empty( $misc_error_messages ) ): ?>
        <div class='login_error'>
            <?php foreach( $misc_error_messages as $user_error ){?>
                <div class="alert alert-error" style="max-width: 60%;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo $user_error; ?>
                </div>
            <?php } ?>
        </div>
    <?php
    endif;
    ?>

    <?php ob_start(); ?>

    <table class='wpsc_checkout_table table-1 margin-bottom'>

    <?php
    $i = 0;
    while (wpsc_have_checkout_items()) : wpsc_the_checkout_item();
        if(wpsc_checkout_form_is_header() == true){
            $i++;
    ?>

            <?php if($i > 1):?>
                </table>
                <table class='wpsc_checkout_table table-<?php echo $i; ?>'>
            <?php endif; ?>

            <tr <?php echo wpsc_the_checkout_item_error_class();?>>
                <td <?php wpsc_the_checkout_details_class(); ?> colspan='2'>
                    <h4><?php echo wpsc_checkout_form_name();?></h4>
                </td>
            </tr>

            <?php if(wpsc_is_shipping_details()):?>
                <tr class='same_as_shipping_row'>
                    <td colspan ='2'>
                        <?php $checked = '';
                        $shipping_same_as_billing = wpsc_get_customer_meta( 'shipping_same_as_billing' );
                        if(isset($_POST['shippingSameBilling']) && $_POST['shippingSameBilling'])
                            $shipping_same_as_billing = true;
                        elseif(isset($_POST['submit']) && !isset($_POST['shippingSameBilling']))
                            $shipping_same_as_billing = false;
                        wpsc_update_customer_meta( 'shipping_same_as_billing', $shipping_same_as_billing );
                        if( $shipping_same_as_billing )
                            $checked = 'checked="checked"';
                        ?>
                        <label for='shippingSameBilling'><?php _e('Identique a l\'adresse de facturation:',PIXELART); ?></label>
                        <input type='checkbox' value='true' name='shippingSameBilling' id='shippingSameBilling' <?php echo $checked; ?> />
                        <br/><span id="shippingsameasbillingmessage"><?php _e('Votre Commande va etre livree a l\'adresse de facturation', PIXELART); ?></span>
                    </td>
                </tr>
            <?php endif; ?>

        <?php
        }elseif(wpsc_disregard_shipping_state_fields()){
        ?>

            <tr class='wpsc_hidden'>
                <td class='<?php echo wpsc_checkout_form_element_id(); ?>'>
                    <label for='<?php echo wpsc_checkout_form_element_id(); ?>'>
                        <?php echo wpsc_checkout_form_name();?>
                    </label>
                </td>
                <td>
                    <?php echo wpsc_checkout_form_field();?>
                    <?php if(wpsc_the_checkout_item_error() != ''): ?>
                        <div class="alert alert-error" style="max-width: 60%;">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo wpsc_the_checkout_item_error(); ?>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>

        <?php
        }elseif(wpsc_disregard_billing_state_fields()){
        ?>

            <tr class='wpsc_hidden'>
                <td class='<?php echo wpsc_checkout_form_element_id(); ?>'>
                    <label for='<?php echo wpsc_checkout_form_element_id(); ?>'>
                        <?php echo wpsc_checkout_form_name();?>
                    </label>
                </td>
                <td>
                    <?php echo wpsc_checkout_form_field();?>
                    <?php if(wpsc_the_checkout_item_error() != ''): ?>
                        <div class="alert alert-error" style="max-width: 60%;">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo wpsc_the_checkout_item_error(); ?>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>

        <?php
        }elseif( $wpsc_checkout->checkout_item->unique_name == 'billingemail'){
        ?>

            <?php $email_markup =
                "<div class='wpsc_email_address'>
                    <h5 style='margin-bottom: 15px;'>" . __('Saisir votre email', PIXELART) . "</h5>
                    <p class='wpsc_email_address_p'>
                    <img src='https://secure.gravatar.com/avatar/empty?s=60&amp;d=mm' id='wpsc_checkout_gravatar' />
                      " . wpsc_checkout_form_field() . "</p>";

            if(wpsc_the_checkout_item_error() != '')
                $email_markup .= "<p class='alert alert-error'>" . wpsc_the_checkout_item_error() . "</p>";
            $email_markup .= "</div>"; ?>

        <?php }else{ ?>

            <tr>
                <td class='<?php echo wpsc_checkout_form_element_id(); ?>'>
                    <label for='<?php echo wpsc_checkout_form_element_id(); ?>'>
                        <?php echo wpsc_checkout_form_name();?>
                    </label>
                </td>
                <td>
                    <?php echo wpsc_checkout_form_field();?>
                    <?php if(wpsc_the_checkout_item_error() != ''): ?>
                        <div class="alert alert-error" style="max-width: 60%;">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo wpsc_the_checkout_item_error(); ?>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>

        <?php } ?>

    <?php endwhile; ?>

    </table>

    <div class="clearfix"></div>

    <?php
    $buffer_contents = ob_get_contents();
    ob_end_clean();
    if(isset($email_markup))
        echo $email_markup;
    echo $buffer_contents;
    ?>

    <?php if (wpsc_show_find_us()) : ?>
        <div class="how_find_us margin-bottom">
            <h5 style="margin-bottom: 15px;"><?php _e('Comment nous avez-vous connu?', PIXELART); ?></h5>
            <select name='how_find_us'>
                <option value='Bouche a oreilles'><?php _e('Word of mouth' , PIXELART); ?></option>
                <option value='Advertisement'><?php _e('Publicite' , PIXELART); ?></option>
                <option value='Internet'><?php _e('Internet' , PIXELART); ?></option>
                <option value='Customer'><?php _e('Client' , PIXELART); ?></option>
            </select>
        </div>
    <?php endif; ?>

    <?php do_action('wpsc_inside_shopping_cart'); ?>

    <?php if(wpsc_gateway_count() > 1): ?>
        <h4 class="margin-bottom"><?php _e('Choisir un moyen de paiement', PIXELART); ?></h4>
        <div class="payment_options">
            <?php wpsc_gateway_list(); ?>
        </div>
    <?php else: ?>
        <div class="payment_options">
            <?php wpsc_gateway_hidden_field(); ?>
        </div>
    <?php endif; ?>

    <div class="main-cart-total">
        <ul>
            <li><?php _e('Sous-Total:', PIXELART); ?> <span><?php echo wpsc_cart_total_widget(false,false,false);?></span></li>
            <li><?php _e('Coupon:', PIXELART); ?> <span><?php echo wpsc_coupon_amount(); ?></span></li>
            <li><?php _e('Frais de livraison:', PIXELART); ?> <span><?php echo wpsc_cart_shipping(); ?></span></li>
            <?php
            $wpec_taxes_controller = new wpec_taxes_controller();
            if($wpec_taxes_controller->wpec_taxes_isenabled()):
                ?>
                <li><?php echo wpsc_display_tax_label(true); ?> <?php echo wpsc_cart_tax(); ?></li>
            <?php endif; ?>
        </ul>
        <p class="total"><?php _e('Total:', PIXELART); ?> <span><?php echo wpsc_cart_total(); ?></span>
    </div>

    <div class="main-checkout">
        <?php if(wpsc_has_tnc()) : ?>
            <label for="agree" class="text-right" style="margin-bottom: 15px;">
                <?php _e('Vous etes d\'accord avec nos conditions generales de vente.', PIXELART); ?> <span class="asterix">*</span>
                <input id="agree" type='checkbox' value='yes' name='agree' />
            </label>
        <?php else: ?>
            <input type='hidden' value='yes' name='agree' />
        <?php endif; ?>
        <input type='hidden' value='submit_checkout' name='wpsc_action' />
        <input type='submit' value='<?php _e('Confirmer la commande', PIXELART);?>' class='make_purchase wpsc_buy_button btn' />
        <a class="btn btn-checkout" href="<?php echo get_permalink( sh_set($shortcode_page_ids, '[productspage]')); ?>"><?php _e('Poursuivre vos achats', PIXELART); ?></a>
    </div>

</form>

<?php if ( is_user_logged_in() ) {
    global $user_email;
    get_currentuserinfo();
    ?>
    <script type="text/javascript">
        window.onload = function () {
            var second = document.getElementById('wpsc_checkout_form_9');
            second.value = '<?php echo $user_email; ?>';
        };
    </script>
<?php } if ( !is_user_logged_in() ) { ?>
    <script type="text/javascript">
        window.onload = function () {
            var first = document.getElementById('user_email'),
                second = document.getElementById('wpsc_checkout_form_9');
            first.onkeyup = function () {
                second.value = first.value;
            };
        };
    </script>
<?php } ?>
<?php do_action('wpsc_bottom_of_shopping_cart');