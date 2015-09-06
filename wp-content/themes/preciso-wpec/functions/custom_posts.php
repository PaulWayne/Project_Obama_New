<?php
/*
 *	Custom Post Types
 * 	---------------------------------------------------------------------------
 * 	@package	: Pixelart Themes Framework
 *	@author 	: Umair
 *	@version	: 2.0
 *	@link		: http://www.pixelartinc.com
 *	@copyright	: Copyright (c) 2013, http://www.pixelartinc.com
 *	--------------------------------------------------------------------------- */

function pixelart_custom_post_type()
{


    $services_labels = array(
        'name' => 'Services',
        'singular_name' => 'Services',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Services',
        'edit_item' => 'Edit Services',
        'new_item' => 'New Services',
        'view_item' => 'View Services',
        'search_items' => 'Search Services',
        'not_found' =>  'No Services found',
        'not_found_in_trash' => 'No Services in Trash',
        'parent_item_colon' => ''
    );
    $services_supports = array(
        'title',
        'editor',
        'thumbnail',
    );
    $services_args = array(
        'labels' => $services_labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'services' ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => $services_supports
    );
    register_post_type('services', $services_args);


    $portfolio_labels = array(
        'name' => 'Portfolio',
        'singular_name' => 'Portfolio',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Portfolio',
        'edit_item' => 'Edit Portfolio',
        'new_item' => 'New Portfolio',
        'view_item' => 'View Portfolio',
        'search_items' => 'Search Portfolio',
        'not_found' =>  'No Portfolio found',
        'not_found_in_trash' => 'No Portfolio in Trash',
        'parent_item_colon' => ''
    );
    $portfolio_supports = array(
        'title',
        'editor',
        'thumbnail',
    );
    $portfolio_args = array(
        'labels' => $portfolio_labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'portfolio' ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => $portfolio_supports
    );
    register_post_type('portfolio', $portfolio_args);


    $team_labels = array(
        'name' => 'Team',
        'singular_name' => 'Team',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Team',
        'edit_item' => 'Edit Team',
        'new_item' => 'New Team',
        'view_item' => 'View Team',
        'search_items' => 'Search Team',
        'not_found' =>  'No Team found',
        'not_found_in_trash' => 'No Team in Trash',
        'parent_item_colon' => ''
    );
    $team_supports = array(
        'title',
        'editor',
        'thumbnail',
    );
    $team_args = array(
        'labels' => $team_labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'team' ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => $team_supports
    );
    register_post_type('team', $team_args);


}
add_action( 'init', 'pixelart_custom_post_type' );