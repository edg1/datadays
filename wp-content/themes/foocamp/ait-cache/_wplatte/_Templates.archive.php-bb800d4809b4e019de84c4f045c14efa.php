<?php //netteCache[01]000460a:2:{s:4:"time";s:21:"0.90840600 1385067712";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:71:"/var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/archive.php";i:2;i:1385030698;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/archive.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'o7qtrroy90')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb893d2a67a9_content')) { function _lb893d2a67a9_content($_l, $_args) { extract($_args)
?>

<section class="section content-section blog-section archive-section">

<div id="container" class="subpage blog archive wrapper <?php if(is_active_sidebar("blog-sidebar")): else: ?>
onecolumn<?php endif ?>">

<?php if ($posts): ?>

	<div id="content" class="entry-content clearfix" role="main">
		<div class="content-wrapper">


				<header class="entry-title subpage-header">
					<h1 class="page-title">
<?php if ($archive->isDay): ?>
							<?php echo NTemplateHelpers::escapeHtml(__('Daily Archives:', 'ait'), ENT_NOQUOTES) ?>
 <span><?php echo NTemplateHelpers::escapeHtml($template->date($posts[0]->date, $site->dateFormat), ENT_NOQUOTES) ?></span>
<?php elseif ($archive->isMonth): ?>
							<?php echo NTemplateHelpers::escapeHtml(__('Monthly Archives:', 'ait'), ENT_NOQUOTES) ?>
' <span><?php echo NTemplateHelpers::escapeHtml($template->date($posts[0]->date, 'F Y'), ENT_NOQUOTES) ?></span>
<?php elseif ($archive->isYear): ?>
							<?php echo NTemplateHelpers::escapeHtml(__('Yearly Archives:', 'ait'), ENT_NOQUOTES) ?>
' <span><?php echo NTemplateHelpers::escapeHtml($template->date($posts[0]->date, 'Y'), ENT_NOQUOTES) ?></span>
<?php else: ?>
							<?php echo NTemplateHelpers::escapeHtml(__('Blog Archives', 'ait'), ENT_NOQUOTES) ?>

<?php endif ?>
					</h1>
					<span class="breadcrumbs"><?php echo NTemplateHelpers::escapeHtml(__('You are here:', 'ait'), ENT_NOQUOTES) ?>
 <?php echo WpLatteFunctions::breadcrumbs(array()) ?></span>
				</header>

<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-above') + $template->getParams(), $_l->templates['o7qtrroy90'])->render() ?>

<?php NCoreMacros::includeTemplate("snippets/content-loop.php", array('posts' => $posts) + $template->getParams(), $_l->templates['o7qtrroy90'])->render() ?>

<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-below') + $template->getParams(), $_l->templates['o7qtrroy90'])->render() ?>


		</div> <!-- /.content-wrapper -->
	</div> <!-- /#content -->

<?php if(is_active_sidebar("blog-sidebar")): ?>
	<div class="page-sidebar blog-sidebar right clearfix">
<?php dynamic_sidebar('blog-sidebar') ?>
	</div>
<?php endif ?>

<?php else: ?>

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

<?php NCoreMacros::includeTemplate("snippets/nothing-found.php", $template->getParams(), $_l->templates['o7qtrroy90'])->render() ?>
		
		</div> <!-- /.content-wrapper -->
	</div> <!-- /#content -->

<?php endif ?>

</div><!-- /#container -->

</section>

<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = true; unset($_extends, $template->_extends);


if ($_l->extends) {
	ob_start();
} elseif (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
$_l->extends = $layout ?>

<?php 
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
