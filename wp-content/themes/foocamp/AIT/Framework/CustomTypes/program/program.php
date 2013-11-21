<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2013, AIT s.r.o (http://ait-themes.com)
 *
 */


 function aitProgramPostType()
 {
	register_post_type('ait-program',
		array(
			'labels' => array(
			'name'			=> __('Program', 'ait'),
			'singular_name' => __('Program', 'ait'),
			'add_new'		=> __('Add new', 'ait'),
			'add_new_item'	=> __('Add new item', 'ait'),
			'edit_item'		=> __('Edit item', 'ait'),
			'new_item'		=> __('New item', 'ait'),
			'view_item'		=> __('View program', 'ait'),
			'search_items'	=> __('Search program', 'ait'),
			'not_found'		=> __('Nothing found', 'ait'),
			'not_found_in_trash' => __('Nothing found in Trash', 'ait'),
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'show_in_nav_menus' => true,
		'rewrite' => array('slug' => 'program'),
		'supports' => array('title', 'page-attributes'),
		'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/program/program.png',
		'menu_position' => $GLOBALS['aitThemeCustomTypes']['program'],
		)
	);

	aitProgramTaxonomies();

	flush_rewrite_rules(false);
}



function aitProgramTaxonomies()
{

	register_taxonomy( 'ait-program-day', array( 'ait-program' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Program Days', 'taxonomy general name', 'ait'),
			'singular_name' => _x( 'Day', 'taxonomy singular name', 'ait'),
			'search_items'	=> __( 'Search Day', 'ait'),
			'all_items'		=> __( 'All Days', 'ait'),
			'parent_item'	=> __( 'Parent Day', 'ait'),
			'parent_item_colon' => __( 'Parent Day:', 'ait'),
			'edit_item'		=> __( 'Edit Day', 'ait'),
			'update_item'	=> __( 'Update Day', 'ait'),
			'add_new_item'	=> __( 'Add New Day', 'ait'),
			'new_item_name' => __( 'New Day Name', 'ait'),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'day'),
	));

	register_taxonomy( 'ait-program-location', array( 'ait-program' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Program Locations', 'taxonomy general name', 'ait'),
			'singular_name' => _x( 'Location', 'taxonomy singular name', 'ait'),
			'search_items'	=> __( 'Search Location', 'ait'),
			'all_items'		=> __( 'All Locations', 'ait'),
			'parent_item'	=> __( 'Parent Location', 'ait'),
			'parent_item_colon' => __( 'Parent Location:', 'ait'),
			'edit_item'		=> __( 'Edit Location', 'ait'),
			'update_item'	=> __( 'Update Location', 'ait'),
			'add_new_item'	=> __( 'Add New Location', 'ait'),
			'new_item_name' => __( 'New Location Name', 'ait'),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'day'),
	));

	// add uncategorized term
	if(!term_exists( 'Uncategorized', 'ait-program-day' )){
		wp_insert_term( 'Uncategorized', 'ait-program-day' );
	}

	if(!term_exists( 'Uncategorized', 'ait-program-location' )){
		wp_insert_term( 'Uncategorized', 'ait-program-day' );
	}
}
add_action( 'init', 'aitProgramPostType' );

$programOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-program',
	'title' => 'Theme Options',
	'types' => array('ait-program'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon'
));

/*function aitprogramFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-program', 'side' );
	add_meta_box('postimagediv', __('Medium (blog) image', 'ait'), 'post_thumbnail_meta_box', 'ait-program', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitprogramFeaturedImageMetabox');*/

function aitprogramChangeColumns($cols)
{
	$cols = array(
		'cb'         => '<input type="checkbox" />',
		'title'      => __( 'Theme Name', 'ait'),
		'menu_order' => __( 'Order', 'ait'),
	);

  return $cols;
}
add_filter( "manage_ait-program_posts_columns", "aitprogramChangeColumns");



function aitprogramCustomColumns($column, $post_id)
{
	global $programOptions;
	$options = $programOptions->the_meta();
}
add_action( "manage_posts_custom_column", "aitprogramCustomColumns", 10, 2 );

function aitprogramSortableColumns()
{
	return array(
		'title'      => 'title',
		'category'   => 'category',
		'menu_order' => 'order',
	);
}
add_filter( "manage_edit-ait-program_sortable_columns", "aitprogramSortableColumns" );