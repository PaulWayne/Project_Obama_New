<?php

add_filter( 'rwmb_meta_boxes', 'YOUR_PREFIX_register_meta_boxes' );

function YOUR_PREFIX_register_meta_boxes( $meta_boxes )
{

    $meta_boxes[] = array(
        'id'        => 'portfolio-gallery',
        'title'     => __('Gallery', PIXELART),
        'pages'     => array( 'portfolio', 'blog' ),
        'context'   => 'normal',
        'priority'  => 'high',
        'autosave'  => true,
        'fields'    => array(
            array(
                    'name'             => __('Upload Images', PIXELART),
                    'id'               => "pimages",
                    'type'             => 'plupload_image',
                    'max_file_uploads' => 10
            )
        )
    );

    $meta_boxes[] = array(
        'id'        => 'product-options',
        'title'     => __( 'Product Options', PIXELART ),
        'pages'     => array( 'wpsc-product' ),
        'context'   => 'normal',
        'priority'  => 'high',
        'autosave'  => true,
        'fields'    => array(
            array(
                'name'        => __('Product Label', PIXELART),
                'id'          => 'product_label',
                'desc'        => '',
                'type'        => 'radio',
                'options'     => array(
                    'new'       => __('New', PIXELART),
                    'sell'      => __('Sell', PIXELART ),
                    'none'      => __('None', PIXELART )
                )
            )
        )
    );

    return $meta_boxes;

}
