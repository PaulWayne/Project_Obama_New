<?php get_header(); ?>

<div class="container">
    <div class="row">

        <div class="span9">

            <div class="breadcrumb">
                <?php pixelart_breadcrumbs(); ?>
            </div>

            <h1><?php printf( __( 'Rechercher: %s', PIXELART ), get_search_query() ); ?></h1>

            <ul class="blog-list">
                <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                    <li class="clearfix">
                        <div class="span4 thumbnail">
                            <?php
                            if( has_post_thumbnail() )
                            {
                                $thumb_id = get_post_thumbnail_id();
                                $thumb_url = wp_get_attachment_image_src( $thumb_id, 'full' );
                                the_post_thumbnail('blog');
                                ?>
                                <div class="blog-thumb">
                                    <a href="<?php echo $thumb_url[0]; ?>" class="view-fancybox" rel="tag"><i class="icon-camera"></i></a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <em class="date"><?php _e('par', PIXELART)?> <?php the_author_posts_link(); ?> <?php _e('sur', PIXELART)?> <span><?php the_date('F j, Y'); ?></span> <?php _e('in', PIXELART)?> <?php the_category(' '); ?></em>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php the_excerpt(); ?>
                        <a class="btn btn-primary" href="<?php the_permalink(); ?>"><?php _e('Continuer', PIXELART);?></a>
                    </li>
                <?php endwhile;wp_reset_query(); ?>
                <?php pixelart_pagination( $wp_query->max_num_pages); ?>
            </ul>

        </div>

        <?php get_sidebar('Blog'); ?>

    </div>
</div>

<?php get_footer(); ?>