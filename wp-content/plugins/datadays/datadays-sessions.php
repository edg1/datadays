<?php

/**
 * Data Days 2014
 *
 * License: GPL2
 * Author: Thimo Thoeye
 *
 */


 function dd_sessions_register() {
	register_post_type('dd-session',
		array(
			'labels' => array(
			'name'			=> __('Sessions', 'dd'),
			'singular_name' => __('Session', 'dd'),
			'add_new'		=> __('Add new', 'ait'),
			'add_new_item'	=> __('Add new session', 'dd'),
			'edit_item'		=> __('Edit session', 'dd'),
			'new_item'		=> __('New item', 'dd'),
			'view_item'		=> __('View program', 'dd'),
			'search_items'	=> __('Search session', 'dd'),
			'not_found'		=> __('Nothing found', 'dd'),
			'not_found_in_trash' => __('Nothing found in Trash', 'dd'),
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'show_in_nav_menus' => true,
		'rewrite' => array('slug' => 'session'),
		'supports' => array('title', 'page-attributes'),
		'menu_icon' => plugins_url( 'images/dd_conference_icon.png' , __FILE__ ),
		)
	);

  /*
  ,
  'menu_position' => $GLOBALS['aitThemeCustomTypes']['program'],
  */
	dd_sessions_taxonomies();
	flush_rewrite_rules(false);
}



function dd_sessions_taxonomies()
{

	register_taxonomy( 'dd-session-day', array( 'dd-session' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Program Days', 'taxonomy general name', 'dd'),
			'singular_name' => _x( 'Day', 'taxonomy singular name', 'dd'),
			'search_items'	=> __( 'Search Day', 'dd'),
			'all_items'		=> __( 'All Days', 'dd'),
			'parent_item'	=> __( 'Parent Day', 'dd'),
			'parent_item_colon' => __( 'Parent Day:', 'dd'),
			'edit_item'		=> __( 'Edit Day', 'dd'),
			'update_item'	=> __( 'Update Day', 'dd'),
			'add_new_item'	=> __( 'Add New Day', 'dd'),
			'new_item_name' => __( 'New Day Name', 'dd'),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'day'),
	));

	register_taxonomy( 'dd-session-location', array( 'dd-session' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Conference Locations', 'taxonomy general name', 'dd'),
			'singular_name' => _x( 'Location', 'taxonomy singular name', 'dd'),
			'search_items'	=> __( 'Search Location', 'dd'),
			'all_items'		=> __( 'All Locations', 'dd'),
			'parent_item'	=> __( 'Parent Location', 'dd'),
			'parent_item_colon' => __( 'Parent Location:', 'dd'),
			'edit_item'		=> __( 'Edit Location', 'dd'),
			'update_item'	=> __( 'Update Location', 'dd'),
			'add_new_item'	=> __( 'Add New Location', 'dd'),
			'new_item_name' => __( 'New Location Name', 'dd'),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'day'),
	));

	// add uncategorized term
	if(!term_exists( 'Uncategorized', 'dd-session-day' )){
		wp_insert_term( 'Uncategorized', 'dd-session-day' );
	}

	if(!term_exists( 'Uncategorized', 'dd-session-location' )){
		wp_insert_term( 'Uncategorized', 'dd-session-day' );
	}
}
add_action( 'init', 'dd_sessions_register' );


/*function aitprogramFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-program', 'side' );
	add_meta_box('postimagediv', __('Medium (blog) image', 'ait'), 'post_thumbnail_meta_box', 'ait-program', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitprogramFeaturedImageMetabox');

*/

function dd_sessions_columns($cols)
{
	$cols = array(
		'cb'         => '<input type="checkbox" />',
		'title'      => __( 'Theme Name', 'dd'),
		'description'=> __( 'Description', 'dd'),
		'time'       => __( 'Time', 'dd'),
		'speaker'    => __( 'Speaker', 'dd'),
		'menu_order' => __( 'Order', 'dd'),
	);

  return $cols;
}
add_filter( "manage_dd-session_posts_columns", "dd_sessions_columns");



function dd_sessions_boxes() {
	add_meta_box(
	  'time_box',
	   __('Time', 'dd'), 
	   'dd_sessions_time_box_content', 
	   'dd-session', 
	   'side', 
	   'high'
  );
  add_meta_box( 
    'description_box',
    __( 'Description', 'dd' ),
    'dd_sessions_description_box_content',
    'dd-session',
    'normal',
    'high'
  );
	add_meta_box( 
    'speaker_box',
    __( 'Speaker', 'dd' ),
    'dd_sessions_speaker_box_content',
    'dd-session',
    'normal',
    'high'
  );
	
}

add_action('do_meta_boxes', 'dd_sessions_boxes');

function dd_sessions_description_box_content($post) {
  wp_nonce_field( plugin_basename(__FILE__ ), 'dd_sessions_description_box_content_nonce' );
	echo '<label for="description"></label>';
	$biography = get_post_meta($post->ID, 'description', true);
  wp_editor($biography, 'description', array(
    'wpautop'       =>      true,
    'media_buttons' =>      false,
    'textarea_name' =>      'description',
    'textarea_rows' =>      10,
    'teeny'                 =>      true
  ));
  if (isset($_POST['description']) && $_POST['description'] != '') {
    update_post_meta($post->ID, 'description', $_POST['description']);
  }
}

