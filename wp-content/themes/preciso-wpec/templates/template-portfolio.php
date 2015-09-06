<?php

/*
 * Template Name: Portfolio Masonry
 */

get_header();

?>

<?php get_template_part('inc/title_breadcrumb'); ?>

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

                <?php
                $terms = get_terms("portfolio-categories");
                $count = count($terms);
                if ( $count > 0 ){
                    echo "<div id='filters' class='row products-filter option-set clearfix filter group' data-option-key='filter'><p>";
                    echo '<a href="#" data-filter="*" class="active">All</a>';
                    foreach ( $terms as $term ) {
                        ?>
                        <a href="#" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
                    <?php
                    }
                    echo "</p></div>";
                }
                ?>

                <div id="isotope">
                    <?php
                    $portfolio_args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1 );

                    $portfolio_query = new WP_Query( $portfolio_args );

                    if ( $portfolio_query->have_posts() ):
                        while ( $portfolio_query->have_posts() ) :
                            $portfolio_query->the_post();
                            $portfolio_term = get_the_terms( $post->ID, 'portfolio-categories' );
                            ?>
                            <div class="item  <?php if(!empty($portfolio_term)) {foreach($portfolio_term as $term){ echo $term->slug.' '; } } ?>">
                                <?php
                                if( has_post_thumbnail() ) {
                                    $thumb_id = get_post_thumbnail_id();
                                    $thumb_url = wp_get_attachment_image_src( $thumb_id, 'full' );
                                    the_post_thumbnail();
                                    ?>
                                    <div class="folio-detail">
                                        <a href="<?php $port = ot_get_option('port'); if( $port == 'single_simple' ) { the_permalink(); } elseif( $port == 'light_box' )  {  echo $thumb_url[0];}else{the_permalink();}  ?>" class="<?php $port = ot_get_option('port'); if( $port == 'single_simple' ) { echo 'single_page_post'; } elseif( $port == 'light_box' )  {  echo 'view-fancybox';}else{echo 'single_page_post';}  ?>" rel="tag"><i class="icon-camera"></i></a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        endwhile;
                    endif;
                    ?>
                </div>

            </div>
        </div>
    </div>

<?php get_footer(); ?>