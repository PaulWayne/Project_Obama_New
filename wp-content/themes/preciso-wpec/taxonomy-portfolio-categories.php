<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <div class="span12">

                <div class="breadcrumb">
                    <?php pixelart_breadcrumbs(); ?>
                </div>

                <?php $term = get_term_by( 'slug', get_query_var('term') , 'portfolio-categories' ); ?>
                <h1><?php _e('PROJECTS IN', PIXELART); ?> <span><?php echo $term->name; ?></span></h1>

                <p class="small-desc"><?php echo get_post_meta(get_the_id(), 'page_desc', true);?></p>

                <div class="products-list products-list-simple">
                    <ul class="thumbnails">
                        <?php while (have_posts()) : the_post(); ?>
                            <li class="span3">
                                <div class="thumbnail">
                                    <?php
                                    if( has_post_thumbnail() ) {
                                        $thumb_id = get_post_thumbnail_id();
                                        $thumb_url = wp_get_attachment_image_src( $thumb_id, 'full' );
                                        the_post_thumbnail('port_one');
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

                    <?php pixelart_pagination( $wp_query->max_num_pages ); ?>

                </div>

            </div>
        </div>
    </div>

<?php get_footer(); ?>