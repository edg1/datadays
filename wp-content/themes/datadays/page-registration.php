<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package datadays
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		  <div class="row">
			<div class="col-md-6 hackathon hackathon-citadel">
  			
  		<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

			</div>
			<div class="col-md-6">
			<div class="mijnevent"><iframe src="http://mijnevent.be/nl/event/50971/data-days/info?iframe=1" width="600" height="1500" frameBorder="0"></iframe>
			</div>		
			</div>
			</div>
    </main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); NO SIDEBAR! ?>
<?php get_footer(); ?>
