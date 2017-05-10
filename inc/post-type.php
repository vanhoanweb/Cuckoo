<?php
// Add custom post type
add_action('init', 'zb_post_type');

function zb_post_type() {
	$labels = array(
		'name'					=>	__( 'ZB Custom Posts', 'zero-blank' ),
		'singular_name'			=>	__( 'ZB Custom Post', 'zero-blank' ),
		'menu_name'				=>	__( 'ZB Custom Posts', 'zero-blank' ),
		'name_admin_bar'		=>	__( 'ZB Custom Post', 'zero-blank' ),
		'add_new'				=>	__( 'Add New', 'ZB Custom Post', 'zero-blank' ),
		'add_new_item'			=>	__( 'Add New ZB Custom Post', 'zero-blank' ),
		'new_item'				=>	__( 'New ZB Custom Post', 'zero-blank' ),
		'edit_item'				=>	__( 'Edit ZB Custom Post', 'zero-blank' ),
		'view_item'				=>	__( 'View ZB Custom Post', 'zero-blank' ),
		'all_items'				=>	__( 'All ZB Custom Posts', 'zero-blank' ),
		'search_items'			=>	__( 'Search ZB Custom Posts', 'zero-blank' ),
		'parent_item_colon'		=>	__( 'Parent ZB Custom Posts:', 'zero-blank' ),
		'not_found'				=>	__( 'No ZB Custom Posts found.', 'zero-blank' ),
		'not_found_in_trash'	=>	__( 'No ZB Custom Posts found in Trash.', 'zero-blank' )
	);
	$args = array(
		'labels'				=>	$labels,
		'description'			=>	__( 'Description.', 'zero-blank' ),
		'public'				=>	true,
		'publicly_queryable'	=>	true,
		'show_ui'				=>	true,
		'show_in_menu'			=>	true,
		'query_var'				=>	true,
		'rewrite'				=>	array( 'slug' => 'zb-post' ),
		'capability_type'		=>	'post',
		'has_archive'			=>	true,
		'hierarchical'			=>	false,
		'menu_position'			=>	null,
		'supports'				=>	array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	register_post_type( 'zb-post', $args );
}

// Add taxonomies
add_action( 'init', 'zb_taxonomies', 0 );

function zb_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'				=>	__( 'ZB Categories', 'taxonomy general name', 'zero-blank' ),
		'singular_name'		=>	__( 'ZB Category', 'taxonomy singular name', 'zero-blank' ),
		'search_items'		=>	__( 'Search ZB Categories', 'zero-blank' ),
		'all_items'			=>	__( 'All ZB Categories', 'zero-blank' ),
		'parent_item'		=>	__( 'Parent ZB Category', 'zero-blank' ),
		'parent_item_colon'	=>	__( 'Parent ZB Category:', 'zero-blank' ),
		'edit_item'			=>	__( 'Edit ZB Category', 'zero-blank' ),
		'update_item'		=>	__( 'Update ZB Category', 'zero-blank' ),
		'add_new_item'		=>	__( 'Add New ZB Category', 'zero-blank' ),
		'new_item_name'		=>	__( 'New ZB Category Name', 'zero-blank' ),
		'menu_name'			=>	__( 'ZB Category', 'zero-blank' ),
	);
	$args = array(
		'hierarchical'		=> true,
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_admin_column'	=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'zb_category' ),
	);
	register_taxonomy( 'zb_category', array( 'zb-post' ), $args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'							=>	__( 'ZB Tags', 'zero-blank' ),
		'singular_name'					=>	__( 'ZB Tag', 'zero-blank' ),
		'search_items'					=>	__( 'Search ZB Tags', 'zero-blank' ),
		'popular_items'					=>	__( 'Popular ZB Tags', 'zero-blank' ),
		'all_items'						=>	__( 'All ZB Tags', 'zero-blank' ),
		'parent_item'					=>	null,
		'parent_item_colon'				=>	null,
		'edit_item'						=>	__( 'Edit ZB Tag', 'zero-blank' ),
		'update_item'					=>	__( 'Update ZB Tag', 'zero-blank' ),
		'add_new_item'					=>	__( 'Add New ZB Tag', 'zero-blank' ),
		'new_item_name'					=>	__( 'New ZB Tag Name', 'zero-blank' ),
		'separate_items_with_commas'	=>	__( 'Separate ZB Tags with commas', 'zero-blank' ),
		'add_or_remove_items'			=>	__( 'Add or remove ZB Tags', 'zero-blank' ),
		'choose_from_most_used'			=>	__( 'Choose from the most used ZB Tags', 'zero-blank' ),
		'not_found'						=>	__( 'No ZB Tags found.', 'zero-blank' ),
		'menu_name'						=>	__( 'ZB Tags', 'zero-blank' ),
	);
	$args = array(
		'hierarchical'			=>	false,
		'labels'				=>	$labels,
		'show_ui'				=>	true,
		'show_admin_column'		=>	true,
		'update_count_callback'	=>	'_update_post_term_count',
		'query_var'				=>	true,
		'rewrite'				=>	array( 'slug' => 'zb_tag' ),
	);
	register_taxonomy( 'zb_tag', 'zb-post', $args );
}
