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
      <?php if(get_post_type() == 'dd-speaker'): ?>
		  
		  <div class="row">

			<div class="col-md-3 col-sm-6">
			  <?php 
         if (has_post_thumbnail(get_the_ID())) {
           print('<div class="speaker-pic-big">');
           print(get_the_post_thumbnail(get_the_ID(), array(265, 265)));
           print('</div>');
          } else {
            //$result .= '<div class="nothumb"></div>';
          }

			  ?>
			</div>
			
		  <div class="col-md-9 col-sm-6">
			  
			  <h1><?php echo get_the_title(); ?></h1>
			  <p>
			  <?php 
			    $orgs = wp_get_post_terms(get_the_ID(), 'dd-speaker-category');
          foreach($orgs as $org) {
            print('<p class="organization">' . $org->name . '</p>');
          }
			    $biographies = get_post_meta(get_the_ID(), 'biography') ;
			    foreach($biographies as $biography) {
  			    echo $biography;
			    }
  			  

			  ?>
			  </p>
			  
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