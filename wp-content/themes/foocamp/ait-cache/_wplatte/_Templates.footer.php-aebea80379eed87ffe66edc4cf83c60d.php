<?php //netteCache[01]000459a:2:{s:4:"time";s:21:"0.91267400 1385030971";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:70:"/var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/footer.php";i:2;i:1385030699;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/footer.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '66cuwho3i0')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
	<div class="footer-upper"><!-- placeholder --></div>
	<footer class="page-footer">
<?php if(is_active_sidebar("footer-widgets")): ?>
		<aside class="footer-widgets">
			<div class="wrapper">
<?php dynamic_sidebar('footer-widgets') ?>
			</div>
		</aside>
<?php endif ?>

		<aside class="footer-line wrapper">
			<div class="footer-upper-line"><!-- placeholder --></div>
			<div class="footer-text clearfix">
				<div class="footer-text left"><?php echo $themeOptions->general->footer_text ?></div> 
				<div class="footer-menu right clearfix">
<?php wp_nav_menu(array('theme_location' => 'footer-menu','fallback_cb' => 'default_footer_menu', 'container' => 'nav', 'container_class' => 'footer-menu', 'menu_class' => 'menu clear', 'depth' => 1)) ?>
				</div>
			</div>
		</aside>
	</footer>
	</div>

<?php wp_footer() ?>

<?php if (isset($themeOptions->general->ga_code) && ($themeOptions->general->ga_code!="")): ?>
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', <?php echo NTemplateHelpers::escapeJs($themeOptions->general->ga_code) ?>]);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
<?php endif ?>

</body>
</html>