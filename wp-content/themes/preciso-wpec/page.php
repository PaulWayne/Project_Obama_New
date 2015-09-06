<?php get_header(); ?>

<!-- CONTENT -->
<div id="content">
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="container">
            <div class="row">
                <div class="span12">

                    <?php if( !is_products_page() ): ?>

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

                    <?php endif; ?>

                    <?php the_content (); ?>

                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<!-- CONTENT -->

<?php get_footer(); ?> 