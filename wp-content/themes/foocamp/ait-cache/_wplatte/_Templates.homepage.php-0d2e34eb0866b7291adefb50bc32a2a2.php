<?php //netteCache[01]000461a:2:{s:4:"time";s:21:"0.85158800 1385066239";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:72:"/var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/homepage.php";i:2;i:1385030699;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/homepage.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'iwb11ahb5f')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb4a50802771_content')) { function _lb4a50802771_content($_l, $_args) { extract($_args)
?>

<?php if (trim($post->content) != ""): ?>

<section class="section content-section">

<div id="container" class="homepage subpage wrapper <?php if(is_active_sidebar("homepage-sidebar")): else: ?>
onecolumn<?php endif ?>">

	<div id="content" class="entry-content clearfix" role="main">
		<div class="content-wrapper clearfix">

			<div class="post-content">
				<?php echo $post->content ?>

			</div>

		</div> <!-- /.content-wrapper -->

<?php NCoreMacros::includeTemplate("comments.php", array('closeable' => $themeOptions->general->closeComments, 'defaultState' => $themeOptions->general->defaultPosition) + $template->getParams(), $_l->templates['iwb11ahb5f'])->render() ?>

	</div> <!-- /#content -->

<?php if(is_active_sidebar("homepage-sidebar")): ?>
	<div class="page-sidebar homepage-sidebar right clearfix">
<?php dynamic_sidebar('homepage-sidebar') ?>
	</div>
<?php endif ?>

</div> <!-- /#container -->

</section>

<?php endif ?>

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
$_l->extends = $layout ;$sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->sectionsOrder : null ?>


<?php isset($post->options('countdown')->overrideGlobal) ? $sectionA = 'sectionA' : $sectionA = 'xa' ;//
// block $sectionA
//
if (!function_exists($_l->blocks[$sectionA][] = '_lbdd357992be__sectionA')) { function _lbdd357992be__sectionA($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/countdown.php", array('options' => $post->options('countdown')) + $template->getParams(), $_l->templates['iwb11ahb5f'])->render() ;}} call_user_func(reset($_l->blocks[$sectionA]), $_l, get_defined_vars()) ?>

<?php isset($post->options('static-text')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xb' ;//
// block $sectionB
//
if (!function_exists($_l->blocks[$sectionB][] = '_lbeea2842991__sectionB')) { function _lbeea2842991__sectionB($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/static-text.php", array('options' => $post->options('static-text')) + $template->getParams(), $_l->templates['iwb11ahb5f'])->render() ;}} call_user_func(reset($_l->blocks[$sectionB]), $_l, get_defined_vars()) ;
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
