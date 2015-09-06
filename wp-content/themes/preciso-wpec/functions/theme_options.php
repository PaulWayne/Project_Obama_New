<?php
/*
 *	Theme Options
 * 	---------------------------------------------------------------------------
 * 	@package	: Pixelart Themes Framework
 *	@author 	: Umair
 *	@version	: 2.0
 *	@link		: http://www.pixelartinc.com
 *	@copyright	: Copyright (c) 2013, http://www.pixelartinc.com
 *	--------------------------------------------------------------------------- */


add_action( 'admin_init', 'custom_theme_options', 1 );

function custom_theme_options() {

    $saved_settings = get_option( 'option_tree_settings', array() );

    $custom_settings = array(
        'contextual_help' => array(
            'sidebar'       => ''
        ),

        // Sections
        'sections'        => array(
            array(
                'id'          => 'general',
                'title'       => 'General'
            ),
            array(
                'id'          => 'home',
                'title'       => 'Home'
            ),
            array(
                'id'          => 'portfolio',
                'title'       => 'Portfolio'
            ),
            array(
                'id'          => 'contact',
                'title'       => 'Contact'
            ),
            array(
                'id'          => 'store',
                'title'       => 'Store'
            )
        ),

        // Settings
        'settings'        => array(

            // General
            array(
                'id'          => 'favicon',
                'label'       => 'Favicon',
                'desc'        => 'Upload a favicon image. An image of size 16px X 16px and transparent PNG/ICO.',
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'general'
            ),
            array(
                'id'          => 'logo',
                'label'       => 'Logo',
                'desc'        => 'Upload your logo here.',
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'general'
            ),
            array(
                'id'          => 'blog_heading',
                'label'       => 'Blog Page Heading',
                'desc'        => 'Heading for Blog page.',
                'std'         => 'Home Blog',
                'type'        => 'text',
                'section'     => 'general',
            ),
            array(
                'id'          => 'copyright_text',
                'label'       => 'Copyright Text',
                'desc'        => 'Enter copyright text here. Will display in footer.',
                'std'         => '',
                'type'        => 'textarea-simple',
                'section'     => 'general',
                'rows'        => '3'
            ),
            array(
                'id'          => 'custom_clr',
                'label'       => 'Custom Color Scheme',
                'desc'        => 'Choose a custom color to change the color scheme of your site.',
                'std'         => '',
                'type'        => 'colorpicker',
                'section'     => 'general'
            ),
            array(
                'id'          => 'custom_cjs',
                'label'       => 'Custom Javascript',
                'desc'        => 'Put your custom javascript/jQuery code here. Will be included in Footer.',
                'std'         => '',
                'type'        => 'textarea-simple',
                'section'     => 'general',
                'rows'        => '5'
            ),
            array(
                'id'          => 'custom_css',
                'label'       => 'Custom Styles',
                'desc'        => 'Put your custom CSS code here. Will be included in Header.',
                'std'         => '',
                'type'        => 'textarea-simple',
                'section'     => 'general',
                'rows'        => '5'
            ),

            // Home
            array(
                'id'          => 'home_slider',
                'label'       => 'Home Page Slider',
                'desc'        => 'Create the slide for the slider to show it on Home page template. NOTE: Remove all the slides if you want to hide the slider on home page.',
                'std'         => '',
                'type'        => 'list-item',
                'section'     => 'home',
                'settings'	  => array(
                    array(
                        'id'          => 'img',
                        'label'       => 'Image',
                        'desc'        => 'Upload an image for this slide.',
                        'std'         => '',
                        'type'        => 'upload'
                    ),
                    array(
                        'id'          => 'link',
                        'label'       => 'Link',
                        'desc'        => 'Link/URL for this slide image.',
                        'std'         => '',
                        'type'        => 'text'
                    ),
                )
            ),
            array(
                'id'          => 'home_sections',
                'label'       => 'Home Page Builder',
                'desc'        => 'Build your home page clicking on the Add new button and insert a new section on home page.',
                'std'         => '',
                'type'        => 'list-item',
                'section'     => 'home',
                'settings'	  => array(
                    array(
                        'id'          => 'sec',
                        'label'       => 'Select a Section',
                        'desc'        => 'Choose a section from the drop down to add it on home page. You can reorder the sections on home page by dragging and dropping.',
                        'std'         => '',
                        'type'        => 'select',
                        'choices'     => array(
                            array(
                                'label'       => 'Featured Products',
                                'value'       => 'fp'
                            ),
                            array(
                                'label'       => 'Our Services',
                                'value'       => 'os'
                            ),
                            array(
                                'label'       => 'Latest Work',
                                'value'       => 'lw'
                            ),
                            array(
                                'label'       => 'Brands Logos',
                                'value'       => 'bl'
                            ),
                            array(
                                'label'       => 'Page Contents',
                                'value'       => 'pc'
                            )
                        )
                    )
                )
            ),
            array(
                'id'          => 'our_client_section',
                'label'       => 'Our Clients',
                'desc'        => '',
                'std'         => '',
                'type'        => 'list-item',
                'section'     => 'home',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'settings'    => array(
                    array(
                        'id'          => 'client_logo',
                        'label'       => 'Upload Logo',
                        'desc'        => 'Image dimension: 170px * 100px is prefer.',
                        'std'         => '',
                        'type'        => 'upload',
                        'rows'        => '',
                        'post_type'   => '',
                        'taxonomy'    => '',
                        'class'       => ''
                    ),
                    array(
                        'id'          => 'client_url',
                        'label'       => 'Logo Link',
                        'desc'        => '',
                        'std'         => '#',
                        'type'        => 'text'
                    )
                )
            ),

            // Store
            array(
                'id'          => 'product_slider',
                'label'       => 'Products Slider',
                'desc'        => 'Create slides for products slider. This slider will display on products detail page and products template.',
                'std'         => '',
                'type'        => 'list-item',
                'section'     => 'store',
                'settings'	  => array(
                    array(
                        'id'          => 'img',
                        'label'       => 'Image',
                        'desc'        => 'upload an image.',
                        'std'         => '',
                        'type'        => 'upload'
                    ),
                    array(
                        'id'          => 'link',
                        'label'       => 'Link',
                        'desc'        => 'URL to link the slider image to.',
                        'std'         => '',
                        'type'        => 'text'
                    )
                )
            ),
            array(
                'id'          => 'product_four',
                'label'       => 'Product Four Column',
                'desc'        => 'Product Four Column page link here.',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'store',
            ),
            array(
                'id'          => 'product_three',
                'label'       => 'Product Three Column',
                'desc'        => 'Product Three Column page link here.',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'store',
            ),
            array(
                'label'       => 'Related Product',
                'id'          => 'related_port',
                'type'        => 'radio',
                'std'         => 'ys',
                'desc'        => 'Do you want to show related products on product detail page?.',
                'choices'     => array(
                    array (
                        'label'       => 'Yes',
                        'value'       => 'ys',
                    ),
                    array (
                        'label'       => 'No',
                        'value'       => 'no'
                    ),
                ),
                'section'     => 'store'
            ),
            array(
                'id'          => 'related_port_heading',
                'label'       => 'Related Product Heading',
                'desc'        => 'Heading for related product section on product detail page.',
                'std'         => 'Related Products',
                'type'        => 'text',
                'section'     => 'store',
            ),
            array(
                'label'       => 'Related Product By',
                'id'          => 'related_port_by',
                'type'        => 'radio',
                'std'         => 'wpsc_product_category',
                'desc'        => 'How you want to display the related products?.',
                'choices'     => array(
                    array (
                        'label'       => 'Product Categories',
                        'value'       => 'wpsc_product_category',
                    ),
                    array (
                        'label'       => 'Product Tags',
                        'value'       => 'product_tag'
                    ),
                ),
                'section'     => 'store'
            ),
            array(
                'id'          => 'product_page',
                'label'       => 'Products Per page',
                'desc'        => 'Number of products to display on products page. (Only For: Product 2 Column and Product 3 Column)',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'store',
            ),
            array(
                'id'          => 'product_tab1',
                'label'       => 'Products Tab1 Heading',
                'desc'        => 'Products Tab 1 Heading. (Only For: Product Page)',
                'std'         => 'Tab One',
                'type'        => 'text',
                'section'     => 'store'
            ),
            array(
                'id'          => 'product_tab1_cat',
                'label'       => 'Products Tab1 Category',
                'desc'        => 'Category to display products. (Only For: Product Page)',
                'std'         => '',
                'type'        => 'taxonomy-select',
                'section'     => 'store',
                'taxonomy'    => 'wpsc_product_category',
            ),
            array(
                'id'          => 'product_tab2',
                'label'       => 'Products Tab2 Heading',
                'desc'        => 'Products Tab 2 Heading. (Only For: Product Page)',
                'std'         => 'Tab Two',
                'type'        => 'text',
                'section'     => 'store'
            ),
            array(
                'id'          => 'product_tab2_cat',
                'label'       => 'Products Tab3 Category',
                'desc'        => 'Category to display products. (Only For: Product Page)',
                'std'         => '',
                'type'        => 'taxonomy-select',
                'section'     => 'store',
                'taxonomy'    => 'wpsc_product_category',
            ),
            array(
                'id'          => 'product_tab3',
                'label'       => 'Products Tab3 Heading',
                'desc'        => 'Products Tab 3 Heading. (Only For: Product Page)',
                'std'         => 'Tab Three',
                'type'        => 'text',
                'section'     => 'store'
            ),
            array(
                'id'          => 'product_tab3_cat',
                'label'       => 'Products Tab3 Category',
                'desc'        => 'Category to display products. (Only For: Product Page)',
                'std'         => '',
                'type'        => 'taxonomy-select',
                'section'     => 'store',
                'taxonomy'    => 'wpsc_product_category',
            ),

            // Contact
            array(
                'id'          => 'contact_address_title',
                'label'       => 'Contact Address Title',
                'desc'        => 'Enter the title of the address section.',
                'std'         => '',
                'section'     => 'contact',
                'type'        => 'textarea-simple',
                'rows'        => '2'
            ),
            array(
                'id'          => 'contact_address',
                'label'       => 'Contact Address',
                'desc'        => 'Enter your address here. HTML tags are allowed.',
                'std'         => '',
                'section'     => 'contact',
                'type'        => 'textarea-simple',
                'rows'        => '5'
            ),
            array(
                'id'          => 'contact_form_title',
                'label'       => 'Contact Form Title',
                'desc'        => 'Enter the title of contact form.',
                'std'         => '',
                'section'     => 'contact',
                'type'        => 'textarea-simple',
                'rows'		  => '2'
            ),
            array(
                'id'          => 'contact_form',
                'label'       => 'Contact Form',
                'desc'        => 'Insert the Contact form short-code here.',
                'std'         => '',
                'section'     => 'contact',
                'type'        => 'textarea-simple',
                'rows'		  => '2'
            ),
            array(
                'id'          => 'contact_map_lat',
                'label'       => 'Contact Map Latitude',
                'desc'        => 'Enter the location latitude vale for the map. e.g. 40.716818',
                'std'         => '',
                'section'     => 'contact',
                'type'        => 'text'
            ),
            array(
                'id'          => 'contact_map_lng',
                'label'       => 'Contact Map Longitude',
                'desc'        => 'Enter the location longitude vale for the map. e.g. -74.005451',
                'std'         => '',
                'section'     => 'contact',
                'type'        => 'text'
            ),

            // Portfolio
            array(
                'id'          => 'port_page',
                'label'       => 'Portfolio Per page',
                'desc'        => 'Number of portfolio items to show on a page. (Will not work with Masonry style)',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'portfolio',
            ),
            array(
                'label'       => 'Portfolio layout',
                'id'          => 'port',
                'type'        => 'radio',
                'desc'        => 'Choose portfolio items link style.',
                'choices'     => array(
                    array (
                        'label'       => 'Detail Page',
                        'value'       => 'single_simple',
                    ),
                    array (
                        'label'       => 'Light Box',
                        'value'       => 'light_box'
                    ),
                ),
                'section'     => 'portfolio'
            ),

        )
    );

    $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );

    if ( $saved_settings !== $custom_settings ) {
        update_option( 'option_tree_settings', $custom_settings );
    }

}