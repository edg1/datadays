<?php //netteCache[01]000461a:2:{s:4:"time";s:21:"0.07400100 1385033866";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:72:"/var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/comments.php";i:2;i:1385030698;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/comments.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '1h3tyj30nc')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if ($post->comments): if (isset($closeable)): ?>
	<div class="closeable">
		<div class="open-button <?php if ($defaultState == 'opened'): ?>comments-opened<?php else: ?>
comments-closed<?php endif ?>">
<?php if ($defaultState == 'opened'): ?>
				Close Comments
<?php else: ?>
				Show Comments
<?php endif ?>
		</div>
<?php endif ;endif ?>

<div id="comments">
<?php if (!$post->isPasswordRequired): ?>

<?php if ($post->comments): ?>

		<h2 id="comments-title">
<?php 
				$a = array($post->title, $post->commentsCount, 'One thought on', 'Thoughts on');
				$a[0] = NTemplateHelpers::escapeHtml($a[0], ENT_NOQUOTES);
				printf(_n(
						"$a[2] &ldquo;%2\$s&rdquo;",
						"%1\$s $a[3] &ldquo;%2\$s&rdquo;",
						$a[1],
						"ait"
					),
					number_format_i18n($a[1]),
					"<span>$a[0]</span>"
				);unset($a) ?>
		</h2>

<?php NCoreMacros::includeTemplate("snippets/comments-pagination.php", array('location' => 'above') + $template->getParams(), $_l->templates['1h3tyj30nc'])->render() ?>

<?php 
			$a = array('comments' => $post->comments);
			$depth = 1;
			if(isset($a["begin"]))
				echo $a["begin"];
			else
				echo "<ol class=\"commentlist\">";

			if(isset($a["childrenClass"]))
				$children = " class=\"$a[childrenClass]\"";
			else
				$children = " class=\"children\"";

			$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($a["comments"]) as $comment):
				if ($comment->depth > $depth){
					echo "<ul{$children}>";
					$depth = $comment->depth;
				}elseif($comment->depth == $depth and !$iterator->isFirst()){
					echo "</li>";
				}elseif($comment->depth < $depth){
					echo "</li>";
					echo str_repeat("</ul></li>", $depth - $comment->depth);
					$depth = $comment->depth;
				}
			 if ($comment->type == 'pingback' or $comment->type == 'trackback'): ?>
			<li class="post pingback">
				<p>
				Pingback
				<?php echo $comment->author->link ?>

<?php WpLatteFunctions::editCommentLink(__("Edit", "ait"), $comment->id, "<span class=\"edit-link\">", "</span>") ?>
				</p>
<?php else: ?>

						<li class="<?php echo htmlSpecialChars($comment->classes) ?>">

				<article id="comment-<?php echo htmlSpecialChars($comment->id) ?>" class="comment">
					
					<div class="comment-content clearfix">
						<div class="comment-avatar left"><?php echo $comment->author->avatar ?></div>
<?php if (!$comment->approved): ?>
							<em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em><br />
<?php else: ?>
							<?php echo $comment->content ?>

<?php endif ?>
					</div>

					<div class="comment-meta clearfix">
						<div class="meta-info author vcard left"><cite class="fn"><?php echo $comment->author->nameWithLink ?></cite></div>
						<div class="meta-info date left"><a href="<?php echo htmlSpecialChars($comment->url) ?>
" class="comment-date"><time pubdate datetime="<?php echo htmlSpecialChars($template->date($comment->date, 'c')) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->date($comment->date, $site->dateFormat), ENT_NOQUOTES) ?>
 at <?php echo NTemplateHelpers::escapeHtml($template->date($comment->date, $site->timeFormat), ENT_NOQUOTES) ?></time></a></div>

						<div class="meta-controls reply right"><?php 
				$a = array('Reply', $comment->args, $comment->depth, $comment->id);
				comment_reply_link(array_merge(
					$a[1],
					array(
						"reply_text" => $a[0],
						"depth" => $a[2],
						"max_depth" => $a[1]["max_depth"]
					)
				), $a[3]); unset($a) ?></div>
						<div class="meta-controls edit right"><?php WpLatteFunctions::editCommentLink(__("Edit", "ait"), $comment->id, "<span class=\"edit-link\">", "</span>") ?></div>
					</div>

				</article>
<?php endif ;
			$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its);
			echo "</li>";
			echo str_repeat("</ul></li>", $depth - 1);
			if(isset($a["end"]))
				echo $a["end"];
			else
				echo "</ol>" ?>

<?php NCoreMacros::includeTemplate("snippets/comments-pagination.php", array('location' => 'below') + $template->getParams(), $_l->templates['1h3tyj30nc'])->render() ?>

<?php elseif (!$post->hasOpenComments && $post->type != 'page' && $post->hasSupportFor('comments')): ?>

	<p class="nocomments">Comments are closed.</p>

<?php endif ?>

<?php comment_form(array()) ?>

<?php else: ?>
	<p class="nopassword">This post is password protected. Enter the password to view any comments.</p>
<?php endif ?>
</div><!-- #comments -->


<?php if ($post->comments && isset($closeable)): ?>
</div> 			<!-- /.closeable -->
<?php endif ;
