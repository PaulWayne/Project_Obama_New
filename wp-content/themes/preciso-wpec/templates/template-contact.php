<?php

/*
 * Template Name: Contact
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

            </div>
        </div>

        <div class="row">
            <div class="span3">
             <?php echo ot_get_option('contact_address'); ?>
            </div>
            <div class="span3">
                   <div class="map-form">
                    <?php echo do_shortcode(ot_get_option('contact_form')); ?>
                </div>
            </div>
            <div class="span6 margin-bottom">
                <?php
                $lat = ot_get_option('contact_map_lat');
                $lng = ot_get_option('contact_map_lng');
                if( !empty($lat) && !empty($lng) )
                {
                    echo '<div data-lat="'.$lat.'" data-lng="'.$lng.'" id="map-canvas" style="width: 100%; height: 360px;"></div>';
                }
                else
                {
                    echo '<p><strong>ERROR!</strong> Latitude and Longitude values are missing in Theme Options.<br />Please enter the values of Latitude and Longitude in <em>Appearance > Theme Options > Contact</em> to display the map properly.</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

       <div class="container">
           <?php the_content(); ?>
       </div>

    <?php endwhile; ?>

<?php get_footer(); ?>