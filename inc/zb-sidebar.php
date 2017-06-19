<?php
// Register Sidebars
function zb_sidebars() {
	$args = array(
		'id'			=> 'main-sidebar',
		'name'			=> __( 'Main Widget Area', 'zero-blank' ),
		'description'	=> __( 'Appears on posts and pages in the sidebar.', 'zero-blank' ),
		'before_title'	=> '<h4 class="widget-title widgettitle">',
		'after_title'	=> '</h4>',
		'before_widget'	=> '<section class="widget %s"><div class="widget-wrap">',
		'after_widget'	=> '</div></section>',
	);
	register_sidebar( $args );

	$args = array(
		'id'			=> 'footer-sidebar-1',
		'name'			=> __( 'Footer Sidebar 1', 'zero-blank' ),
		'description'	=> __( 'Appears in the footer section of the site.', 'zero-blank' ),
		'before_title'	=> '<h4 class="widget-title widgettitle">',
		'after_title'	=> '</h4>',
		'before_widget'	=> '<section class="widget %s"><div class="widget-wrap">',
		'after_widget'	=> '</div></section>',
	);
	register_sidebar( $args );

	$args = array(
		'id'			=> 'footer-sidebar-2',
		'name'			=> __( 'Footer Sidebar 2', 'zero-blank' ),
		'description'	=> __( 'Appears in the footer section of the site.', 'zero-blank' ),
		'before_title'	=> '<h4 class="widget-title widgettitle">',
		'after_title'	=> '</h4>',
		'before_widget'	=> '<section class="widget %s"><div class="widget-wrap">',
		'after_widget'	=> '</div></section>',
	);
	register_sidebar( $args );

	$args = array(
		'id'			=> 'footer-sidebar-3',
		'name'			=> __( 'Footer Sidebar 3', 'zero-blank' ),
		'description'	=> __( 'Appears in the footer section of the site.', 'zero-blank' ),
		'before_title'	=> '<h4 class="widget-title widgettitle">',
		'after_title'	=> '</h4>',
		'before_widget'	=> '<section class="widget %s"><div class="widget-wrap">',
		'after_widget'	=> '</div></section>',
	);
	register_sidebar( $args );
}
add_action( 'widgets_init', 'zb_sidebars' );

/* Register Widget */
class ZBWidget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname' => 'widget_zb_latest_posts',
			'description' => __( 'ZB Latest Posts.' ),
			'customize_selective_refresh' => true );
		parent::__construct( 'zb-latest-posts', __( 'ZB Latest Posts' ), $widget_ops );
		$this->alt_option_name = 'widget_zb_latest_posts';
	}

	// Widget output
	function widget( $args, $instance ) {
		if (!isset($args['widget_id'])) $args['widget_id'] = $this->id;

		$title  = (!empty($instance['title'])) ? $instance['title'] : __( 'ZB Latest Posts' );
		$title  = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		
		$number = (!empty($instance['number'])) ? absint( $instance['number'] ) : 5;
		if (!$number) $number = 5;
		$show_date      = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$show_author    = isset( $instance['show_author'] ) ? $instance['show_author'] : false;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : false;
		
		$latest_posts = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($latest_posts->have_posts()) : ?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) { echo $args['before_title'] . $title . $args['after_title']; } ?>
		<?php while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
			<article <?php post_class('entry'); ?>>
				<?php if ($show_thumbnail) : if (has_post_thumbnail()) : ?>
				<a class="featured-image" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(array(100,100), array('class' => 'entry-image')); ?>
				</a><?php endif; endif; ?>

				<header class="entry-header">
					<h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

					<p class="entry-meta">
						<?php if ( $show_date ) : ?>
						<span class="entry-time">
							<time itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('F jS, Y'); ?></time>
						</span>
						<?php endif; ?>

						<?php if ( $show_author ) : ?>
						<span class="entry-author" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
							<em><?php _e('by ', 'zero-blank'); ?></em><?php the_author_posts_link(); ?>
						</span>
						<?php endif; ?>
					</p>
				</header>
			</article>
		<?php endwhile; ?>
		<?php echo $args['after_widget']; ?>
		<?php wp_reset_postdata();
		endif;
	}

	// Save widget options
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']          = sanitize_text_field( $new_instance['title'] );
		$instance['number']         = (int) $new_instance['number'];
		$instance['show_date']      = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_author']    = isset( $new_instance['show_author'] ) ? (bool) $new_instance['show_author'] : false;
		$instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
		return $instance;
	}

	// Output admin widget options form
	function form( $instance ) {
		$title          = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number         = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date      = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_author    = isset( $instance['show_author'] ) ? (bool) $instance['show_author'] : false;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : false; ?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date' ); ?></label><br/>

			<input class="checkbox" type="checkbox"<?php checked( $show_author ); ?> id="<?php echo $this->get_field_id( 'show_author' ); ?>" name="<?php echo $this->get_field_name( 'show_author' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_author' ); ?>"><?php _e( 'Display author' ); ?></label><br/>

			<input class="checkbox" type="checkbox"<?php checked( $show_thumbnail ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php _e( 'Display thumbnail' ); ?></label><br/>
		</p>
<?php
	}
}

function zb_register_widgets() {
	register_widget( 'ZBWidget' );
}

add_action( 'widgets_init', 'zb_register_widgets' );
