<?php
// Enclosing shortcode: [column col=""]content[/column]
function zb_column_shortcode($atts , $content = null) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'col' => '',
		),
		$atts,
		'column'
	);
	
	// Return code
	return '<div class="'. $atts['col'] .'">'. $content .'</div>';
}
add_shortcode('column', 'zb_column_shortcode');

// shortcode: zb popular posts: [zb_popular_posts num="10" cat="1,2,3"]
function zb_display_popular_posts($atts) {
	
	extract(shortcode_atts(array(
		'num' => 10,
		'cat' => '',
	), $atts)); 
	
	$temps = explode(',', $cat);
	$array = array();
	foreach ($temps as $temp) $array[] = trim($temp);
	
	$cats = !empty($cat) ? $array : ''; ?>
	
	<h4>Popular Posts</h4>
	<ul>
		<?php $popular = new WP_Query(array('posts_per_page' => $num, 'meta_key' => 'hit_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'category__in' => $cats));
		while ($popular->have_posts()) : $popular->the_post(); ?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile; wp_reset_postdata(); ?>
	</ul>
	
<?php }
add_shortcode('zb_popular_posts', 'zb_display_popular_posts');
