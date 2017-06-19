<div id="comments" class="entry-comments">

	<?php if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		die (__('Please do not load this page directly. Thanks!', 'zero-blank'));
	}

	if (post_password_required()) {
		echo '<p class="alert">'. __('This post is password protected. Enter the password to view comments.', 'zero-blank') .'</p>';
		return;
	} ?>

	<?php if (have_comments()) : ?>

		<div class="comment-intro">
			<span class="num-comment">
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

<?php
$fields =  array(
	'author'	=>	'<p class="comment-form-author"><label for="author">' . __( 'Name', 'zero-blank' ) . '</label> ' .
				( $req ? '<span class="required">*</span>' : '' ) .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30"' . $aria_req . ' placeholder="Name" required/></p>',

	'email'		=>	'<p class="comment-form-email"><label for="email">' . __( 'Email', 'zero-blank' ) . '</label> ' .
				( $req ? '<span class="required">*</span>' : '' ) .
				'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30"' . $aria_req . ' placeholder="Email" required/></p>',

	'url' 		=>	'<p class="comment-form-url"><label for="url">' . __( 'Website', 'zero-blank' ) . '</label>' .
				'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
				'" size="30" placeholder="Website" required/></p>',
);

$args = array(
	'id_form'				=>	'commentform',
	'class_form'			=>	'comment-form',
	'id_submit'				=>	'submit',
	'class_submit'			=>	'submit',
	'name_submit'			=>	'submit',
	'title_reply'			=>	__( 'Leave a Reply' ),
	'title_reply_to'		=>	__( 'Leave a Reply to %s' ),
	'cancel_reply_link'		=>	__( 'Cancel Reply' ),
	'label_submit'			=>	__( 'Post Comment' ),
	'format'				=>	'xhtml',
	'comment_field'			=>	'<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
								'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Comment" required>' .
								'</textarea></p>',
	'must_log_in'			=>	'<p class="must-log-in">' .
								sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
								wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
								) . '</p>',
	'logged_in_as'			=>	'<p class="logged-in-as">' .
								sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
								admin_url( 'profile.php' ),
								$user_identity,
								wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
								) . '</p>',
	'comment_notes_before'	=>	'<p class="comment-notes">' .
								__( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) .
								'</p>',
	'comment_notes_after'	=>	'<p class="form-allowed-tags">' .
								sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
								' <code>' . allowed_tags() . '</code>'
								) . '</p>',
	'fields'				=>	apply_filters( 'comment_form_default_fields', $fields ),
); ?>

<?php if (comments_open()) comment_form($args);
