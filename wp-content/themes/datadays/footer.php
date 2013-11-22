<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package datadays
 
 <div class="row">
  <div class="col-md-4">.col-md-4</div>
  <div class="col-md-4">.col-md-4</div>
  <div class="col-md-4">.col-md-4</div>
</div>
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	        <div class="container">
	        <div class="row text-center pagination-centered">
			<div class="col-md-4"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/okfn-logo-landscape1.png" alt="okfn-logo-landscape" width="200" height="52" class="alignnone size-full wp-image-94" /></div>
			<div class="col-md-4"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/CITADEL-LOGO-1_v1.0.png" alt="CITADEL LOGO-1_v1.0" width="200" height="96" class="alignnone size-full wp-image-84" /></div>
			<div class="col-md-4"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/Lola-CMYK.png" alt="Lola CMYK" width="200" height="55" class="alignnone size-full wp-image-93" /></div>
			</div>
			</br>
			</br>
			<div class="row text-center pagination-centered">
			<div class="col-md-2"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/leeuwVO_G_G.png" alt="leeuwVO_G_G" width="50%" height="50%" class="alignnone size-full wp-image-83" /></div>
			<div class="col-md-2"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/SIL_logo.png" alt="SIL_logo" width="50%" height="50%" class="alignnone size-full wp-image-85" /></div>
			<div class="col-md-2"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/iDrops-logo-2012.png" alt="iDrops logo 2012" width="50%" height="50%" class="alignnone size-full wp-image-86" /></div>
			<div class="col-md-2"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/victor_outline_cmyk.png" alt="victor_outline_cmyk" width="50%" height="50%" class="alignnone size-full wp-image-87" /></div>
			<div class="col-md-2"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/cip_en.png" alt="cip_en" width="50%" height="50%" class="alignnone size-full wp-image-89" /></div>
			<div class="col-md-2"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/flag_yellow_eps.png" alt="flag_yellow_eps" width="50%" height="50%" class="alignnone size-full wp-image-90" /></div>
			</div>
			</div>
			
		<div class="site-info">
			<?php do_action( 'datadays_credits' ); ?>
			<a href="http://ed.be/" rel="generator"><?php printf( __( 'Proudly Open Content by %s', 'datadays' ), 'Open' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'datadays' ), 'datadays', '<a href="http://ed.be/" rel="designer">ed</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>