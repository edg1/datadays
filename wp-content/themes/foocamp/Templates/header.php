<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js oldie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js oldie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js oldie lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	
	{mobileDetectionScript}
	<meta name="Author" content="AitThemes.com, http://www.ait-themes.com">

	<title>{title}</title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="{$site->pingbackUrl}">

	<!--[if lt IE 9]> 
		<script src="//ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
		<script src="{$themeJsUrl}/libs/selectivizr-min.js"></script>
	<![endif] -->

	{head}

	<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="{less}">

</head>

{var $sliderOptions = $themeOptions->sections}
{if isset($post) && isset($post->options('slider')->overrideGlobal)}
	{var $sliderOptions = $post->options('slider')}
{/if}


<body class="{bodyClasses $bodyClasses, ait-rounder}{if $sliderOptions->sliderEnable == 1} with-slider{/if}{*{if $themeOptions->general->enableCSSFeatures->enable === 'enable'} css-features{/if}*}" data-themeurl="{$themeUrl}">

	<script> document.body.className+=' js' </script>

	<div class="mainpage">
		<header class="page-header" role="banner">

			{include snippets/slider.php, options => $sliderOptions}

			<div class="header-holder">
				<div class="wrapper">
		            {if !empty($themeOptions->general->logo_img)}
		            <a href="{$homeUrl}" class="logo">
		                <img src="{$themeOptions->general->logo_img}" alt="{$themeOptions->general->topBarContact}">
		            </a>
		            {/if}

					<div class="main-navigation clearfix right">

						<aside class="quick-info right">

							<!-- WPML plugin required -->
		                    {if function_exists(icl_get_languages)}
		                    {if icl_get_languages('skip_missing=0')}
		                    <div class="wpml-switch clearfix left">
	                            <ul id="language-bubble" class="bubble clearfix">
	                                {foreach icl_get_languages('skip_missing=0') as $lang}
	                                <li class="lang {if $lang['active'] == 1}active{/if} left"><a href="{$lang['url']}">{$lang['language_code']}</a></li>
	                                {/foreach}
	                            </ul>
		                    </div> <!-- /.language-button -->
		                    {/if}
		                    {/if}

		                    {if $themeOptions->socialIcons->displayIcons}
		                    {ifset $themeOptions->socialIcons->icons}
		                    <ul class="social-icons right clearfix">
		                        {foreach $themeOptions->socialIcons->icons as $icon}
		                        <li class="left"><a href="{if !empty($icon->link)}{$icon->link}{else}#{/if}"><img src="{$icon->iconUrl}" height="34" width="34" alt="{$icon->title}" title="{$icon->title}"></a></li>
		                        {/foreach}
		                    </ul>
		                    {/ifset}
		                    {/if}

						</aside>

						<div class="menu-container">
							<div class="menu-content defaultContentWidth">
								<div id="mainmenu-dropdown-duration" style="display: none;">200</div>
								<div id="mainmenu-dropdown-easing" style="display: none;">swing</div>
								<span class="menubut bigbut">{__ 'Main Menu'}</span>
								{menu 'theme_location' => 'primary-menu', 'fallback_cb' => 'default_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu' }
							</div>
						</div>

					</div> <!-- /.main-navigation -->
				</div> <!-- /.header-holder -->
			</div>  <!-- /.wrapper -->

		</header>