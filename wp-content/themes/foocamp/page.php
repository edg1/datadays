<?php

/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

$latteParams['post'] = WpLatte::createPostEntity(
	$wp_query->post,
	array(
		'meta' => $pageOptions,
	)
);

$latteParams['post']->classes = implode(' ', get_post_class());

WpLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();
