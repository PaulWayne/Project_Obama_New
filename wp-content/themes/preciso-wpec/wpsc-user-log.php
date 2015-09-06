<?php global $current_tab; ?>

<div class="wrap">

	<?php if ( is_user_logged_in() ) : ?>
		<div class="user-profile-links">

			<?php $default_profile_tab = apply_filters( 'wpsc_default_user_profile_tab', 'purchase_history' ); ?>

			<?php $current_tab = isset( $_REQUEST['tab'] ) ? $_REQUEST['tab'] : $default_profile_tab; ?>

			<?php wpsc_user_profile_links(); ?>

			<?php do_action( 'wpsc_additional_user_profile_links', '|' ); ?>

		</div>

		<?php do_action( 'wpsc_user_profile_section_' . $current_tab ); ?>

	<?php else : ?>

		<div class="alert alert-info"><?php _e( 'Vous devez etre connecte pour acceder a cette page. Merci de vous connecter sur votre compte.', PIXELART ); ?></div>

		<form class="wpsc_registration_form" name="loginform" id="loginform" action="<?php echo esc_url( wp_login_url() ); ?>" method="post">
            <h4 style="margin-bottom: 30px;"><?php _e('Se connecter sur votre compte', PIXELART);?></h4>
            <fieldset class='wpsc_registration_form wpsc_right_registration'>
                <label><?php _e( 'Nom d\'utilisateur:', PIXELART ); ?></label>
                <input type="text" name="log" id="log" value="" size="20" tabindex="1" />
				<label><?php _e( 'Mot de passe:', PIXELART ); ?></label>
                <input type="password" name="pwd" id="pwd" value="" size="20" tabindex="2" />
                <br/>
				<input style="vertical-align: -1px; margin: 0 10px 0 0" name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="3" />
                <label><?php _e( 'Se souvenir de moi', PIXELART ); ?></label>
                <br/>
                <br/>
				<input type="submit" name="submit" class="btn btn-general" id="submit" value="<?php _e( 'Login &raquo;', PIXELART ); ?>" tabindex="4" />
				<input type="hidden" name="redirect_to" value="<?php echo esc_url( get_option( 'user_account_url' ) ); ?>" />
            </fieldset>
		</form>

	<?php endif; ?>

</div>
