<?php //netteCache[01]000459a:2:{s:4:"time";s:21:"0.78516000 1385030971";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:70:"/var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/header.php";i:2;i:1385030699;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/header.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'gek405soff')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js oldie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js oldie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js oldie lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="<?php echo htmlSpecialChars($site->charset) ?>" />
<script type='text/javascript'>var ua = navigator.userAgent; var meta = document.createElement('meta');if((ua.toLowerCase().indexOf('android') > -1 && ua.toLowerCase().indexOf('mobile')) || ((ua.match(/iPhone/i)) || (ua.match(/iPad/i)))){ meta.name = 'viewport';	meta.content = 'target-densitydpi=device-dpi, width=device-width'; }var m = document.getElementsByTagName('meta')[0]; m.parentNode.insertBefore(meta,m);</script> 	<meta name="Author" content="AitThemes.com, http://www.ait-themes.com" />

	<title><?php echo WpLatteFunctions::getTitle() ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php echo htmlSpecialChars($site->pingbackUrl) ?>" />

	<!--[if lt IE 9]>
		<script src="//ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
		<script src="<?php echo NTemplateHelpers::escapeHtmlComment($themeJsUrl) ?>/libs/selectivizr-min.js"></script>
	<![endif]-->

<?php if(is_singular() && get_option("thread_comments")){wp_enqueue_script("comment-reply");}wp_head() ?>

	<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo WpLatteFunctions::lessify() ?>" />

</head>

<?php $sliderOptions = $themeOptions->sections ;if (isset($post) && isset($post->options('slider')->overrideGlobal)): $sliderOptions = $post->options('slider') ;endif ?>

<body class="<?php echo join(' ', get_body_class()) . ' ' . join(' ', array($bodyClasses, 'ait-rounder')) ;if ($sliderOptions->sliderEnable == 1): ?>
 with-slider<?php endif ?>" data-themeurl="<?php echo htmlSpecialChars($themeUrl) ?>">

	<script> document.body.className+=' js' </script>

	<div class="mainpage">
		<header class="page-header" role="banner">

<?php NCoreMacros::includeTemplate("snippets/slider.php", array('options' => $sliderOptions) + $template->getParams(), $_l->templates['gek405soff'])->render() ?>

			<div class="header-holder">
				<div class="wrapper">
<?php if (!empty($themeOptions->general->logo_img)): ?>
		            <a href="<?php echo htmlSpecialChars($homeUrl) ?>" class="logo">
		                <img src="<?php echo htmlSpecialChars($themeOptions->general->logo_img) ?>
" alt="<?php echo htmlSpecialChars($themeOptions->general->topBarContact) ?>" />
		            </a>
<?php endif ?>

					<div class="main-navigation clearfix right">

						<aside class="quick-info right">

							<!-- WPML plugin required -->
<?php if (function_exists('icl_get_languages')): if (icl_get_languages('skip_missing=0')): ?>
		                    <div class="wpml-switch clearfix left">
	                            <ul id="language-bubble" class="bubble clearfix">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator(icl_get_languages('skip_missing=0')) as $lang): ?>
	                                <li class="lang <?php if ($lang['active'] == 1): ?>
active<?php endif ?> left"><a href="<?php echo htmlSpecialChars($lang['url']) ?>
"><?php echo NTemplateHelpers::escapeHtml($lang['language_code'], ENT_NOQUOTES) ?></a></li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
	                            </ul>
		                    </div> <!-- /.language-button -->
<?php endif ;endif ?>

<?php if ($themeOptions->socialIcons->displayIcons): if (isset($themeOptions->socialIcons->icons)): ?>
		                    <ul class="social-icons right clearfix">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($themeOptions->socialIcons->icons) as $icon): ?>
		                        <li class="left"><a href="<?php if (!empty($icon->link)): echo htmlSpecialChars($icon->link) ;else: ?>
#<?php endif ?>"><img src="<?php echo htmlSpecialChars($icon->iconUrl) ?>" height="34" width="34" alt="<?php echo htmlSpecialChars($icon->title) ?>
" title="<?php echo htmlSpecialChars($icon->title) ?>" /></a></li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
		                    </ul>
<?php endif ;endif ?>

						</aside>

						<div class="menu-container">
							<div class="menu-content defaultContentWidth">
								<div id="mainmenu-dropdown-duration" style="display: none;">200</div>
								<div id="mainmenu-dropdown-easing" style="display: none;">swing</div>
								<span class="menubut bigbut"><?php echo NTemplateHelpers::escapeHtml(__('Main Menu', 'ait'), ENT_NOQUOTES) ?></span>
<?php wp_nav_menu(array('theme_location' => 'primary-menu', 'fallback_cb' => 'default_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu')) ?>
							</div>
						</div>

					</div> <!-- /.main-navigation -->
				</div> <!-- /.header-holder -->
			</div>  <!-- /.wrapper -->

		</header>