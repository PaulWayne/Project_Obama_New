<?php get_header(); ?>

<div class="container">
    <div class="row">
        
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

            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <article id="single-post" class="<?php post_class(); ?>">
                    <em class="date"><?php _e('par', PIXELART)?> <?php the_author_posts_link() ?> <?php _e('sur', PIXELART)?> <span><?php the_date('F j, Y'); ?></span> <?php _e('dans', PIXELART); ?> <?php the_category(' '); ?></em>
                    <?php the_content();?>
                    <?php
                    $images = rwmb_meta( 'pimages', 'type=plupload_image');
                    if( $images )
                    {
                        echo '<ul class="blog-list">';
                        foreach ( $images as $image )
                        {
                            echo '<li class="span3">
                                    <div class="thumbnail">
                                        <img src="'.$image['full_url'].'" />
                                        <div class="blog-thumb">
                                            <a href="'.$image['full_url'].'" class="view-fancybox" rel="tag"><i class="icon-camera"></i></a>
                                        </div>
                                    </div>
                                </li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                    <div class="clearfix"></div>
                    <em class="date"><?php the_tags(__('Tags: ', PIXELART), ', ', ' '); ?></em>
                </article>
            <?php endwhile; ?>
            
            <?php wp_link_pages('before=<div class="post-page">&after=</div>&link_before=<span>&link_after=</span>'); ?>

            <?php comments_template();?>
            
        </div>

        <?php get_sidebar('Blog'); ?>
        
    </div>
</div>


<?php get_footer(); ?>