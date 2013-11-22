<?php
/**
 * Plugin Name: Data Days 
 * Plugin URI: http://ed.be
 * Description: A plugin that allows easy conference management, originally designed for Data Days 2014
 * Version: 0.1
 * Author: Thimo Thoeye, Edward Geers
 * Author URI: http://ed.be
 * License: GPL2
 */

/** Step 2 (from text above). */
add_action( 'admin_menu', 'dd_menu' );

/** Step 1. */
function dd_menu() {
  add_menu_page( "Conference Settings", "Conference", "manage_options", "dd-conference", "dd_conference_options", plugins_url( 'images/dd_conference_icon.png' , __FILE__ ));
	//add_submenu_page( 'dd-conference', 'Conference Speakers', 'Speakers', 'manage_options', 'dd-speakers', 'dd_speakers_options');
}

function dd_conference_options() {
  if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}

/** Step 3. */
function dd_speakers_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}


/**
 * Common functionality to save a meta box
 **/
 
function dd_save_box($post_id, $box_id, $nonce, $origin) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
	  return;

	if (array_key_exists($nonce, $_POST) && 
	    !wp_verify_nonce($_POST[$nonce], $origin)) {
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
	$value = array_key_exists($box_id, $_POST) ? $_POST[$box_id] : false;
	update_post_meta($post_id, $box_id, $value);

}




include('datadays-speakers.php');
include('datadays-sessions.php');

?>