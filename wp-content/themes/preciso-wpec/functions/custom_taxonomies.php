<?php
/*
 *	Custom Taxonomies
 * 	---------------------------------------------------------------------------
 * 	@package	: Pixelart Themes Framework
 *	@author 	: Umair
 *	@version	: 2.0
 *	@link		: http://www.pixelartinc.com
 *	@copyright	: Copyright (c) 2013, http://www.pixelartinc.com
 *	--------------------------------------------------------------------------- */

function pixelart_taxonomies()
{

    $portfolio_labels = array(
        'name' => 'Categories',
        'singular_name' => 'Category',
        'search_items' =>  'Search Categories',
        'all_items' => 'All Categories',
        'parent_item' => 'Parent Categories',
        'parent_item_colon' => 'Parent Categories:',
        'edit_item' => 'Edit Categories',
        'update_item' => 'Update Categories',
        'add_new_item' => 'Add New Category',
        'new_item_name' => 'New Categories',
        'menu_name' => 'Categories',
    );
    $portfolio_args = array(
        'hierarchical' => true,
        'labels' => $portfolio_labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'portfolio-categories' ),
    );
    register_taxonomy('portfolio-categories', 'portfolio', $portfolio_args);

}
add_action( 'init', 'pixelart_taxonomies', 0 );