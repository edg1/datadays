<?php
/**
 * @package tickee-widget
 * @version 0.1.1
 */
/*
Plugin Name: Tickee Widget Plugin
Plugin URI: http://tick.ee/
Description: This is the Tickee Widget hook.
Author: Koen Betsens
Version: 0.1.1
Author URI: http://tick.ee/
*/



/**	
 * The default Tickee Widget result (if there is one).
 *
 * <code>
 * echo tickee();
 * </code>
 *
 * @return	string	Tickee Widget iframe tag	
 */
 	function tickee( $atts = null ) {
		global $post;
	
	#	Check if the tickee account is set in dashboard settings or shortcode
		if( $atts['slug'])
			$account = array('slug'=> $atts['slug']);
		
		else if( !$account = get_option('tickee_account'))
			return no_tickee( 'stop' );
	
	#	Build a *simple* widget url
		$url = 'http://inside.tick.ee/widget/';
	
	#	Check if a tickee event id is set in post or page tickee field
		if( $event = get_post_meta( $post->ID, 'tickee_event_field', true ))
			
			 $url .= 'event/' . $event;
		else $url .= 'account/' . $account['slug'];
			
	
	#	Return the iframe tag	
		echo "<iframe src='" . $url . "' frameBorder='0' scrolling='no' style='width:300px; height:430px; border-radius: 4px;'></iframe>";

	}
	
	
/**
 * Add Shortcode
 *
 */
 
 add_shortcode('tickee', 'tickee');



/**	
 * Oops, no tickee to show.
 *
 * @param	string	$message	Error type
 * @return	string	Error message	
 */
	function no_tickee( $message ) {
	
	#	No settings yet
		if( $message == 'stop' )
			return "<h3>Stopped</h3>First you need to submit your tickee account slug.";
	

	}


#	Add Write post/page custom box for tickee query // WP 3.0+
	add_action( 'add_meta_boxes', 'tickee_add_custom_box' );
	add_action( 'save_post', 'tickee_save_postdata' );

/**	
 * The functions to add
 *
 * @return	void	
 */
	function tickee_add_custom_box() {
    	
		add_meta_box( 
			'tickee_query',
			'The tickee event id',
			'tickee_inner_custom_box',
			'post' 
    	);
    	
    	add_meta_box(
        	'tickee_query',
        	'The tickee event id', 
        	'tickee_inner_custom_box',
        	'page'
    	);
	}
	
/**	
 * Prints the box content
 *
 * @param	object	$post	the post or page object	
 * @return	string	the box html	
 */
	function tickee_inner_custom_box( $post ) {

  	#	Use nonce for verification
  		wp_nonce_field( plugin_basename( __FILE__ ), 'tickee_noncename' );

	#	Some value input
		$query =	get_post_meta($post->ID, 'tickee_event_field', true );


  	#	The actual fields for data entry
  		?>
  			<label for='tickee_query_field'>tickee event id (<a href='https://tickee.zendesk.com/entries/21276388-tickee-wordpress-plugin' target='_blank'>more info</a>)</label>
			<input type='text' id='tickee_event_field' name='tickee_event_field' value='<?=$query?>' placeholder='1' size='40' />
			<br />
		<?
	}

#	When the post is saved, saves our custom data */
	function tickee_save_postdata( $post_id ) {
		// verify if this is an auto save routine. 
		// If it is our form has not been submitted, so we dont want to do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			 return;

		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		if ( !wp_verify_nonce( $_POST['tickee_noncename'], plugin_basename( __FILE__ ) ) )
			 return;

		// Check permissions
		if ( 'page' == $_POST['post_type'] ) {
    		 if ( !current_user_can( 'edit_page', $post_id ) )
				return;
  		
  		} else {
    		if ( !current_user_can( 'edit_post', $post_id ) )
       			 return;
		}

  		// OK, we're authenticated: we need to find and save the data
  		update_post_meta( $post_id, 'tickee_event_field', $_POST['tickee_event_field'] );
	}
	
	
add_action('admin_init', 'tickee_options_init' );
add_action('admin_menu', 'tickee_options_add_page');

// Init plugin options to white list our options
function tickee_options_init(){
	register_setting( 'tickee_options_options', 'tickee_account', 'tickee_options_validate' );
}

// Add menu page
function tickee_options_add_page() {
	add_options_page('tickee Options', 'tickee', 'manage_options', 'tickee_options', 'tickee_options_do_page');
}

// Draw the menu page itself
function tickee_options_do_page() {
	?>
	<div class="wrap">
		<h2>tickee Settings</h2>
		<form method="post" action="options.php">
			<?php settings_fields('tickee_options_options'); ?>
			<?php $options = get_option('tickee_account'); ?>
			
			<span>More info about your tickee Widget <a href='https://tickee.zendesk.com/entries/21276388-tickee-wordpress-plugin' target='_blank'>here</a></span>
			<br /><br />
			<table class="form-table">
				<tr valign="top"><th scope="row">Your Account slug:</th>
					<td><input type="text" name="tickee_account[slug]" value="<?php echo $options['slug']; ?>" placeholder='short name' /></td>
				</tr>
				<tr valign="top"><th scope="row">Your Account name:</th>
					<td><input type="text" name="tickee_account[name]" value="<?php echo $options['name']; ?>" placeholder='full name' /></td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
	</div>
	<?php	
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function tickee_options_validate($input) {
	
	// Say our second option must be safe text with no HTML tags
	$input['slug'] =  wp_filter_nohtml_kses($input['slug']);
	$input['name'] =  wp_filter_nohtml_kses($input['name']);
	
	return $input;
}





?>
