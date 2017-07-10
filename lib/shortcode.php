<?php
// Enclosing shortcode: [div col=""]content[/div]
function ck_columns( $atts , $content = null ) {
	// Attributes
	$atts = shortcode_atts( array( 'col' => '' ), $atts, 'div' );

	// Return code
	return '<div class="' . $atts['col'] . '">' . $content . '</div>';
}
add_shortcode( 'div', 'ck_columns' );

// Shortcode: [post_share position="bottom"]
function ck_post_share( $atts ) {
	$atts = shortcode_atts( array( 'position' => '' ), $atts, 'post_share' ); ?>

	<div class="post-share <?php echo $atts['position'] ?>">
		<ul class="social-share-list">
			<li class="social-item facebook">
				<a rel="nofollow" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>&amp;t=<?php the_title() ?>"><span class="dashicons dashicons-facebook-alt"></span></a>
			</li>
			<li class="social-item twitter">
				<a rel="nofollow" target="_blank" href="https://twitter.com/share?url=<?php the_permalink() ?>&amp;text=<?php the_title() ?>"><span class="dashicons dashicons-twitter"></span></a>
			</li>
			<li class="social-item googleplus">
				<a rel="nofollow" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink() ?>"><span class="dashicons dashicons-googleplus"></span></a>
			</li>
			<li class="social-item email">
				<a rel="nofollow" target="_blank" href="mailto:?subject=<?php the_title() ?>&amp;body=<?php the_permalink() ?>"><span class="dashicons dashicons-email-alt"></span></a>
			</li>
		</ul>
	</div>

<?php }
add_shortcode( 'post_share', 'ck_post_share' );
