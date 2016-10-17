<section class="entry-meta">
	<span class="entry-time"><?php the_time( get_option( 'date_format' ) ); ?></span>
	<span class="entry-author"><?php the_author_posts_link(); ?></span>	
	<?php if ( comments_open( get_the_ID() ) ) :
	echo '<span class="entry-comments-link">';
	comments_popup_link( __( 'Leave your thoughts', 'zb' ), __( '1 Comment', 'zb' ), __( '% Comments', 'zb' ));
	echo '</span>';
	endif; ?>
</section>
