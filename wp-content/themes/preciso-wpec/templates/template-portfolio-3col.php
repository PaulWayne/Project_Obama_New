<?php

/*
 * Template Name: Portfolio 3 Column
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

                <div class="products-list products-list-simple">
                    <ul class="thumbnails">

                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $posts_per_page = ot_get_option('port_page');
                        $args = array(
                            'post_type' => 'portfolio',
                            'paged' => $paged,
                            'posts_per_page'  => $posts_per_page,
                        );
                        $temp = $wp_query;
                        $wp_query= null;
                        $wp_query = new WP_Query( $args );
                        while($wp_query->have_posts()): $wp_query->the_post();
                            ?>
                            <li class="span4">
                                <div class="thumbnail">
                                    <?php
                                    if( has_post_thumbnail() ) {
                                        $thumb_id = get_post_thumbnail_id();
                                        $thumb_url = wp_get_attachment_image_src( $thumb_id, 'full' );
                                        the_post_thumbnail('port_two');
                                        ?>
                                        <div class="folio-detail">
                                            <a href="<?php $port = ot_get_option('port'); if( $port == 'single_simple' ) { the_permalink(); } elseif( $port == 'light_box' )  {  echo $thumb_url[0];}else{the_permalink();}  ?>" class="<?php $port = ot_get_option('port'); if( $port == 'single_simple' ) { echo 'single_page_post'; } elseif( $port == 'light_box' )  {  echo 'view-fancybox';}else{echo 'single_page_post';}  ?>" rel="tag"><i class="icon-camera"></i></a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </li>
                        <?php endwhile; ?>

                    </ul>

                    <?php pixelart_pagination( $wp_query->max_num_pages); ?>

                </div>

            </div>
        </div>
    </div>

<?php get_footer(); ?>