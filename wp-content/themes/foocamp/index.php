<?php

/*
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


$latteParams['posts'] = WpLatte::createPostEntity($wp_query->posts);

// no page was selected for "Posts page" from WP Admin in Settings->Reading
$latteParams['isIndexPage'] = true;

if(isset($wp_query->queried_object)){

	$latteParams['post'] = WpLatte::createPostEntity(
		$wp_query->queried_object,
		array(
			'meta' => $pageOptions,
	));

	$latteParams['isIndexPage'] = false;
}

WpLatte::createTemplate(__FILE__, $latteParams)->render();