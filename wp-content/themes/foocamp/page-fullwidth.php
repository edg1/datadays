<?php

/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Template Name: Page Fullwidth Template
 * Description: Page without sidebar
 */

$latteParams['post'] = WpLatte::createPostEntity(
	$wp_query->post,
	array(
		'meta' => $pageOptions,
	)
);

$latteParams['post']->classes = implode(' ', get_post_class());

WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();
