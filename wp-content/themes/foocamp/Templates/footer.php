	<div class="footer-upper"><!-- placeholder --></div>
	<footer class="page-footer">
		{isActiveSidebar footer-widgets}
		<aside class="footer-widgets">
			<div class="wrapper">
				{dynamicSidebar footer-widgets}
			</div>
		</aside>
		{/isActiveSidebar}

		<aside class="footer-line wrapper">
			<div class="footer-upper-line">
			<!-- placeholder -->
			<div class="row-fluid">
			<div class="span4"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/okfn-logo-landscape1.png" alt="okfn-logo-landscape" width="200" height="52" class="alignnone size-full wp-image-94" /></div>
			<div class="span4"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/CITADEL-LOGO-1_v1.0.png" alt="CITADEL LOGO-1_v1.0" width="200" height="96" class="alignnone size-full wp-image-84" /></div>
			<div class="span4"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/Lola-CMYK.png" alt="Lola CMYK" width="200" height="55" class="alignnone size-full wp-image-93" /></div>
			</div>
			<div class="row-fluid">
			<div class="span3"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/leeuwVO_G_G.png" alt="leeuwVO_G_G" width="200" height="58" class="alignnone size-full wp-image-83" /></div>
			<div class="span3"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/SIL_logo.png" alt="SIL_logo" width="200" height="149" class="alignnone size-full wp-image-85" /></div>
			<div class="span3"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/iDrops-logo-2012.png" alt="iDrops logo 2012" width="200" height="169" class="alignnone size-full wp-image-86" /></div>
			<div class="span3"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/victor_outline_cmyk.png" alt="victor_outline_cmyk" width="200" height="62" class="alignnone size-full wp-image-87" /></div>
			</div>
			<div class="row-fluid">
			<div class="span3"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/cip_en.png" alt="cip_en" width="200" height="193" class="alignnone size-full wp-image-89" /></div>
			<div class="span3"><img src="http://www.ed.be/datadays/wp-content/uploads/2013/11/flag_yellow_eps.png" alt="flag_yellow_eps" width="200" height="136" class="alignnone size-full wp-image-90" /></div>
			</div>
			</div>
			
			<div class="footer-text clearfix">
				<div class="footer-text left">{!$themeOptions->general->footer_text}</div> 
				<div class="footer-menu right clearfix">
					{menu 'theme_location' => 'footer-menu','fallback_cb' => 'default_footer_menu', 'container' => 'nav', 'container_class' => 'footer-menu', 'menu_class' => 'menu clear', 'depth' => 1 }
				</div>
			</div>
		</aside>
	</footer>
	</div>

	{footer}

	{if isset($themeOptions->general->ga_code) && ($themeOptions->general->ga_code!="")}
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', {$themeOptions->general->ga_code}]);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
	{/if}

</body>
</html>