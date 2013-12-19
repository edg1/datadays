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
			    foreach ($speakers as $speaker) {
			      if ($speaker != '') {
			        /*
              if ($speaker->post_title == "")
                continue;
                */
              $thumbnail = the_post_thumbnail($speaker, array(32, 32));
              print '<div class="speaker">';
              print '<div class="speaker-pic">';
              print '<a href="'. $thumbnail .'" class="speaker-img">' . get_the_post_thumbnail($speaker, array(75, 75)) . '</a>';
              print '</div>';
              //$result .= '<div class="speaker-details">';
              print '<h3>' . get_the_title($speaker) . '</h3>';
              print '<p><span>' . get_post_meta($speaker, 'bio', true) . '</span></p>';
              print '</div>';
              //$result .= '</div>';
            }
          }
			  ?>
			</div>
		  </div>
			
			<?php endif; ?>

			<?php datadays_content_nav( 'nav-below' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>