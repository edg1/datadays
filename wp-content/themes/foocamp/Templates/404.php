{extends $layout}

{block content}

<section class="section content-section blog-section not-found-section">

	<div id="container" class="subpage blog 404 wrapper {isActiveSidebar blog-sidebar}{else}onecolumn{/isActiveSidebar}">

		<div id="content" class="entry-content clearfix" role="main">
			<div class="content-wrapper">
				{include snippets/nothing-found.php}
			</div> <!-- /.content-wrapper -->
		</div> <!-- /#content -->

	</div> <!-- /#container -->

</section>

{/block}