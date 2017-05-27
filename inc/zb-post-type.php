<?php
// Register Custom Post Type
function zb_post_type() {
	$labels = array(
		'name'					=> _x( 'ZB Custom Posts', 'Post Type General Name', 'zero-blank' ),
		'singular_name'			=> _x( 'ZB Custom Post', 'Post Type Singular Name', 'zero-blank' ),
		'menu_name'				=> __( 'ZB Custom Posts', 'zero-blank' ),
		'name_admin_bar'		=> __( 'ZB Custom Post', 'zero-blank' ),
		'archives'				=> __( 'Item Archives', 'zero-blank' ),
		'attributes'			=> __( 'Item Attributes', 'zero-blank' ),
		'parent_item_colon'		=> __( 'Parent Item:', 'zero-blank' ),
		'all_items'				=> __( 'All Items', 'zero-blank' ),
		'add_new_item'			=> __( 'Add New Item', 'zero-blank' ),
		'add_new'				=> __( 'Add New', 'zero-blank' ),
		'new_item'				=> __( 'New Item', 'zero-blank' ),
		'edit_item'				=> __( 'Edit Item', 'zero-blank' ),
		'update_item'			=> __( 'Update Item', 'zero-blank' ),
		'view_item'				=> __( 'View Item', 'zero-blank' ),
		'view_items'			=> __( 'View Items', 'zero-blank' ),
		'search_items'			=> __( 'Search Item', 'zero-blank' ),
		'not_found'				=> __( 'Not found', 'zero-blank' ),
		'not_found_in_trash'	=> __( 'Not found in Trash', 'zero-blank' ),
		'featured_image'		=> __( 'Featured Image', 'zero-blank' ),
		'set_featured_image'	=> __( 'Set featured image', 'zero-blank' ),
		'remove_featured_image'	=> __( 'Remove featured image', 'zero-blank' ),
		'use_featured_image'	=> __( 'Use as featured image', 'zero-blank' ),
		'insert_into_item'		=> __( 'Insert into item', 'zero-blank' ),
		'uploaded_to_this_item'	=> __( 'Uploaded to this item', 'zero-blank' ),
		'items_list'			=> __( 'Items list', 'zero-blank' ),
		'items_list_navigation'	=> __( 'Items list navigation', 'zero-blank' ),
		'filter_items_list'		=> __( 'Filter items list', 'zero-blank' )
	);
	$rewrite = array(
		'slug'					=> 'zb_post',
		'with_front'			=> true,
		'pages'					=> true,
		'feeds'					=> true
	);
	$args = array(
		'label'					=> __( 'ZB Custom Post', 'zero-blank' ),
		'description'			=> __( 'ZB Custom Post Description', 'zero-blank' ),
		'labels'				=> $labels,
		'supports'				=> array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', 'post-formats', ),
		'taxonomies'			=> array( 'category', 'post_tag' ),
		'hierarchical'			=> false, // false - like posts; true - like pages
		'public'				=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'menu_position'			=> 5, // 5, 10 - below Posts; 15 - Links; 20 - Pages; 25 - Comments; 65 - Plugins; 70 - Users; 75 - Tools
		'menu_icon'				=> 'dashicons-welcome-write-blog',
		'show_in_admin_bar'		=> true,
		'show_in_nav_menus'		=> true,
		'can_export'			=> true,
		'has_archive'			=> true,        
		'exclude_from_search'	=> false,
		'publicly_queryable'	=> true,
		'rewrite'				=> $rewrite,
		'capability_type'		=> 'post'
	);
	register_post_type( 'zb_post', $args );
}
add_action('init', 'zb_post_type', 0);

