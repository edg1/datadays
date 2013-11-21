<?php

/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

// ==================================================
// Enables theme custom post types, widgets, etc...
// --------------------------------------------------

$aitThemeCustomTypes = array( 'grid-portfoliob' => 34, 'program' => 36, 'team' => 38, 'faq' => 40);
$aitThemeWidgets = array('post','flickr','submenu','twitter', 'faq');
$aitEditorShortcodes = array( 'custom', 'columns', 'images', 'posts', 'buttons', 'boxesFrames', 'lists', 'notifications', 'modal', 'social', 'video', 'gMaps', 'gChart', 'language', 'tabs', 'gridgalleryb', 'econtent', 'teams', 'faqs');
$aitThemeShortcodes = array( 'boxesFrames' => 2, 'buttons' => 1, 'columns'=> 1, 'custom'=> 1, 'images'=> 1, 'lists'=> 1, 'modal'=> 1, 'notifications'=> 1, 'posts'=> 1, 'sitemap'=> 1, 'social'=> 1, 'video'=> 1, 'language'=> 1, 'gMaps'=> 1, 'gChart'=> 1, 'tabs'=> 1, 'gridgalleryb'=> 1, 'econtent' => 1, 'teams' => 1, 'programs' => 1, 'faqs' => 1);


// ==================================================
// Loads AIT WordPress Framework
// --------------------------------------------------

require dirname(__FILE__) . '/AIT/ait-bootstrap.php';


// ==================================================
// Metaboxes settings for Posts and Pages
// --------------------------------------------------

$pageOptions = array(
	'sections-order' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_sections_order',
		'title' => __('Sections order for this page', 'ait'),
		'types' => array('page', 'post'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/sections-order.neon'
	)),
	'slider' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_slider',
		'title' => __('Options for slider', 'ait'),
		'types' => array('page', 'post'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/page-slider.neon'
	)),
	'countdown' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_countdown',
		'title' => __('Options for countdown', 'ait'),
		'types' => array('page', 'post'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/page-countdown.neon'
	)),
	'static-text' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_static-text',
		'title' => __('Options for static text', 'ait'),
		'types' => array('page', 'post'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/page-static-text.neon'
	))
);


// ==================================================
// Theme's scripts and styles
// --------------------------------------------------

function aitEnqueueScriptsAndStyles()
{
	if(!is_admin()){

		// just shortcuts
		$s = THEME_CSS_URL;
		$j = THEME_JS_URL;


		aitAddStyles(array(
			'ait-fancybox'   => array('file' => "$s/fancybox/jquery.fancybox-1.3.4.css"),
			'ait-colorbox'   => array('file' => "$s/colorbox.css"),
			'ait-hoverzoom'  => array('file' => "$s/hoverZoom.css"),
		));

		aitAddScripts(array(
			'ait-script'          => array('file' => "$j/script.js", 'deps' => array('jquery')),
			'ait-jbclock-js'      => array('file' => "$j/libs/jbclock.js", 'deps' => array('jquery')),
			'ait-gridgallery'     => array('file' => "$j/gridgallery.js", 'deps' => array('jquery')),
			'jquery-easing'       => array('file' => "$j/libs/jquery.easing-1.3.min.js", 'deps' => array('jquery')),
			'ait-hoverzoom'       => array('file' => "$j/libs/hover.zoom.js", 'deps' => array('jquery')),
			'ait-colorbox'        => array('file' => "$j/libs/jquery.colorbox-min.js", 'deps' => array('jquery')),
			'ait-fancybox'        => array('file' => "$j/libs/jquery.fancybox-1.3.4.js", 'deps' => array('jquery')),
			'ait-infieldlabel'    => array('file' => "$j/libs/jquery.infieldlabel.js", 'deps' => array('jquery')),
			'ait-quicksand'       => array('file' => "$j/libs/jquery.quicksand.js", 'deps' => array('jquery')),
			'jquery-ui-tabs'      => true,
			'jquery-ui-accordion' => true,
		));
	}
}

add_action('wp_enqueue_scripts', 'aitEnqueueScriptsAndStyles');


// ==================================================
// Theme setup
// --------------------------------------------------

function aitThemeSetup()
{

	load_theme_textdomain('ait', get_template_directory() . '/languages');

	add_editor_style();

	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('woocommerce');

	register_nav_menu('primary-menu', __('Primary Menu', 'ait'));
	register_nav_menu('footer-menu', __('Footer Menu', 'ait'));
}

add_action('after_setup_theme', 'aitThemeSetup');


// ==================================================
// Plugins
// --------------------------------------------------

aitAddPlugins(array(
	array(
		'name'     => 'Contact Form 7',
		'slug'     => 'contact-form-7',
		'required' => false, // only recommended
	),
	array(
		'name'     => 'Revolution Slider',
		'slug'     => 'revslider',
		'required' => false,
		'source'   => dirname(__FILE__) . '/plugins/revslider.zip', // pre-packed
	),
));


// ==================================================
// Register our sidebars and widgetized areas.
// --------------------------------------------------

function aitWidgetsInit()
{

	$areas = array(
		'homepage-sidebar' => array('name' => __('Homepage Widgets Area', 'ait')),
		'subpages-sidebar' => array('name' => __('Subpages Widgets Area', 'ait')),
		'blog-sidebar'     => array('name' => __('Blog Widgets Area', 'ait')),
		'post-sidebar'     => array('name' => __('Post Widgets Area', 'ait')),
		'footer-widgets'   => array('name' => __('Footer Widgets Area', 'ait')),
	);

	if(defined('WOOCOMMERCE_VERSION'))
		$areas['shop-sidebar'] = array('name' => __('Shop Sidebar', 'ait'));

	aitRegisterWidgetAreas($areas);
}

add_action('widgets_init', 'aitWidgetsInit');


// ==================================================
// Some helper functions and filters for theme
// --------------------------------------------------

function default_menu(){
	wp_nav_menu(array('menu' => 'Main Menu', 'fallback_cb' => 'default_page_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu clear'));
}

function default_page_menu(){
	echo '<nav class="mainmenu">';
	wp_page_menu(array('menu_class' => 'menu clear'));
	echo '</nav>';
}

function default_footer_menu(){
	wp_nav_menu(array('menu' => 'Main Menu', 'container' => 'nav', 'container_class' => 'footer-menu', 'menu_class' => 'menu clear', 'depth' => 1));
}

add_filter('widget_title', 'do_shortcode');
add_filter('widget_text', 'do_shortcode'); // do shortcode in text widget

add_filter('home_template', 'aitIndexTemplate');


// ==================================================
// Custom styling of admin interface of Revolution slider
// --------------------------------------------------

if(isset($revSliderVersion)){
	// Some custom styles for slides in Revolution Slider admin
	function aitRevSliderAdminStyles(){ wp_enqueue_style('ait-revolution-slider-admin-css', THEME_URL . '/design/admin-plugins/revslider.css'); }
	function aitRevSliderAdminScripts(){ wp_enqueue_style('ait-revolution-slider-admin-js', THEME_URL . '/design/admin-plugins/revslider.js'); }

	add_action('admin_print_styles', 'aitRevSliderAdminStyles');
	add_action('admin_print_scripts', 'aitRevSliderAdminScripts');
}

if(!isset($content_width)) $content_width = 1000;

// disable woocommerce title and breadcrumbs to allow our own positioning */
add_filter('woocommerce_show_page_title', '__return_false');