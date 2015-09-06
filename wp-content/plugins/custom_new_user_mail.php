<?php
/*
Plugin Name: Custom New User Email
Description: Changes the copy in the email sent out to new users
*/
 
// Redefine user notification function
if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);
 
        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);
 
        $message  = sprintf(__('Nouvelle inscription sur le site  %s:'), get_option('blogname')) . "rnrn";
        $message .= sprintf(__('Nom d\'utilisateur: %s'), $user_login) . "rnrn";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "rn";
 
        @wp_mail(get_option('admin_email'), sprintf(__('[%s] Nouvelle inscription'), get_option('blogname')), $message);
 
        if ( empty($plaintext_pass) )
            return;
 
        $message  = __('Bonjour,') . "rnrn";
        $message .= sprintf(__("Bienvenue chez %s! Voici votre login et mot de passe:"), get_option('blogname')) . "rnrn";
        $message .= wp_login_url() . "rn";
        $message .= sprintf(__('Nom d\'utilisateur: %s'), $user_login) . "rn";
        $message .= sprintf(__('Mot de passe: %s'), $plaintext_pass) . "rnrn";
        $message .= sprintf(__('En cas de probleme,Merci de nous contacter sur %s.'), get_option('admin_email')) . "rnrn";
        $message .= __('A bientot !');
 
        wp_mail($user_email, sprintf(__('[%s] Votre login et mot de passe'), get_option('blogname')), $message);
 
    }
}
 
?>