// Register Custom Taxonomy
function zb_taxonomy() {
	$labels = array(
		'name'							=> _x( 'ZB Categories', 'Taxonomy General Name', 'zero-blank' ),
		'singular_name'					=> _x( 'ZB Category', 'Taxonomy Singular Name', 'zero-blank' ),
		'menu_name'						=> __( 'ZB Category', 'zero-blank' ),
		'all_items'						=> __( 'All Items', 'zero-blank' ),
		'parent_item'					=> __( 'Parent Item', 'zero-blank' ),
		'parent_item_colon'				=> __( 'Parent Item:', 'zero-blank' ),
		'new_item_name'					=> __( 'New Item Name', 'zero-blank' ),
		'add_new_item'					=> __( 'Add New Item', 'zero-blank' ),
		'edit_item'						=> __( 'Edit Item', 'zero-blank' ),
		'update_item'					=> __( 'Update Item', 'zero-blank' ),
		'view_item'						=> __( 'View Item', 'zero-blank' ),
		'separate_items_with_commas'	=> __( 'Separate items with commas', 'zero-blank' ),
		'add_or_remove_items'			=> __( 'Add or remove items', 'zero-blank' ),
		'choose_from_most_used'			=> __( 'Choose from the most used', 'zero-blank' ),
		'popular_items'					=> __( 'Popular Items', 'zero-blank' ),
		'search_items'					=> __( 'Search Items', 'zero-blank' ),
		'not_found'						=> __( 'Not Found', 'zero-blank' ),
		'no_terms'						=> __( 'No items', 'zero-blank' ),
		'items_list'					=> __( 'Items list', 'zero-blank' ),
		'items_list_navigation'			=> __( 'Items list navigation', 'zero-blank' )
	);
	$rewrite = array(
		'slug'							=> 'zb_category',
		'with_front'					=> true,
		'hierarchical'					=> true
	);
	$args = array(
		'labels'						=> $labels,
		'hierarchical'					=> true,
		'public'						=> true,
		'show_ui'						=> true,
		'show_admin_column'				=> true,
		'show_in_nav_menus'				=> true,
		'show_tagcloud'					=> true,
		'query_var'						=> true,
		'rewrite'						=> $rewrite
	);
	register_taxonomy( 'zb_category', array( 'zb_post' ), $args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'							=> _x( 'ZB Tags', 'Taxonomy General Name', 'zero-blank' ),
		'singular_name'					=> _x( 'ZB Tag', 'Taxonomy Singular Name', 'zero-blank' ),
		'menu_name'						=> __( 'ZB Tag', 'zero-blank' ),
		'all_items'						=> __( 'All Items', 'zero-blank' ),
		'parent_item'					=> __( 'Parent Item', 'zero-blank' ),
		'parent_item_colon'				=> __( 'Parent Item:', 'zero-blank' ),
		'new_item_name'					=> __( 'New Item Name', 'zero-blank' ),
		'add_new_item'					=> __( 'Add New Item', 'zero-blank' ),
		'edit_item'						=> __( 'Edit Item', 'zero-blank' ),
		'update_item'					=> __( 'Update Item', 'zero-blank' ),
		'view_item'						=> __( 'View Item', 'zero-blank' ),
		'separate_items_with_commas'	=> __( 'Separate items with commas', 'zero-blank' ),
		'add_or_remove_items'			=> __( 'Add or remove items', 'zero-blank' ),
		'choose_from_most_used'			=> __( 'Choose from the most used', 'zero-blank' ),
		'popular_items'					=> __( 'Popular Items', 'zero-blank' ),
		'search_items'					=> __( 'Search Items', 'zero-blank' ),
		'not_found'						=> __( 'Not Found', 'zero-blank' ),
		'no_terms'						=> __( 'No items', 'zero-blank' ),
		'items_list'					=> __( 'Items list', 'zero-blank' ),
		'items_list_navigation'			=> __( 'Items list navigation', 'zero-blank' )
	);
	$rewrite = array(
		'slug'							=> 'zb_tag',
		'with_front'					=> true,
		'hierarchical'					=> true
	);
	$args = array(
		'labels'						=> $labels,
		'hierarchical'					=> false,
		'public'						=> true,
		'show_ui'						=> true,
		'show_admin_column'				=> true,
		'show_in_nav_menus'				=> true,
		'show_tagcloud'					=> true,
		'query_var'						=> true,
		'rewrite'						=> $rewrite
	);
	register_taxonomy( 'zb_tag', array( 'zb_post' ), $args );
}
add_action( 'init', 'zb_taxonomy', 0 );
