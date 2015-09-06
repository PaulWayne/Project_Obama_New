<?php
/**
 * Template Name: Left Sidebar
 */
get_header();
?>

	<!-- CONTENT -->
	<div id="content" class="left_sidebar">

        <?php while ( have_posts() ) : the_post(); ?>
            <div class="container">
                <div class="row">

                    <?php get_sidebar( 'page' ); ?>

                    <div class="span9">

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

                        <em class="date"><?php _e('by', PIXELART)?> <?php echo get_the_author_link(); ?> <?php _e('on', PIXELART)?> <?php echo get_the_date()?></em>

                        <?php the_content (); ?>

                    </div>
                </div>
            </div>
        <?php endwhile; ?>
	</div>
	<!-- CONTENT -->
	
<?php get_footer(); ?> 