<?php
/**
 * The Template for displaying all single posts.
 *
 * @package datadays
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
 <?php if(get_post_type() == 'dd-session'): ?>
		  
		  <div class="row">
			<div class="col-md-9 col-sm-6">
			  
			  <h1><?php echo get_the_title(); ?></h1>
			  <p>
			  <?php 
			    $descriptions = get_post_meta(get_the_ID(), 'description') ;
			    foreach($descriptions as $description) {
  			    echo $description;
			    }
  			  
			  ?>
			  </p>
			  
		  </div>
			<div class="col-md-3 col-sm-6">
			  <?php 
			    $speakers = get_post_meta(get_the_ID(), 'speaker', true);
			    $speakers = explode(';', $speakers);
			    foreach ($speakers as $speaker_id) {
			      if ($speaker_id == '')
			        continue;
			      $speaker = get_post($speaker_id);
            if ($speaker->post_title == "")
              continue;
            $html = dd_speakers_render_speaker($speaker);
            print('<div class="speaker">');
            print($html);
            print('</div>');
              
          }
			  ?>
			</div>
		  </div>
			
			<?php endif; ?>
			
			
			<?php 
			//datadays_content_nav( 'nav-below' ); 
			
			// Get the day
			$days = wp_get_post_terms(get_the_ID(), 'dd-session-day');
			$day = reset($days);
			
			// Get all sessions on this day
			$sessions = get_posts(array(
  		  'post_type' => 'dd-session',
  		  'post_status' => 'publish',
  		  'tax_query' => array(
  				array(
    		    'taxonomy' => 'dd-session-day',
    		    'field' => 'slug',
    		    'terms' => $day->slug,
  				)
        ),
  		  'posts_per_page' => -1,
  		  'ignore_sticky_posts'=> 1,
  		  'orderby' => 'menu_order'
		  ));
		  
		  // The default code for a navbar can be copied from template-tags.php:r27
		  
		  // List all sessions this day keyed by time.
		  $all = array();
		  foreach($sessions as $session) {
		    $time = explode('-', reset(get_post_meta($session->ID, 'time')));
        if (count($time) == 2) {
          $title = get_the_title($session->ID);
          if (($title != 'Coffee') && ($title != 'Lunch')) {
            $all[$time[0]] = $session->ID;
          }
        }
      }
      ksort($all);
      
      // Get the time for this session
      $mystart = false;
      $mytime = explode('-', reset(get_post_meta(get_the_ID(), 'time')));
      if (count($mytime) > 1) {
        print '<nav role="navigation" id=' . esc_attr(get_the_ID()) . '" class="post-navigation">';
        print '<h3 class="screen-reader-text">Other sessions</h3>';
        $mystart = $mytime[0];
        // Find previous and next sessions
        $prev = false;
        $print = false;
        foreach($all as $time => $id) {
          if ($print) {
            // print next
            print '<div class="nav-next"><a href="' . get_permalink($id) . '">' . get_the_title($id) .  '<span class="meta-nav"> &rarr;</span></a></div>';
            break;
          } else if ($time == $mystart) {
            // print previous
            print '<div class="nav-previous"><a href="' . get_permalink($prev) . '"><span class="meta-nav">&larr; </span>' . get_the_title($prev) . '</a></div>';
            $print = true;
          } else {
            $prev = $id;
          }
        }
        print '</nav>';
      }
      
      
      
      
      

		
			?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>
		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>