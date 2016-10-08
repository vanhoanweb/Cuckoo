<section class="entry-meta">
	<span class="author vcard"><?php the_author_posts_link(); ?></span>
	<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
	<?php if ( comments_open( get_the_ID() ) ) :
	echo '<span class="comments-link">';
	comments_popup_link( __( 'Leave your thoughts', 'zb' ), __( '1 Comment', 'zb' ), __( '% Comments', 'zb' ));
	echo '</span>';
	endif; ?>
</section>
