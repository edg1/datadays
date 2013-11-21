{extends $layout}

{block content}

<section class="section content-section blog-section tag-section">

<div id="container" class="subpage blog tag wrapper {isActiveSidebar blog-sidebar}{else}onecolumn{/isActiveSidebar}">

	<div id="content" class="entry-content clearfixs" role="main">
		<div class="content-wrapper">

			{if $posts}
				<header class="entry-title subpage-header">
					<h1 class="page-title">
						{__ 'Tag Archives:'} <span>{$tag->title}</span>
					</h1>
					<span class="breadcrumbs">{__ 'You are here:'} {breadcrumbs}</span>
				</header>

				{if !empty($tag->description)}
					<div class="category-archive-meta">{!$tag->description}</div>
				{/if}

				{include snippets/content-nav.php location => 'nav-above'}

				{include snippets/content-loop.php posts => $posts}

				{include snippets/content-nav.php location => 'nav-below'}

			{else}

				{include snippets/nothing-found.php}

			{/if}

		</div> <!-- /.content-wrapper -->
	</div> <!-- /#content -->

	{isActiveSidebar blog-sidebar}
	<div class="page-sidebar blog-sidebar right clearfix">
		{dynamicSidebar blog-sidebar}
	</div>
	{/isActiveSidebar}

</div> <!-- /#container -->

</section>

{/block}