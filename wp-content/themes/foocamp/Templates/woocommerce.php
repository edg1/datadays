{extends $layout}
{block content}

<section class="section content-section">

<div id="container" class="subpage wrapper {isNotActiveWidgetArea shop-sidebar}onecolumn{/isNotActiveWidgetArea}">

	<div id="content" class="entry-content clearfix" role="main">
		<div class="content-wrapper clearfix">

			<header class="entry-title clearfix">
                <h1>{$post->title}</h1>
                <span class="breadcrumbs">{__ 'You are here:'} {? woocommerce_breadcrumb(array('delimiter'  => ' &raquo; ', 'wrap_before' => '', 'wrap_after' => '')) }</span>
			</header>
            {? woocommerce_content() }
		</div> <!-- /.content-wrapper -->
		
	</div> <!-- /#content -->

    {isActiveWidgetArea shop-sidebar}
	<div class="page-sidebar subpage-sidebar right clearfix">
        {widgetArea shop-sidebar}
	</div>
    {/isActiveWidgetArea}

</div> <!-- /#container -->

</section>


{/block}