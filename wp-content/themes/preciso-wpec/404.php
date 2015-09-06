<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <div class="span12 p404">
                <h1><?php _e('ERREUR <span>404</span>', PIXELART)?></h1>
                <p class="lead"><?php _e('Desole, Page non trouvee.', PIXELART)?></p>
                <a class="btn btn-large p404" href="<?php echo home_url(); ?>"><?php _e('Retourner sur la page Accueil', PIXELART)?></a>
            </div>
        </div>
    </div>

<?php get_footer(); ?>