function dd_sessions_time_box_content($post) {
  wp_nonce_field( plugin_basename(__FILE__ ), 'dd_sessions_time_box_content_nonce' );
	echo '<label for="time"></label>';
	$time = get_post_meta($post->ID, 'time', true);
  echo '<input type="text" id="time" name="time" placeholder="09:00-10:00" value="' . $time . '" />';
  if (isset($_POST['time']) && $_POST['time'] != '') {
    update_post_meta($post->ID, 'time', $_POST['time']);
  }
}


function dd_sessions_speaker_box_content($post) {
  $parents = get_posts(
    array(
      'post_type'   => 'dd-speaker', 
      'orderby'     => 'title', 
      'order'       => 'ASC', 
    )
  );

  if (!empty($parents)) {
    echo '<select name="parent_id" class="widefat">'; // !Important! Don't change the 'parent_id' name attribute.
    foreach ($parents as $parent) {
        printf( '<option value="%s"%s>%s</option>', esc_attr( $parent->ID ), selected( $parent->ID, $post->post_parent, false ), esc_html( $parent->post_title ) );
    }
    echo '</select>';
  }
}


/**
 * Save the content of the biography field upon submission
 */
 
add_action('save_post', 'dd_sessions_description_box_save', 10, 2);
add_action('save_post', 'dd_sessions_time_box_save', 10, 2);

function dd_sessions_description_box_save($post_id) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
	  return;

	if (array_key_exists('dd_sessions_description_box_content_nonce', $_POST) && 
	    !wp_verify_nonce($_POST['dd_sessions_description_box_content_nonce'], plugin_basename(__FILE__))) {
	    	die('bad nonce');
	  return;
  }

	if (array_key_exists('post_type', $_POST) && 'page' == $_POST['post_type']) {
		if (!current_user_can( 'edit_page', $post_id))
		return;
	} else {
		if (!current_user_can( 'edit_post', $post_id))
		return;
	}
	$value = array_key_exists('description', $_POST) ? $_POST['description'] : false;
	update_post_meta($post_id, 'description', $value);

}


function dd_sessions_time_box_save($post_id) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
	  return;

	if (array_key_exists('dd_sessions_time_box_content_nonce', $_POST) && 
	    !wp_verify_nonce($_POST['dd_sessions_time_box_content_nonce'], plugin_basename(__FILE__))) {
	    	die('bad nonce');
	  return;
  }

	if (array_key_exists('post_type', $_POST) && 'page' == $_POST['post_type']) {
		if (!current_user_can( 'edit_page', $post_id))
		return;
	} else {
		if (!current_user_can( 'edit_post', $post_id))
		return;
	}
	$value = array_key_exists('time', $_POST) ? $_POST['time'] : false;
	update_post_meta($post_id, 'time', $value);
}



/*************************************
 * Shortcode for outputting a program
 *************************************/

function dd_sessions() {
  $overview = array();
	$sessions = array();
	$days = get_terms('dd-session-day');

	// sort loops
	$counter = 0;
	foreach ($days as $day) {
		$sessions = get_posts(array(
		  'post_type' => 'dd-session',
		  'post_status' => 'publish',
		  'tax_query' => array(
				array(
  		    'taxonomy' => 'dd-session-day',
  		    'field' => 'slug',
  		    'terms' => $day->slug
				)
      ),
		  'posts_per_page' => -1,
		  'ignore_sticky_posts'=> 1,
		  'orderby' => 'menu_order'
		  )
		);

		foreach($sessions as $session) {
			$halls = wp_get_post_terms($session->ID, 'dd-session-location');
			foreach ($halls as $hall) {
				$overview[$day->name][$hall->name][$counter]['title'] = get_the_title($session->ID);
				$overview[$day->name][$hall->name][$counter]['speaker'] = get_post_meta($session->ID, 'speaker');
				$overview[$day->name][$hall->name][$counter]['time'] = get_post_meta($session->ID, 'time');
			}
			$counter++;
		}
	}
	
	$output = '';
	foreach ($overview as $day => $program) {
	  $output .= '<div class="row">';
  	$output .= '<div class="col-md-12 session session-day">' . $day . '</div>';
  	$output .= '</div>';

  	$output .= '<div class="row session-halls">';
  	
  	foreach($program as $hall => $sessions) {
    	$output .= '<div class="col-md-3 col-sm-6 session-hall-container">';
    	
    	$output .= '<div class="session session-hall">' . $hall . '</div>';
    	
    	$output .= '<div class="session session-single">';
      foreach ($sessions as $session) {
        $output .= '<div class="session-time">' . reset($session['time']) . '</div>';
        $output .= '<div class="session-title">' . $session['title'] . '</div>';   
      } 
      $output .= '</div>';
      $output .= '</div>';
       	  	
  	}
  	
  	$output .= '</div>';
	}
	
	return $output;
	
}

add_shortcode('sessions', 'dd_sessions');


/*
 DEPERECTATED

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

*/