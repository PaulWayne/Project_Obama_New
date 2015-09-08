<?php
/* 
 *	Custom Functions
 * 	---------------------------------------------------------------------------
 * 	@package	: Pixelart Themes Framework
 *	@author 	: Umair
 *	@version	: 2.0
 *	@link		: http://www.pixelartinc.com
 *	@copyright	: Copyright (c) 2013, http://www.pixelartinc.com
 *	--------------------------------------------------------------------------- */
 
 
/****************************************************************************
Browser Based Body Classes
****************************************************************************/
function pixelart_browser_body_class($class) {
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    if($is_lynx)
    $class[] = 'lynx';
    elseif($is_gecko)
    $class[] = 'gecko';
    elseif($is_opera)
    $class[] = 'opera';
    elseif($is_NS4)
    $class[] = 'ns4';
    elseif($is_safari)
    $class[] = 'safari';
    elseif($is_chrome)
    $class[] = 'chrome';
    elseif($is_IE)
    $class[] = 'ie';
    elseif($is_iphone)
    $class[] = 'iphone';
    else
    $class[] = 'unknown';
    return $class;
}
add_filter('body_class', 'pixelart_browser_body_class');
	
	
/****************************************************************************
Active Menu Classes
****************************************************************************/
function pixelart_clean_active_menu($css_classes, $item) {
    $css_classes = str_replace('current_page_item', 'active', $css_classes);
    $css_classes = str_replace('current-menu-item', 'active', $css_classes);
    $css_classes = str_replace('current-post-ancestor', 'active', $css_classes);
    $css_classes = str_replace('current-menu-parent', 'active', $css_classes);
    $css_classes = str_replace('current-menu-ancestor', 'active', $css_classes);
    return $css_classes;
}
add_filter('nav_menu_css_class', 'pixelart_clean_active_menu', 10, 2);
	  

/****************************************************************************
Custom Excerpt Length
 ****************************************************************************/
function pixelart_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'pixelart_excerpt_length' );

function pixelart_auto_excerpt_more( $more ) {
    return ' &hellip;';
}
add_filter( 'excerpt_more', 'pixelart_auto_excerpt_more' );

function pixel_excerpt( $limit ) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt);
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}


/****************************************************************************
Theme Pagination
 ****************************************************************************/
function pixelart_pagination($pages = ''){
    global $paged;
    if(empty($paged))$paged = 1;
    $range = 3;
    $showitems = ($range * 2)+1;
    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }
    if(1 != $pages){
        echo "<div class='pagination pagination-right'>";
        echo get_previous_posts_link();
        for ($i=1; $i <= $pages; $i++){
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                echo ($paged == $i)? "<a href='".get_pagenum_link($i)."' class='active'>".$i."</a> ":"<a href='".get_pagenum_link($i)."'>".$i."</a> ";
            }
        }
        echo get_next_posts_link();
        echo "</div>";
    }
}


/****************************************************************************
Comments Listing
 ****************************************************************************/
if( !function_exists( 'pixelart_comment' ) )
{
    function pixelart_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
        <li class="media"  id="comment-<?php comment_ID() ?>">
            <a href="<?php echo get_comment_author_url(); ?>" class="avatar pull-left thumbpull-left thumb">
                <?php echo get_avatar( $comment->comment_author_email, 100 ); ?>
            </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="<?php echo get_comment_author_url(); ?>"><?php comment_author_link(); ?></a></h4>
                <em class="data-time"><?php echo get_comment_date( 'F j, Y' ); _e(' at ', PIXELART); echo comment_time( 'H:i:s' ); ?></em>
                <?php comment_text(); ?>
                <?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', PIXELART), 'depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '<span class="reply pull-right">', 'after' => '</span>',))) ?>
                <?php edit_comment_link( _('Edit', PIXELART), '<span class="edit-link reply pull-right">', '</span>' );  ?>
            </div>
        <?php
    }

}


