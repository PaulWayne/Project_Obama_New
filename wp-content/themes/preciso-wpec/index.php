<?php
/**
 * Template Name: Home
 */
get_header();
?>

    <!-- SLIDER -->
    <?php
    $slides = ot_get_option("home_slider");
    if( $slides ):
    ?>
        <div class="container">
            <div class="row">
                <div class="span12">

                    <div class="flexslider">
                        <ul class="slides">
                            <?php
                            foreach ( $slides as $slide ) {
                                echo '<li><a href="'.$slide['link'].'"><img src="'.$slide['img'].'" alt="'.$slide['title'].'" /></a></li>';
                            }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php get_template_part( 'inc/wpsc-featured_product' ); ?>

	<!-- CONTENT -->
	<div id="content">

        <div class="container">
            <?php
            $sections = ot_get_option("home_sections");
            if( $sections ):
                foreach ( $sections as $section ) {
                    $title = $section['title'];
                    if( $section['sec'] == 'fp' )
                    {
                        if( empty($title) ){ $title = 'Featured Products'; }
                        echo do_shortcode("[featured_products heading='".$title."' posts_per_page='4'][/featured_products]");
                    }
                    if( $section['sec'] == 'os' )
                    {
                        if( empty($title) ){ $title = 'Our Services'; }
                        
                        echo do_shortcode("[services heading='".$title."' posts_per_page='4'][/services]");
                    }
                    if( $section['sec'] == 'lw' )
                    {
                        if( empty($title) ){ $title = 'Latest Work'; }
                        echo do_shortcode("[latest_work heading='".$title."' posts_per_page='4'][/latest_work]");
                    }
                  
                    if( $section['sec'] == 'pc' && have_posts() )
                    {
                        while ( have_posts() ) : the_post();
                            the_content();
                        endwhile;
                    }
                }
            endif;
           
            $clients = ot_get_option("our_client_section");
            if($clients){
            		echo do_shortcode("[clients][/clients]");
             }
         
            ?>
            
            
        </div>

	</div>
	<!-- CONTENT -->
	
<?php get_footer(); ?> 