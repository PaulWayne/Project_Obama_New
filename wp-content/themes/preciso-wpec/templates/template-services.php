<?php
/**
 * Template Name: Services
 */
get_header();
?>

	<!-- CONTENT -->
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

                <ul class="thumbnails about-list">
                    <?php
                    $services_args = array( 'post_type' => 'services', 'posts_per_page' => -1 );
                    $services_query = new WP_Query( $services_args );
                    if ( $services_query->have_posts() ):
                        while ( $services_query->have_posts() ) :
                            $services_query->the_post();
                            $icon = get_post_meta(get_the_id(), 'services_icon', true);
                            $subtitle = get_post_meta(get_the_id(), 'subtitle', true);
                            ?>
                            <li class="span3">
                                <div class="thumbnail">
                                    <?php
                                    if( has_post_thumbnail() ) {
                                        the_post_thumbnail('services');
                                    }else{
                                        ?>
                                        <i class="icon-<?php echo $icon; ?>  icon-service"></i>
                                    <?php
                                    }
                                    ?>
                                    <div class="caption">
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <em><?php echo $subtitle; ?></em>
                                        <div class="clearfix"></div>
                                        <?php echo the_excerpt(); ?>
                                    </div>
                                </div>
                            </li>
                        <?php
                        endwhile;
                    endif;
                    ?>
                </ul>

            </div>
        </div>
    </div>
    <!-- CONTENT -->

    <?php while ( have_posts() ) : the_post(); ?>
        <div class="container">
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>
	
<?php get_footer(); ?> 