<?php

class social_media_widget extends WP_Widget {

	function social_media_widget() {
		$widget_ops = array( 'classname' => 'social_media', 'description' => __('A widget to display social icons.', PIXELART) );
		$this->WP_Widget( 'theme_info_widget', __('Pixel: Social Media', PIXELART), $widget_ops);
	}

    function widget( $args, $instance ) {

        extract( $args );
        $title = apply_filters('widget_title', $instance['title'] );
        $facebook = $instance['facebook'];
        $google_plus = $instance['google_plus'];
        $twitter = $instance['twitter'];
        $pin = $instance['pin'];
        $linkedin = $instance['linkedin'];

        echo $before_widget;
        ?>
        <div>
            <?php if ( $title ) echo $before_title . $title . $after_title; ?>
            <div class="footer-social">
                <?php
                    if ( ! empty( $facebook ) ) {
                        echo '<a href="'.$facebook.'" class="icon-facebook"></a>';
                    }
                    if ( ! empty( $twitter ) ) {
                        echo '<a href="'.$twitter.'" class="icon-twitter"></a>';
                    }
                    if ( ! empty( $google_plus ) ) {
                        echo '<a href="'.$google_plus.'" class="icon-google-plus"></a>';
                    }
                    if ( ! empty( $pin ) ) {
                        echo '<a href="'.$pin.'" class="icon-pinterest"></a>';
                    }
                    if ( ! empty( $linkedin ) ) {
                        echo '<a href="'.$linkedin.'" class="icon-linkedin"></a>';
                    }
                ?>
            </div>
        </div>
        <?php
        echo $after_widget;

    }

    function form( $instance ) {
        $defaults = array('title' =>'', 'phone' => '', 'email' => '', 'address' => '', 'facebook' => '', 'twitter' => '', 'linkedin' => '', 'pin' => '', 'google_plus' => '');
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Titre:', PIXELART); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

        <p><label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook:', PIXELART); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $instance['facebook']; ?>" style="width:100%;" /></p>

        <p><label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter:', PIXELART); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $instance['twitter']; ?>" style="width:100%;" /></p>

        <p><label for="<?php echo $this->get_field_id( 'google_plus' ); ?>"><?php _e('Google Plus:', PIXELART); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('google_plus'); ?>" name="<?php echo $this->get_field_name('google_plus'); ?>" value="<?php echo $instance['google_plus']; ?>" style="width:100%;" /></p>

        <p><label for="<?php echo $this->get_field_id( 'pin' ); ?>"><?php _e('Pinterest:', PIXELART); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('pin'); ?>" name="<?php echo $this->get_field_name('pin'); ?>" value="<?php echo $instance['pin']; ?>" style="width:100%;" /></p>

        <p><label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('RSS:', PIXELART); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" value="<?php echo $instance['linkedin']; ?>" style="width:100%;" /></p>
    <?php
    }
}
?>