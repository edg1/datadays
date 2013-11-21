{extends $layout}
{if !$isIndexPage}
	{var $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->sectionsOrder : null}
{/if}

{block content}

<section class="section content-section blog-section">

<div id="container" class="subpage wrapper {isActiveSidebar blog-sidebar}{else}onecolumn{/isActiveSidebar}">

	{if $posts}
	<div id="content" class="entry-content clearfix" role="main">
		<div class="content-wrapper clearfix">

		{if !$isIndexPage}
			{if trim($post->content) != ""}

			<header class="entry-title clearfix">
				<h1>{$post->title}</h1>
				<span class="breadcrumbs">{__ 'You are here:'} {breadcrumbs}</span>
			</header>

			<div class="post-content">
				{!$post->content}
			</div>

			{/if}
		{/if}


			{include snippets/content-nav.php location => 'nav-above'}

			{include snippets/content-loop.php posts => $posts}

			{include snippets/content-nav.php location => 'nav-below'}


		</div> <!-- /.content-wrapper -->
	</div> <!-- /#content -->

	{isActiveSidebar blog-sidebar}
	<div class="page-sidebar blog-sidebar right clearfix">
		{dynamicSidebar blog-sidebar}
	</div>
	{/isActiveSidebar}

	{else}

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

			{include snippets/nothing-found.php}

		</div> <!-- /.content-wrapper -->
	</div> <!-- /#content -->

	{/if}

</div> <!-- /#container -->

</section>

{/block}

{if !$isIndexPage}
	{? isset($post->options('countdown')->overrideGlobal) ? $sectionA = 'sectionA' : $sectionA = 'xa'}
	{define $sectionA}
		{include snippets/countdown.php, options => $post->options('countdown')}
	{/define}

	{? isset($post->options('static-text')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xb'}
	{define $sectionB}
		{include snippets/static-text.php, options => $post->options('static-text')}
	{/define}
{/if}