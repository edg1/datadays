<?php //netteCache[01]000473a:2:{s:4:"time";s:21:"0.85677900 1385030971";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:84:"/var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/snippets/static-text.php";i:2;i:1385030726;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/snippets/static-text.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'iq1y809kjr')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if ($options->staticTextEnable): ?>
	<section class="section static-text-section wrapper">
		<div class="static-text-container" style="color: <?php echo $options->staticTextColor ?>">
			<?php echo $options->staticText ?>

		</div>
	</section>
<?php endif ;
