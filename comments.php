<div id="comments" class="entry-comments">

	<?php if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		die (__('Please do not load this page directly. Thanks!', 'zero-blank'));
	}

	if (post_password_required()) {
		echo '<p class="alert">'. __('This post is password protected. Enter the password to view comments.', 'zero-blank') .'</p>';
		return;
	} ?>

	<?php if (have_comments()) : ?>

		<div class="comments-intro">
			<span class="num-comments">
				<?php comments_number('Leave a comment', '1 Comment', '% Comments'); ?>
			</span>
			<a href="#respond" class="leave-comment" rel="nofollow"><?php _e('Leave a Reply', 'zero-blank'); ?></a>
		</div>
		
		<div class="navigation">
			<div class="next-posts"><?php previous_comments_link(); ?></div>
			<div class="prev-posts"><?php next_comments_link(); ?></div>		
		</div>
		
		<ol class="comment-list">
			<?php wp_list_comments('type=comment&callback=zb_comments'); // Custom callback in functions.php ?>
		</ol>

		<div class="navigation">
			<div class="next-posts"><?php previous_comments_link(); ?></div>
			<div class="prev-posts"><?php next_comments_link(); ?></div>		
		</div>
	
	<?php else : // this is displayed if there are no comments so far ?>
		<?php if (comments_open()) : ?>			
			<!-- If comments are open, but there are no comments. -->			
		 <?php else : // comments are closed ?>		 	
			<p><?php _e('Comments are closed.', 'zero-blank'); ?></p>			
		<?php endif; ?>		
	<?php endif; ?>

</div>

<?php if (comments_open()) comment_form();
