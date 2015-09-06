<?php

class theme_contact_widget extends WP_Widget {

    function theme_contact_widget() {
        $widget_ops = array( 'classname' => 'theme_contact', 'description' => __('A widget to display your contact.', PIXELART) );
        $this->WP_Widget( 'theme_contact_widget', __('Pixel: Theme Contact', PIXELART), $widget_ops);
    }

    function widget( $args, $instance ) {

        extract( $args );
        $title = apply_filters('widget_title', $instance['title'] );
        $address = $instance['address'];
        $phone = $instance['phone'];
        $Mobile = $instance['mobile'];
        $email = $instance['email'];

        echo $before_widget;
        ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <ul class="footer-contact">
            <?php
            if ( ! empty( $address ) ) {
                echo ' <li><i class="icon-map-marker"></i>'.$address.'</li> ';
            }
            if ( ! empty( $phone ) ) {
                echo ' <li><i class="icon-phone"></i>'.$phone.'</li> ';
            }
            if ( ! empty( $Mobile ) ) {
                echo ' <li><i class="icon-mobile-phone"></i>'.$Mobile.'</li> ';
            }
            if ( ! empty( $email ) ) {
                echo ' <li><i class="icon-envelope-alt"></i><a href="#">'.$email.'</a></li> ';
            }
            ?>
        </ul>
        <?php
        echo $after_widget;

    }

    function form( $instance ) {
        $defaults = array('title' =>'', 'address' => '', 'phone' => '', 'mobile' => '', 'email' => '');
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Titre:', PIXELART); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

        <p><label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e('Adresse:', PIXELART); ?></label>
            <textarea name="<?php echo $this->get_field_name('address'); ?>" id="<?php echo $this->get_field_id('address'); ?>" cols="30" rows="3" style="width:100%;"><?php echo $instance['address']; ?></textarea>

        <p><label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e('Telephone:', PIXELART); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" value="<?php echo $instance['phone']; ?>" style="width:100%;" /></p>

        <p><label for="<?php echo $this->get_field_id( 'mobile' ); ?>"><?php _e('Mobile:', PIXELART); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('mobile'); ?>" name="<?php echo $this->get_field_name('mobile'); ?>" value="<?php echo $instance['mobile']; ?>" style="width:100%;" /></p>

        <p><label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Email:', PIXELART); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" style="width:100%;" /></p>
    <?php
    }

}
?>