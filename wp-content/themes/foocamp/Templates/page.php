{extends $layout}
{var $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->sectionsOrder : null}

{block content}

{if trim($post->content) != ""}

<section class="section content-section">

<div id="container" class="subpage wrapper {isActiveSidebar subpages-sidebar}{else}onecolumn{/isActiveSidebar}">

	<div id="content" class="entry-content clearfix" role="main">
		<div class="content-wrapper clearfix">

			<header class="entry-title clearfix">
				<h1>{$post->title}</h1>
				<span class="breadcrumbs">{__ 'You are here:'} {breadcrumbs}</span>
			</header>

			<div class="post-content">
				{!$post->content}
			</div>

		</div> <!-- /.content-wrapper -->

		{include comments.php, closeable => $themeOptions->general->closeComments, defaultState => $themeOptions->general->defaultPosition}

	</div> <!-- /#content -->

	{isActiveSidebar subpages-sidebar}
	<div class="page-sidebar subpage-sidebar right clearfix">
		{dynamicSidebar subpages-sidebar}
	</div>
	{/isActiveSidebar}

</div> <!-- /#container -->

</section>

{/if}

{/block}

{? isset($post->options('countdown')->overrideGlobal) ? $sectionA = 'sectionA' : $sectionA = 'xa'}
{define $sectionA}
	{include snippets/countdown.php, options => $post->options('countdown')}
{/define}

{? isset($post->options('static-text')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xb'}
{define $sectionB}
	{include snippets/static-text.php, options => $post->options('static-text')}
{/define}