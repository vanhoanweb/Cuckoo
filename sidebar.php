<aside id="sidebar" class="sidebar-primary widget-area" role="complementary" aria-label="Primary Sidebar" itemscope itemtype="http://schema.org/WPSideBar">

	<?php if ( is_active_sidebar( 'main-sidebar' ) ) :

		dynamic_sidebar( 'main-sidebar' );

	else :

		the_widget( 'WP_Widget_Search', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>' );

		the_widget( 'WP_Widget_Recent_Posts', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>' );

		the_widget( 'WP_Widget_Recent_Comments', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>' );

		the_widget( 'WP_Widget_Tag_Cloud', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>' );

	endif; ?>

</aside>
