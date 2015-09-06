<?php
/*
 *	Main Functions
 * 	---------------------------------------------------------------------------
 * 	@package	: Pixelart Themes Framework
 *	@author 	: Umair
 *	@version	: 2.0
 *	@link		: http://www.pixelartinc.com
 *	@copyright	: Copyright (c) 2013, http://www.pixelartinc.com
 *	--------------------------------------------------------------------------- */

/****************************************************************************
The Theme
 ****************************************************************************/
$the_theme = wp_get_theme();
define( 'THEME_NAME', $the_theme['Name'] );
define( 'THEME_VERSION', $the_theme['Version'] );
define( 'PIXELART', str_replace( ' ', '_', strtolower( THEME_NAME ) ) );


/****************************************************************************
Content Width
 ****************************************************************************/
if ( ! isset( $content_width ) ) $content_width = 1170;


/****************************************************************************
Editor Style Support
 ****************************************************************************/
add_editor_style('editor-style.css');


/****************************************************************************
Load Text Domain
 ****************************************************************************/
load_theme_textdomain( PIXELART , get_template_directory() . '/languages' );


/****************************************************************************
Automatic Feeds Links
 ****************************************************************************/
add_theme_support('automatic-feed-links');


/****************************************************************************
Post Thumbnails
 ****************************************************************************/
add_theme_support( 'post-thumbnails' );
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'blog', 370, 246, true );
    add_image_size( 'port_one', 250, 166, true );
    add_image_size( 'port_two', 350, 233, true );
    add_image_size( 'port_three', 550, 366, true );
    add_image_size( 'port_single', 750, 499, true );
    add_image_size( 'services', 160, 160, true );
    add_image_size( 'team', 270, 270, true );
}



/****************************************************************************
Theme Options & Metaboxes
****************************************************************************/
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
include_once( 'option-tree/ot-loader.php' );
include_once( 'functions/theme_options.php' );


/****************************************************************************
Shortcodes
****************************************************************************/
require(get_template_directory() . '/functions/shortcodes.php');


/****************************************************************************
Widgets
 ****************************************************************************/
define('WIDGETS', get_template_directory() . '/inc/widgets/');
require_once(WIDGETS . 'widget_social_media.php');
require_once(WIDGETS . 'widget_contact.php');

/*************** Registering ************************/
add_action( 'widgets_init', 'pixelart_widgets' );
function pixelart_widgets() {
    register_widget( 'social_media_widget' );
    register_widget( 'theme_contact_widget' );
}

/****************************************************************************
Register Sidebars
 ****************************************************************************/
