<?php
// Register Sidebars
function ck_sidebars() {
	$args = array(
		'id'			=> 'main-sidebar',
		'name'			=> __( 'Main Widget Area', 'cuckoo' ),
		'description'	=> __( 'Appears on posts and pages in the sidebar.', 'cuckoo' ),
		'before_title'	=> '<h4 class="widget-title widgettitle">',
		'after_title'	=> '</h4>',
		'before_widget'	=> '<section class="widget %s"><div class="widget-wrap">',
		'after_widget'	=> '</div></section>',
	);
	register_sidebar( $args );

	$args = array(
		'id'			=> 'footer-sidebar-1',
		'name'			=> __( 'Footer Sidebar 1', 'cuckoo' ),
		'description'	=> __( 'Appears in the footer section of the site.', 'cuckoo' ),
		'before_title'	=> '<h4 class="widget-title widgettitle">',
		'after_title'	=> '</h4>',
		'before_widget'	=> '<section class="widget %s"><div class="widget-wrap">',
		'after_widget'	=> '</div></section>',
	);
	register_sidebar( $args );

	$args = array(
		'id'			=> 'footer-sidebar-2',
		'name'			=> __( 'Footer Sidebar 2', 'cuckoo' ),
		'description'	=> __( 'Appears in the footer section of the site.', 'cuckoo' ),
		'before_title'	=> '<h4 class="widget-title widgettitle">',
		'after_title'	=> '</h4>',
		'before_widget'	=> '<section class="widget %s"><div class="widget-wrap">',
		'after_widget'	=> '</div></section>',
	);
	register_sidebar( $args );

	$args = array(
		'id'			=> 'footer-sidebar-3',
		'name'			=> __( 'Footer Sidebar 3', 'cuckoo' ),
		'description'	=> __( 'Appears in the footer section of the site.', 'cuckoo' ),
		'before_title'	=> '<h4 class="widget-title widgettitle">',
		'after_title'	=> '</h4>',
		'before_widget'	=> '<section class="widget %s"><div class="widget-wrap">',
		'after_widget'	=> '</div></section>',
	);
	register_sidebar( $args );
}
add_action( 'widgets_init', 'ck_sidebars' );
