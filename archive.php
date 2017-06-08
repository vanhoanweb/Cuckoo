<?php get_header(); ?>
	
<main class="content-main">

	<?php if (have_posts()) : ?>
		
 		<?php if (is_category()) { ?>
	 		<div class="archive-description taxonomy-archive-description taxonomy-description">
	 			<h1 class="archive-title"><?php single_cat_title(); ?></h1>
	 			<?php echo category_description(); ?>
	 		</div>
		
		<?php } elseif(is_tag()) { ?>
			<div class="archive-description taxonomy-archive-description taxonomy-description">
	 			<h1 class="archive-title"><?php single_tag_title(); ?></h1>
	 			<?php echo tag_description(); ?>
	 		</div>

		<?php } elseif (is_day()) { ?>
			<div class="archive-description date-archive-description archive-date">
				<h1 class="archive-title"><?php _e('Archives for ', 'zero-blank'); ?><?php the_time('F jS, Y'); ?></h1>
			</div>
		
		<?php } elseif (is_month()) { ?>
			<div class="archive-description date-archive-description archive-date">
				<h1 class="archive-title"><?php _e('Archives for ', 'zero-blank'); ?><?php the_time('F, Y'); ?></h1>
			</div>
		
		<?php } elseif (is_year()) { ?>
			<div class="archive-description date-archive-description archive-date">
				<h1 class="archive-title"><?php _e('Archives for ', 'zero-blank'); ?><?php the_time('Y'); ?></h1>
			</div>
		
		<?php } elseif (is_author()) { ?>
			<section class="author-box">
				<div class="author-box-avatar">
					<?php echo get_avatar(get_the_author_meta('user_email') , 90); ?>
				</div>
				<h1 class="author-box-title">
					<?php _e('About ', 'zero-blank'); ?><?php the_post(); echo get_the_author(); rewind_posts(); ?>
				</h1>
				<div class="author-box-content"><p><?php the_author_meta('description'); ?></p></div>
			</section>
		
		<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		
		<h2><?php _e('Blog Archives', 'zero-blank'); ?></h2>
		
		<?php } ?>
		
		<?php get_template_part('inc/content'); ?>
		
	<?php else : ?>
		
		<?php get_template_part('inc/not-found'); ?>
		
	<?php endif; ?>

</main>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
