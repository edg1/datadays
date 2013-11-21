<?php

/**
 * DataDays WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 *
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package datadays
 */
 
global $latteParams;

WpLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();
 
?>



