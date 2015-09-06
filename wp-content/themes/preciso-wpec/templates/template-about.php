<?php
/**
 * Template Name: About
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
                    $team_args = array( 'post_type' => 'team', 'posts_per_page' => -1 );
                    $team_query = new WP_Query( $team_args );
                    if ( $team_query->have_posts() ):
                        while ( $team_query->have_posts() ) :
                            $team_query->the_post();
                            $post_id = get_the_ID();
                            $thumb_id = get_post_thumbnail_id();
                            $thumb_url = wp_get_attachment_image_src( $thumb_id, 'full' );
                            ?>
                            <li class="span3">
                                <div class="thumbnail">

                                    <?php
                                    if( has_post_thumbnail() ) {
                                        the_post_thumbnail('team');
                                    }?>

                                    <div class="caption">

                                        <h3><a href="<?php echo get_post_meta($post_id, 'link', true); ?>"><?php the_title(); ?></a></h3>
                                        <em><?php echo get_post_meta($post_id, 'designation', true); ?></em>
                                        <div class="footer-social">
                                            <?php
                                            $social_icons = array(
                                                'facebook'   => array( 'name'=>'facebook',    'link'=>get_post_meta($post_id, 'fb', true) ),
                                                'twitter'    => array( 'name'=>'twitter',     'link'=>get_post_meta($post_id, 'tw', true) ),
                                                'gplus'     => array( 'name'=>'google-plus','link'=>get_post_meta($post_id, 'gp', true) ),
                                                'pinterest'  => array( 'name'=>'pinterest',   'link'=>get_post_meta($post_id, 'pin', true) )
                                            );
                                            foreach( $social_icons as $social_icon => $social_meta ){
                                                $link  = $social_meta['link'];
                                                $class = $social_meta['name'];
                                                if(!empty($link)){
                                                    echo '<a href="'.$link.'" class="icon-'.$class.'"><img src="'.get_template_directory_uri().'/img/'.$class.'-icon.png" alt="'.$class.'" /></a>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <?php echo pixel_excerpt(5); ?>

                                    </div>

                                    <?php
                                    $skills = get_post_meta($post_id, 'skills', true);
                                    if($skills){
                                        foreach( $skills as $skill  ){
                                            if(!empty($skill)){
                                                echo '<div class="progress">
                                                    <div class="bar" style="width: '.$skill['skill_value'].'%">'.$skill['title'].'</div>
                                                </div>';
                                            }
                                        }
                                    }
                                    ?>

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