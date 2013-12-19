<?php

/**
 * Data Days 2014 Speakers Submodule
 *
 * License: GPL2
 * Author: Thimo Thoeye
 *
 */
 
/********************************
 * Custom Post Type Speaker
 ********************************/

function dd_speakers_register() {
	register_post_type( 'dd-speaker',
		array(
			'labels' => array(
				'name'			=> __('Speaker', 'dd'),
				'singular_name' => __('speaker', 'dd'),
				'add_new'		=> __('Add new speaker', 'dd'),
				'add_new_item'	=> __('Add new speaker', 'dd'),
				'edit_item'		=> __('Edit speaker', 'dd'),
				'new_item'		=> __('New speaker', 'dd'),
				'view_item'		=> __('View speaker', 'dd'),
			  'search_items'	=> __('Search speakers', 'dd'),
				'not_found'		=> __('No speakers found', 'dd'),
				'not_found_in_trash' => __('No speakers found in Trash', 'dd'),
				'menu_name'		=> __('Speakers', 'dd'),
			),
			'description' => __('Manage speakers', 'dd'),
			'public' => true,
			'show_in_nav_menus' => false,
			'has_archive' => true,
			'supports' => array(
				'title',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => plugins_url( 'images/dd_conference_icon.png' , __FILE__ ),
		)
	);
	dd_speakers_taxonomies();
}

function dd_speakers_taxonomies()
{

	register_taxonomy('dd-speaker-category', array('dd-speaker'), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Organization', 'taxonomy general name', 'dd'),
			'singular_name' => _x( 'Organization', 'taxonomy singular name', 'dd'),
			'search_items'	=> __( 'Search Organization', 'dd'),
			'all_items'		=> __( 'All Organizations', 'dd'),
			'parent_item'	=> __( 'Parent Organization', 'dd'),
			'parent_item_colon' => __( 'Parent Organization:', 'dd'),
			'edit_item'		=> __( 'Edit Organization', 'dd'),
			'update_item'	=> __( 'Update Organization', 'dd'),
			'add_new_item'	=> __( 'Add New Organization', 'dd'),
			'new_item_name' => __( 'New Organization Name', 'dd'),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'dd-speaker-category' ),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized', 'dd-speaker-category' )){
		wp_insert_term( 'Uncategorized', 'dd-speaker-category' );
	}
}

add_action( 'init', 'dd_speakers_register' );

function dd_speakers_add_columns($cols) {
	$newcols = array(
		'cb'            => '<input type="checkbox" />',
		'thumbnail'     => __( 'Photo', 'dd'),
		'title'         => __( 'Name', 'dd'),
		'bio'           => __( 'Short Biography', 'dd'),
		'biography'     => __( 'Biography', 'dd'),
		'organization'  => __( 'Organization', 'dd'),
		'menu_order'    => __( 'Order', 'dd'),
	);

	return array_merge($cols, $newcols);
}
add_filter( "manage_dd-speaker_posts_columns", "dd_speakers_add_columns");

function dd_speakers_custom_column($column, $post_id) {
	switch ($column) {
		case "bio":
		  $biography = get_post_meta( $post_id , 'bio' , true ); 
			if($biography){
				echo "<p>".$biography."</p>";
			}
			break;
		case "organization":
		  $organization = get_post_meta( $post_id , 'organization' , true ); 
			if($organization){
				echo "<p>".$organization."</p>";
			}
			break;
	}
}
add_action( "manage_posts_custom_column", "dd_speakers_custom_column", 10, 2);



add_filter( 'template_include', 'dd_speakers_view', 1 );
function dd_speakers_view($template_path) {
  //$template_path = false;
    if ( get_post_type() == 'dd-speaker' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'archive-dd_speaker.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/archive-dd_speaker.php';
            }
        }
    }
    return $template_path;
}

/**
 *
 * This section contains actions to view and edit
 * the custom "dd-speaker" Post Type.
 * 
 * More info: http://wp.smashingmagazine.com/2012/11/08/complete-guide-custom-post-types/
 *
 */

/********************************
 * Custom Column Meta Boxes
 ********************************/

function dd_speakers_boxes() {
	remove_meta_box( 'postimagediv', 'dd-speakers-box', 'side' );
	add_meta_box(
	  'postimagediv',
	   __('Picture', 'dd'), 
	   'post_thumbnail_meta_box', 
	   'dd-speaker', 
	   'normal', 
	   'high'
  );
  add_meta_box( 
    'speakers_bio_box',
    __( 'Short Biography', 'dd' ),
    'dd_speakers_bio_box_content',
    'dd-speaker',
    'normal',
    'high'
  );
	add_meta_box( 
    'speakers_biography_box',
    __( 'Speaker Biography', 'dd' ),
    'dd_speakers_biography_box_content',
    'dd-speaker',
    'normal',
    'high'
  );
	
}

add_action('do_meta_boxes', 'dd_speakers_boxes');



