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
			'view_item'		=> __('View session', 'dd'),
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

	dd_sessions_taxonomies();
	flush_rewrite_rules(false);
}
add_filter( 'template_include', 'dd_sessions_view', 1 );

function dd_sessions_view($template_path) {
  //$template_path = false;
    if ( get_post_type() == 'dd-session' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'archive-dd_session.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/archive-dd_session.php';
            }
        }
    }
    return $template_path;
}


function dd_sessions_taxonomies() {

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
  wp_nonce_field( plugin_basename(__FILE__ ), 'dd_sessions_speaker_box_content_nonce' );
  $parents = array();
  
  /*
  $parents = get_posts(
    array(
      'post_type'   => 'dd-speaker', 
      'orderby'     => 'title', 
      'order'       => 'ASC', 
    )
  );
  */
  
  $args = array(
    'post_type' => 'dd-speaker',
    'posts_per_page'=> -1,
    'ignore_sticky_posts'=>1,
    'orderby'     => 'title', 
    'order'       => 'ASC', 
  );
  
  $my_query = new WP_Query($args);
  if( $my_query->have_posts() ) {
      $parents = $my_query->get_posts();
  }
  $speaker = get_post_meta($post->ID, 'speaker', true);
  $speaker = explode(';', $speaker);
  if (!empty($parents)) {
    $i = 0;
    foreach ($parents as $parent) {
      $selected = (in_array($parent->ID, $speaker)) ? 'checked' : '';
      print '<div>';
      printf( '<input type="checkbox" name="%s" value="%s" %s></input>', "speaker_" . $i, esc_attr( $parent->ID ), $selected);
      print('<label for="speaker_' . $i . '"> ' . esc_html( $parent->post_title ) . '</label>');
      print '</div>';
      $i++;
    }
  }
  if (isset($_POST['speaker']) && $_POST['speaker'] != '') {
    update_post_meta($post->ID, 'speaker', $_POST['speaker']);
  }
}


/**
 * Save the content of the biography field upon submission
 */
 
add_action('save_post', 'dd_sessions_description_box_save', 10, 2);
add_action('save_post', 'dd_sessions_time_box_save', 10, 2);
add_action('save_post', 'dd_sessions_speaker_box_save', 10, 2);

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

function dd_sessions_speaker_box_save($post_id) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
	  return;
	  
	if (array_key_exists('dd_sessions_speaker_box_content_nonce', $_POST) && 
	    !wp_verify_nonce($_POST['dd_sessions_speaker_box_content_nonce'], plugin_basename(__FILE__))) {
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
	$speakerstr = "";
	foreach ($_POST as $key => $value) {
  	if (strlen($key) > strlen('speaker') && substr($key, 0, 7) == "speaker") {
    	$speakerstr .= $value . ';';
  	}
	}
	update_post_meta($post_id, 'speaker', $speakerstr);
}



/*************************************
 * Shortcode for outputting a program
 *************************************/

function dd_sessions($atts) {
  $overview = array();
  $slotsize = 15;
  extract( shortcode_atts( array(
		'day' => false,
	), $atts, 'dd' ) );
	$day_slug = $day;
	
	// Getting the $days
	$days = array();
	if (!$day) {
  	$days = get_terms('dd-session-day');
	} else {
  	$days = array();
  	$day = get_term_by('slug', $day, 'dd-session-day');
  	if ($day) {
    	$days[] = $day;
  	}
	}
	
	// sort loops
	$counter = 0;
	$programme = array();
	$first = null;
	foreach ($days as $day) {
	  $overview[$day->name] = array();
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
		$earliest = null;
		foreach($sessions as $session) {
			$halls = wp_get_post_terms($session->ID, 'dd-session-location');
			if (count($halls) < 1) {
  			continue;
			}
			foreach($halls as $hall) {
			  $time = explode('-', reset(get_post_meta($session->ID, 'time')));
        if (count($time) == 2) {
          $slots = calculate_slots($time[0], $time[1]);
          $overview[$day->name][$hall->name][$time[0]] = array(
            'title' => get_the_title($session->ID),
            'slots' => $slots,
            'hall' => $hall->name,
            'start' => $time[0],
            'end' => $time[1],
            'link' => get_permalink($session->ID),
          );
        }
      }  
		}
		foreach ($overview[$day->name] as $hallname => $sessions) {
		  ksort($overview[$day->name][$hallname]);
		}
	}

	//print_r($overview);
	
	$output = '';
	foreach ($overview as $day => $halls) {
  $output .= '<div class="row container">';
  $output .= '<div class="col-md-12 session session-day"><h3>' . $day . '</h3></div>';
  $output .= '</div>';



    // Shift plenary to first location
    if (array_key_exists('Plenary', $halls)) {
      $plenary = $halls['Plenary'];
      unset($halls['Plenary']);
      if ($day_slug != 'open-world-2') {
        $halls = array('Plenary' => $plenary) + $halls;
      } else {
        $halls = $halls + array('Plenary' => $plenary);
      }
    }

    // Find earliest session of the day
    $firstsession = '23:00';
    foreach($halls as $hall => $sessions) {
      if ($hall != 'Plenary' && (count($sessions) > 0)) {
        $f = reset(array_keys($sessions));
        if ($f < $firstsession)
          $firstsession = $f;
      }
    }
    
    
    foreach($halls as $hall => $sessions) {  
      
  	  $colsize = 'col-md-3 col-sm-6';
  	  if ($hall == 'Plenary') {
  	    $colsize =  'col-md-12';
  	  } else if ($hall == 'Open World') {
    	  $colsize = 'col-md-6 clearfix';
  	  }
  	  
  	  $output .= '<div class="' . $colsize . ' session-hall-container">';
      $output .= '<div class="session session-hall">' . $hall . '</div>';
      
      $output .= '<div class="session session-single">';
      $first = 'first';
      $previous = array('end' => $firstsession);
      foreach ($sessions as $session) {
        $extra = ($session['title'] == 'Coffee' || $session['title'] == 'Lunch' || $session['title'] == 'Walking dinner') ? 'mute' : '';
        // Create invalidated space
        if ($hall != 'Plenary' && ($previous['end'] != $session['start'])) {
          $spaceslots = calculate_slots($previous['end'], $session['start']);
          $output .= '<a href="" alt="Free space" class="session-slots-' . $spaceslots . ' ' . $first . ' mutehard"></a>';
        }
        // Create actual session link
        $output .= '<a href="' . $session['link'] . '" alt="Session details" class="session-slots-' . $session['slots'] . ' ' . $first . ' '  . $extra . '">';
        if ($extra != 'mute') {
          $output .= '<div class="session-button glyphicon glyphicon-play">&nbsp;</div>';
        }
        $output .= '<div class="session-time">' . $session['start'] . '</div>';
        $title = (strlen($session['title']) > 73) ? substr($session['title'],0,70).'...' : $session['title'];
        $output .= '<div class="session-title">' . $title . '</div>';   
        
        $output .= '</a>';
        if ($first != '')
          $first = '';
        $previous = $session;
      }
      $output .= '</div>';
      $output .= '</div>';
      if ($hall == 'Plenary') {
  	    $output .= '</div>';
  	  }   
    }
    $output .= '</div>';
  }
  	
  $output .= '</div>';
  
  return $output;
	
}

function calculate_slots($start, $end) {
  $slotsize = 15;
  $a = new DateTime($start);
  $b = new DateTime($end);
  $interval = $a->diff($b);
  $minutes = intval($interval->format('%H')) * 60 + intval($interval->format('%i'));
  $slots = floor($minutes / $slotsize);
  return $slots;
}
function renderhall($hall, $overview) {
  
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