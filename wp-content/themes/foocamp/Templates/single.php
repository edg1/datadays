{extends $layout}
{var $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->sectionsOrder : null}

{block content}
<section class="section content-section single-post-section">

<div id="container" class="subpage wrapper {isActiveSidebar post-sidebar}{else}onecolumn{/isActiveSidebar}">

	<div id="content" class="entry-content clearfix" role="main">
		<div class="content-wrapper clearfix">

			<article id="post-{$post->id}" class="{$post->htmlClasses} in-loop clearfix">

				{include snippets/posted-on.php}

				{if $post->thumbnailSrc != false }
				<a href="{$post->thumbnailSrc}">
				<div class="entry-thumbnail">
					{var $imgWidth = 980}
					{isActiveSidebar post-sidebar} {var $imgWidth = 650} {/isActiveSidebar}
					<img src="{thumbnailResize $post->thumbnailSrc, w => $imgWidth, h => 400}" class="block" alt="" />
				</div>
				</a>
				{/if}


				<div class="post-content entry-content">
					{!$post->content}
				</div>

				<div class="entry-meta post-footer clearfix">
					<a href="{dayLink $post->date}" class="date meta-info" title="{$post->date|date:$site->dateFormat}" rel="bookmark">{$post->date|date:"F d, Y"}</a>
					<a class="url fn n ln author meta-info" href="{$post->author->postsUrl}" title="View all posts by {$post->author->name}" rel="author">{$post->author->name}</a>
					<span n:if="$post->type == 'post' && $post->categories" class="categories meta-info">{!$post->categories}</span>
					<span n:if="$post->tags" class="tags meta-info">{!$post->tags}</span>
					<span class="comments meta-info">{$post->commentsCount}</span>
				</div><!-- /.entry-meta -->

				{if strlen($post->author->bio) !== 0}
				<div class="author-archive-meta clearfix">
					<div id="author-avatar" class="left">{!$post->author->avatar(60)}</div>
					<div id="author-description" class="clearfix">
						<div class="author-name">{_x '', 'about author'} {$post->author->name}</div>
						<div class="bio">{$post->author->bio}</div>
					</div>
				</div>
				{/if}

			</article>

		{include comments.php, closeable => $themeOptions->general->closeComments, defaultState => $themeOptions->general->defaultPosition}

		</div><!-- /.content-wrapper -->
	</div> <!-- /#content -->

	{isActiveSidebar post-sidebar}
	<div class="page-sidebar post-sidebar right clearfix">
		{dynamicSidebar post-sidebar}
	</div>
	{/isActiveSidebar}

</div ><!-- /#container -->

</section>
{/block}

{? isset($post->options('countdown')->overrideGlobal) ? $sectionA = 'sectionA' : $sectionA = 'xa'}
{define $sectionA}
	{include snippets/countdown.php, options => $post->options('countdown')}
{/define}

{? isset($post->options('static-text')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xb'}
{define $sectionB}
	{include snippets/static-text.php, options => $post->options('static-text')}
{/define}