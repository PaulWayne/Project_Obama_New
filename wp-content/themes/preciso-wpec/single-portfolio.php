<?php get_header(); ?>

<div class="container">
    <div class="row">

        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

            <div class="span8 margin-top">
                <div class="products-list products-list-simple">
                    <ul class="thumbnails">
                        
                        <li class="span8">
                            <div class="thumbnail">
                                <?php
                                if( has_post_thumbnail() )
                                {
                                    $thumb_id = get_post_thumbnail_id();
                                    $thumb_url = wp_get_attachment_image_src( $thumb_id, 'full' );
                                    ?>
                                    <?php the_post_thumbnail('port_single'); ?>
                                    <div class="folio-detail"><a href="<?php echo $thumb_url[0];?>" class="view-fancybox" rel="tag"><i class="icon-camera"></i></a></div>
                                <?php
                                }?>
                            </div>
                        </li>
                        
                        <?php
                        $images = rwmb_meta( 'pimages', 'type=plupload_image');
                        foreach ( $images as $image )
                        {
                            echo '
                            <li class="span4">
                                <div class="thumbnail">
                                    <img src="'.$image['full_url'].'" />
                                    <div class="folio-detail">
                                        <a href="'.$image['full_url'].'" class="view-fancybox" rel="tag"><i class="icon-camera"></i></a>
                                    </div>
                                </div>
                            </li>';
                        }
                        ?>
                        
                    </ul>
                </div>
            </div>
            
            <div class="span4">

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

                <em class="date"><?php _e('par', PIXELART)?> <?php the_author_posts_link() ?> <?php _e('sur', PIXELART)?> <?php the_date('F j, Y'); ?></em>

                <?php the_content();?>

            </div>

        <?php endwhile; ?>
        
    </div>
</div>

<?php get_footer(); ?>