/**
 * Display a text editor for speakers biography
 */
 
function dd_speakers_biography_box_content($post) {
  wp_nonce_field( plugin_basename(__FILE__ ), 'dd_speakers_biography_box_content_nonce' );
	echo '<label for="speaker_biography"></label>';
	$biography = get_post_meta($post->ID, 'biography', true);
  wp_editor($biography, 'biography', array(
    'wpautop'       =>      true,
    'media_buttons' =>      false,
    'textarea_name' =>      'biography',
    'textarea_rows' =>      10,
    'teeny'                 =>      true
  ));
  if (isset($_POST['biography']) && $_POST['biography'] != '') {
    update_post_meta($post->ID, 'biography', $_POST['biography']);
  }
}

function dd_speakers_bio_box_content($post) {
  wp_nonce_field( plugin_basename(__FILE__ ), 'dd_speakers_bio_box_content_nonce' );
	echo '<label for="speaker_bio"></label>';
	$bio = get_post_meta($post->ID, 'bio', true);
  echo '<input type="text" class="widefat" id="bio" name="bio" placeholder="Enter short biography" value="' . $bio . '" />';
  if (isset($_POST['bio']) && $_POST['bio'] != '') {
    update_post_meta($post->ID, 'bio', $_POST['bio']);
  }
}


/**
 * Save the content of the biography field upon submission
 */
 
add_action('save_post', 'dd_speakers_biography_box_save', 10, 2);
add_action('save_post', 'dd_speakers_bio_box_save', 10, 2);

function dd_speakers_biography_box_save($post_id) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
	  return;

	if (array_key_exists('dd_speakers_biography_box_content_nonce', $_POST) && 
	    !wp_verify_nonce($_POST['dd_speakers_biography_box_content_nonce'], plugin_basename( __FILE__ ))) {
	  return;
  }

	if (array_key_exists('post_type', $_POST) && 'page' == $_POST['post_type']) {
		if (!current_user_can( 'edit_page', $post_id))
		return;
	} else {
		if (!current_user_can( 'edit_post', $post_id))
		return;
	}
	$bio = array_key_exists('biography', $_POST) ? $_POST['biography'] : false;
	update_post_meta($post_id, 'biography', $bio);
}

function dd_speakers_bio_box_save($post_id) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
	  return;

	if (array_key_exists('dd_speakers_bio_box_content_nonce', $_POST) && 
	    !wp_verify_nonce($_POST['dd_speakers_bio_box_content_nonce'], plugin_basename( __FILE__ ))) {
	  return;
  }

	if (array_key_exists('post_type', $_POST) && 'page' == $_POST['post_type']) {
		if (!current_user_can( 'edit_page', $post_id))
		return;
	} else {
		if (!current_user_can( 'edit_post', $post_id))
		return;
	}
	$bio = array_key_exists('bio', $_POST) ? $_POST['bio'] : false;
	update_post_meta($post_id, 'bio', $bio);
}


/********************************
 * Speakers Shortcode
 ********************************/
 
 function dd_speakers_shortcode($params) {
    extract(shortcode_atts(array(
        'number' => '0',
        'icons' => '1'
    ), $params ) );

    $result = '';
    $speakers = query_posts(array('post_type' => 'dd-speaker', 'orderby' => 'menu_order', 'order' => 'DESC', 'posts_per_page' => $number));

    $counter = 1;
    $result .= '<div class="speakers row">';
    foreach($speakers as $speaker){
      if ($speaker->post_title == "")
        continue;
      $result .= '<div class="speaker col-xs-12 col-sm-6 col-md-3">';
      $result .= dd_speakers_render_speaker($speaker);
      $result .= '</div>';
      //$result .= '</div>';
  }
  $result .= '</div>';
  wp_reset_query();

  return $result;
}

add_shortcode( "speakers", "dd_speakers_shortcode" );

function dd_speakers_render_speaker($speaker) {
  $result = '';
  $thumbnail = get_permalink($speaker->ID);

  $result .= '<div class="speaker-header">';

  
  if (has_post_thumbnail($speaker->ID)) {
    $result .= '<div class="speaker-pic">';
    $result .= '<a href="'. $thumbnail .'" class="speaker-img">' . get_the_post_thumbnail($speaker->ID, array(75, 75)) . '</a>';
    $result .= '</div>';
  } else {
    //$result .= '<div class="nothumb"></div>';
  }
  

  $result .= '<div class="speaker-title">';
  $result .= '<h3>' . $speaker->post_title . '</h3>';
  $org = reset(wp_get_post_terms($speaker->ID, 'dd-speaker-category'));
  if ($org) {
    $result .= '<span>' . $org->name . '</span>';
  }
  $result .= '</div>';
  $result .= '</div>';
  $result .= '<p><span>' . get_post_meta($speaker->ID, 'bio', true) . '</span></p>';

  return $result;
}

?>