/****************************************************************************
Breadcrumbs
****************************************************************************/
function pixelart_breadcrumbs() {

    $text['home']       = __('Accueil', PIXELART);
    $text['blog']       = __('Blog', PIXELART);
    $text['category']   = __('Archive par catégorie "%s"', PIXELART);
    $text['search']     = __('Resultat de la recherche  "%s"', PIXELART);
    $text['tag']        = __('Posts Tagged "%s"', PIXELART);
    $text['author']     = __('Articles Posté par %s', PIXELART);
    $text['404']        = __('Erreur 404', PIXELART);

    $show_current   = 1;
    $show_on_home   = 0;
    $show_home_link = 1;
    $show_title     = 1;
    $delimiter      = '';
    $before         = '<li class="active">';
    $after          = '</li>';

    global $post;
    $home_link      = home_url('/');
    $link_before    = '<li>';
    $link_after     = '<span class="divider">/</span></li>';
    $link_attr      = '';
    $link           = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    if(isset($post->post_parent)){
        $parent_id = $parent_id_2 = $post->post_parent;
    }
    $frontpage_id   = get_option('page_on_front');

    if (is_front_page()) {

        if ($show_on_home == 1) echo '<ul class="breadcrumbs"><li><a href="' . $home_link . '">' . $text['home'] . '</a></li></ul>';

    } else {

        echo '<ul class="breadcrumb">';

        if ($show_home_link == 1) {

            echo '<li><a href="' . $home_link . '">' . $text['home'] . '</a><span class="divider">/</span></li>';
            if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;

        }

        if ( is_category() ) {

            $this_cat = get_category(get_query_var('cat'), false);
            if ($this_cat->parent != 0) {
                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

        } elseif ( is_search() ) {

            echo $before . sprintf($text['search'], get_search_query()) . $after;

        } elseif ( is_day() ) {

            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {

            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {

            echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {

            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
                if ($show_current == 1) echo $before . get_the_title() . $after;
            }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif ( is_attachment() ) {

            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            if ($cat) {
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            printf($link, get_permalink($parent), $parent->post_title);
            if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

        } elseif ( is_page() && !$parent_id ) {

            if ($show_current == 1) echo $before . get_the_title() . $after;

        } elseif ( is_page() && $parent_id ) {

            if ($parent_id != $frontpage_id) {
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo $delimiter;
                }
            }
            if ($show_current == 1) {
                if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
                echo $before . get_the_title() . $after;
            }

        } elseif ( is_tag() ) {

            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

        } elseif ( is_author() ) {

            global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;

        } elseif ( is_404() ) {

            echo $before . $text['404'] . $after;

        } elseif ( is_home() ) {

            echo $before . $text['blog'] . $after;

        }

        if ( get_query_var('paged') ) {

            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page', PIXELART) . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';

        }

        echo '</ul>';

    }
}


/****************************************************************************
Related Products
****************************************************************************/
function pixel_related_products(){

    global $post;
    $product_cat = wp_get_object_terms(wpsc_the_product_id(), 'wpsc_product_category');
    $product_tag = wp_get_object_terms(wpsc_the_product_id(), 'product_tag');

    foreach ($product_cat as $cat_item) {
        $cat_array_name_list[] = $cat_item->slug;
    }
    foreach ($product_tag as $tag_item) {
        $tag_array_name_list[] = $tag_item->slug;
    }

    $number         = 6;
    $main_title     = ot_get_option( 'related_port_heading' );
    $related_by     = ot_get_option( 'related_port_by' );

    if($related_by == 'wpsc_product_category'){
        $tax    = 'wpsc_product_category';
        $terms  = $cat_array_name_list;
    }
    else{
        $tax    = 'product_tag';
        $terms  = $tag_array_name_list;
    }

    if (empty($related_product)) {

        $query = array (
            'showposts' => $number,
            'orderby'   => 'rand',
            'post_type' => 'wpsc-product',
            'tax_query' => array(
                array(
                    'taxonomy'  => $tax,
                    'field'     => 'slug',
                    'terms'     => $terms
                )
            ),
            'post__not_in' => array ($post->ID),
        );

        $related_product = new WP_Query($query);

        if(!$related_product->have_posts()){
            $query = array (
                'showposts' => $number,
                'orderby'   => 'rand',
                'post_type' => 'wpsc-product',
                'post__not_in' => array ($post->ID),
            );
            $related_product = new WP_Query($query);
        }

        if($related_product->have_posts()):

            echo "<div class='products-list products-list-small'><div class='container'>";

            $title_parts = explode(' ', $main_title, 2);
            echo '<h3>'.$title_parts[0].' <span>'.$title_parts[1].'</span></h3>';

            ?>
            <ul class="thumbnails">

                <?php while($related_product->have_posts()) : $related_product->the_post();?>
                    <li class=" span2 product-<?php echo wpsc_the_product_id(); ?> <?php echo wpsc_category_class(); ?>">
                        <div class="thumbnail">

                            <?php if(wpsc_the_product_thumbnail()) : ?>
                                <a href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>" class="thumb"><img src="<?php echo wpsc_the_product_thumbnail(); ?>" alt="Product" /></a>
                            <?php endif; ?>

                            <p><a href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>"><?php echo wpsc_the_product_title(); ?></a></p>

                            <?php wpsc_the_product_price_display( array( 'output_you_save' => false, 'output_old_price' => false ) ); ?>

                            <form class="product_form"  enctype="multipart/form-data" action="<?php echo esc_url(wpsc_the_product_permalink()); ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_<?php echo wpsc_the_product_id(); ?>" >
                                <?php do_action ( 'wpsc_product_form_fields_begin' ); ?>
                                <input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
                                <input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>
                                <?php if((get_option('hide_addtocart_button') == 0) &&  (get_option('addtocart_or_buynow') !='1')) : ?>
                                    <?php if(wpsc_product_has_stock()) : ?>
                                        <div class="wpsc_buy_button_container">
                                            <?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
                                                <?php $action = wpsc_product_external_link( wpsc_the_product_id() ); ?>
                                                <input class="wpsc_buy_button" type="submit" value="<?php echo wpsc_product_external_link_text( wpsc_the_product_id(), __( 'Buy Now', PIXELART ) ); ?>" onclick="return gotoexternallink('<?php echo esc_url( $action ); ?>', '<?php echo wpsc_product_external_link_target( wpsc_the_product_id() ); ?>')">
                                            <?php else: ?>
                                                <input type="submit" value="<?php _e('Add To Cart', PIXELART); ?>" name="Buy" class="wpsc_buy_button btn" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
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
                            } elseif( $product == 'sold' )  {
                                ?>
                                <span class="sale"><?php _e('SALE', PIXELART); ?></span>
                            <?php
                            }
                            ?>

                        </div>
                    </li>
                <?php endwhile;?>

            </ul>
            <?php
            echo "</div></div><div class='clear'></div>";
        endif;
        wp_reset_postdata();
    }

}


function sh_set( $var, $key, $def = '' )
{
    if( !$var ) return false;

    if( is_object( $var ) && isset( $var->$key ) ) return $var->$key;
    elseif( is_array( $var ) && isset( $var[$key] ) ) return $var[$key];
    elseif( $def ) return $def;
    else return false;
}


/****************************************************************************
Products Gallery
****************************************************************************/
function pixel_wpsc_images_for_product($id){
    global $wpdb;
    $post_thumbnail = get_post_thumbnail_id();
    $attachments = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_parent = $id AND post_type = 'attachment' ORDER BY menu_order ASC",$id));
    foreach ($attachments as $attachment){
        if ($attachment->ID <> $post_thumbnail){
            $image_attributes = wp_get_attachment_image_src($attachment->ID,'thumbnail');?>
            <li><a rel="<?php echo wpsc_the_product_title(); ?>" href="<?php echo $attachment->guid; ?>" class="<?php echo wpsc_the_product_image_link_classes(); ?>">
                <img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo wpsc_the_product_title(); ?>"/>
            </a></li>
        <?php }
    }
}


/****************************************************************************
Languages Switcher
****************************************************************************/
function pixel_language_selector(){
    if( function_exists( 'icl_get_languages' )){
        $languages = icl_get_languages('skip_missing=0&orderby=code');
        if(!empty($languages)){
            echo '<ul class="nav nav-pills currency">';
            foreach($languages as $l){
                if($l['active']){
                    echo '<li class="active">';
                }
                else{
                    echo '<li>';
                }
                echo '<a href="'.$l['url'].'">'.$l['language_code'].'</a>';
                echo '</li>';
            }
            echo '</ul>';
        }
    }
}


/****************************************************************************
Custom Dashboard login page logo
****************************************************************************/
function pixel_login_logo(){
    if( ot_get_option('logo') )
        echo '<style  type="text/css"> h1 a {  background-image:url('.ot_get_option('logo').')  !important; background-position: center center !important; background-size: 80% auto !important; background-size: 80% auto !important; width: auto !important; } </style>';
}
add_action('login_head',  'pixel_login_logo');
