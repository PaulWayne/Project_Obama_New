
        <!-- Footer -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <?php if ( ! dynamic_sidebar( 'Bottom' )) : ?>
                    <?php endif; ?>
                    <script type='text/javascript'>
                        jQuery(document).ready(function($) {
                            $('.widget:nth-child(1)').children('h5').prepend( "<i class='icon-info'></i>" );
                            $('.widget:nth-child(2)').children('h5').prepend( "<i class='icon-comment'></i>" );
                            $('.widget:nth-child(3) > div').children('h5').prepend( "<i class='icon-folder-open'></i>" );
                            $('.widget:nth-child(4)').children('h5').prepend( "<i class='icon-unlock-alt'></i>" );
                        });
                    </script>
                </div>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="footer-links">
            <div class="container">
                <div class="row">
                    <?php if ( ! dynamic_sidebar( 'Footer' )) : ?>
                    <?php endif; ?>
                </div>
            </div>
            <hr class="bordered" />
        </div>

        <!-- Copy -->
        <div class="copy">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <p class="text-center"><?php echo ot_get_option('copyright_text');?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- to Top -->
        <div id="toTop"><i class="icon-chevron-up icon-white"></i></div>

	    <?php wp_footer(); ?>
	
    </body>
</html>