if ( function_exists('register_sidebar') ) {
    register_sidebar(array('name'=>'Page',
        'description'   => 'This widgetised area is for static Pages only. All the widget added here will display on pages only.',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array('name'=>'Blog',
        'description'   => 'This widgetised area is for Blog page only. All the widget added here will display on Blog and relevant pages.',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array('name'=>'Bottom',
        'description'   => 'This widgetised area is for Bottom section of the site. All the widget added here will display in bottom section of the pages and posts.',
        'before_widget' => '<div class="widget span3">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
    register_sidebar(array('name'=>'Footer',
        'description'   => 'This widgetised area is for Footer section of the site only. All the widget added here will in footer section.',
        'before_widget' => '<div class="widget span3">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
}


/****************************************************************************
Custom Menu
 ****************************************************************************/
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
            'main-menu' => 'Main Menu',
        )
    );
}


/****************************************************************************
Loading JS Files
****************************************************************************/
if (!is_admin())
{
    function pixel_scripts() {

        $js = get_template_directory_uri().'/js/';

        wp_enqueue_script('jquery');
        ?>
        <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri() ?>/js/html5shiv.js"></script>
        <![endif]-->
        <?php
        if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
        if ( is_page_template('templates/template-contact.php') ) wp_enqueue_script('gmapapi', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');
        wp_enqueue_script('modernizer',  'http://modernizr.com/downloads/modernizr-latest.js');
        wp_enqueue_script('bootstrap',         $js.'bootstrap.min.js');
        wp_enqueue_script('fancybox',          $js.'jquery.fancybox.min.js',          array('jquery'), '', true);
        wp_enqueue_script('flexslider',        $js.'jquery.flexslider.min.js',        array('jquery'), '', true);
        wp_enqueue_script('grid',              $js.'jquery.grid.min.js',              array('jquery'), '', true);
        wp_enqueue_script('masonry',           $js.'jquery.masonry.min.js',           array('jquery'), '', true);
        wp_enqueue_script('nicescroll',        $js.'jquery.nicescroll.min.js',        array('jquery'), '', true);
        if ( is_page_template('templates/template-contact.php') )wp_enqueue_script('gmap', $js.'gmap.js', array('jquery'), '', true);
        wp_enqueue_script('functions',         $js.'functions.js',                    array('jquery'), '', true);

    }
    add_action( "wp_enqueue_scripts", "pixel_scripts", 11 );
}


/****************************************************************************
Loading CSS Files
 ****************************************************************************/
function pixel_styles()
{
    wp_register_style('default',        get_stylesheet_uri());
    wp_register_style('bootstrap',      get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_register_style('responsive',     get_template_directory_uri() . '/css/bootstrap-responsive.min.css');
    wp_register_style('awesome',        get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_register_style('multicolor',     get_template_directory_uri() . '/css/color/multicolor.css');
    wp_register_style('main',           get_template_directory_uri() . '/css/main.css');
    wp_register_style('flexslider',     get_template_directory_uri() . '/css/flexslider.css');
    wp_register_style('fancybox',       get_template_directory_uri() . '/css/fancybox.css');
    wp_register_style('masonry',        get_template_directory_uri() . '/css/masonry.css');

    wp_enqueue_style('default');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('responsive');
    wp_enqueue_style('awesome');
    wp_enqueue_style('multicolor');
    wp_enqueue_style('main');
    wp_enqueue_style('flexslider');
    wp_enqueue_style('fancybox');
    wp_enqueue_style('masonry');
}
add_action('wp_enqueue_scripts', 'pixel_styles');


/****************************************************************************
Insert all custom CSS styles
****************************************************************************/
function pixel_custom_styles() {

    get_template_part('inc/custom_color');

}
add_action('wp_head', 'pixel_custom_styles');


/****************************************************************************
Loading Theme Fonts
 ****************************************************************************/
function pixelart_fonts() {
    $protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( 'preciso-roboto', "$protocol://fonts.googleapis.com/css?family=Roboto+Condensed" );
}
add_action( 'wp_enqueue_scripts', 'pixelart_fonts' );


/****************************************************************************
Insert custom JS
 ****************************************************************************/
function pixel_custom_js() {
    if( ot_get_option('custom_cjs') )
        echo "\n" . '<script>' . ot_get_option('custom_cjs') . '</script>' . "\n";
}
add_action('wp_footer', 'pixel_custom_js');


/****************************************************************************
Custom Taxonomies
 ****************************************************************************/
require_once get_template_directory() . "/functions/custom_taxonomies.php";


/****************************************************************************
Custom Post Types
 ****************************************************************************/
require_once get_template_directory() . "/functions/custom_posts.php";


/****************************************************************************
Custom Functions
 ****************************************************************************/
include_once( 'functions/custom_functions.php' );


/****************************************************************************
Metaboxes
****************************************************************************/
define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/inc/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_stylesheet_directory() . '/inc/meta-box' ) );
require_once RWMB_DIR . 'meta-box.php';
include 'functions/theme_metaboxes_rw.php';
include_once( 'functions/theme_metaboxes_ot.php' );


/****************************************************************************
Plugins Activation
****************************************************************************/
if( is_admin() ) {
    require_once(get_template_directory().'/inc/tgm-plugin-activation/plugins.php');
}


/****************************************************************************
Function qui recupere l'id categories des produits
****************************************************************************/
function getCategorieID($slug){
	    global $wpdb;
        $results = $wpdb->get_var( "SELECT  distinct(t.term_id) FROM {$wpdb->posts} p
        JOIN {$wpdb->term_relationships} r ON r.object_id = p.ID
        JOIN {$wpdb->term_taxonomy} t ON r.term_taxonomy_id = t.term_taxonomy_id
        JOIN {$wpdb->terms} terms ON terms.term_id = t.term_id  
        WHERE t.taxonomy = 'wpsc_product_category'
        AND p.post_type = 'wpsc-product' AND p.post_status = 'publish' AND terms.slug ='$slug'
        ORDER BY p.post_date DESC");
        
        return  $results;	
	
}
function epureText($_txt_res,$deb,$fin){
	
	    $_num_debut = strpos($_txt_res,$deb);
        $_num_fin = strpos($_txt_res,$fin);
        
        $description = substr_replace($_txt_res,"",$_num_debut,$_num_fin); 
       
        echo  $description;
}

//function send_mail(){

//wp_mail('oumarycoul@gmail.com', 'The subject', 'The message' );

// wp_mail('lamine.dialo@gmail.com', 'The subject', 'The message' );

//}//

/**
* Disable admin bar on the frontend of your website
* for subscribers.
*/
function themeblvd_disable_admin_bar() { 
if( ! current_user_can('edit_posts') )
add_filter('show_admin_bar', '__return_false');	
}
add_action( 'after_setup_theme', 'themeblvd_disable_admin_bar' );

/**
* Redirect back to homepage and not allow access to 
* WP admin for Subscribers.
*/

function restrict_admin()
{
	if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
		wp_redirect( site_url() );
	}
}
add_action( 'admin_init', 'restrict_admin');

/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

/****************************************************************************
 Function qui verifie l'id de la page
****************************************************************************/
function isPageID($var){
	$link = get_permalink();
	
	$result = strrpos($link, $var);
		if($result !== false)
			return true;
	
	return false;
}
/*Function  qui retourne le nom/slug d'une categorie de produit*/
function getProductCategorieSlug(){
       $home_url = home_url().'/products-page/';
      //get current url
       global $wp;
       $current_url = home_url(add_query_arg(array(),$wp->request));
       $result = substr($current_url,strlen($home_url));
       $result = str_replace('/','',$result );
       return  $result;
 }
/****************************************************************************
 Function qui permet de traduire le formulaire d'inscription
****************************************************************************/
function my_translate()
{
	$your_content=ob_get_contents();
	$your_content= preg_replace('/Username/',        'Nom d\'utilisateur: ',$your_content);
	$your_content= preg_replace('/A password will be e-mailed to you/',    'Un mot de passe vous sera envoye par email',$your_content);
	$your_content= preg_replace('/Register For This Site/',    'S\'incrire sur ce site',$your_content);
	$your_content= preg_replace('/Register/',    'S\'incrire',$your_content);
	$your_content= preg_replace('/Log in/',    'Login',$your_content);
	$your_content= preg_replace('/Lost your password?/',    'Mot de passe perdu',$your_content); 
	$your_content= preg_replace('/Password/',    'Mot de passe',$your_content);
	$your_content= preg_replace('/Remember Me/',    'Se souvenir de Moi',$your_content);
	ob_get_clean();
	echo $your_content;
}
add_action( 'register_form', 'my_translate' );

add_action( 'login_form', 'my_translate' );



/****************************************************************************
 Function qui permet de changer le logo et l'url associé
 
 où:page d'inscription et page de login
****************************************************************************/
add_filter('login_headerurl','loginpage_custom_link');
function loginpage_custom_link() {
   return  home_url(); 
}
add_filter('wpsc_purchase_log_customer_notification_raw_message','modify_wpsc_purchase_log_customer_html_notification_raw_message');
add_filter('wpsc_purchase_log_customer_html_notification_raw_message','modify_wpsc_purchase_log_customer_html_notification_raw_message');
function modify_wpsc_purchase_log_customer_html_notification_raw_message($raw_message){
    if($raw_message != ''){
        $raw_message = str_replace('Thank you, your purchase is pending. You will be sent an email once the order clears.','Merci, votre commande est en cours de livraison. Pour disposer de vos produits, veuillez vous rendre au magasin.',$raw_message);
    }
    return $raw_message;
}

add_filter('wpsc_purchase_log_admin_notification_subject','modify_wpsc_purchase_log_admin_notification_subject');
function modify_wpsc_purchase_log_admin_notification_subject(){
    $string  = 'Recapitulatif des Commandes';
    return $string;
}
add_filter('wpsc_javascript_localization','modify_wpsc_javascript_localizations');
function modify_wpsc_javascript_localizations($localizations_array){
    if(!empty($localizations_array)){
        $localizations_array['no_region_label']           = __( 'Region', 'wpsc' );
    }
    return $localizations_array;
}
add_filter('wpsc_country_get_property','modify_wpsc_country_get_property');
function modify_wpsc_country_get_property($property_value){
    if($property_value == 'State/Province'){
        $property_value = 'Etat/Province';
    }
    return $property_value;
}

/*
 * Function qui permet de mettre à jour  la value de option_name ='wpsc_email_receipt'

function update_option_wpsc_email_receipt(){

    $option = get_option('wpsc_email_receipt');

    update_option('wpsc_email_receipt',$option);
}
* */
add_filter('wpsc_purchase_log_notification_product_table_args','modify_wpsc_purchase_log_notification_product_table_args');
function modify_wpsc_purchase_log_notification_product_table_args($table_args){
    $headings = array(
        _x( 'Produit'       ,'purchase log notification table heading', 'wpsc' ) => 'left',
        _x( 'Prix Unitaire'      , 'purchase log notification table heading', 'wpsc' ) => 'right',
        _x( 'Quantite'   , 'purchase log notification table heading', 'wpsc' ) => 'right',
        _x( 'Total' , 'purchase log notification table heading', 'wpsc' ) => 'right',
    );
    if(!empty($table_args)){
        $table_args['headings'] = $headings;
    }
  return $table_args;
}


