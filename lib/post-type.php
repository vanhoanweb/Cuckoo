<?php
// Register Custom Post Type
function ck_post_type() {
	$labels = array(
		'name'					=> __( 'CK Custom Posts', 'cuckoo' ),
		'singular_name'			=> __( 'CK Custom Post', 'cuckoo' ),
		'menu_name'				=> __( 'CK Custom Posts', 'cuckoo' ),
		'name_admin_bar'		=> __( 'CK Custom Post', 'cuckoo' ),
		'archives'				=> __( 'Item Archives', 'cuckoo' ),
		'attributes'			=> __( 'Item Attributes', 'cuckoo' ),
		'parent_item_colon'		=> __( 'Parent Item:', 'cuckoo' ),
		'all_items'				=> __( 'All Items', 'cuckoo' ),
		'add_new_item'			=> __( 'Add New Item', 'cuckoo' ),
		'add_new'				=> __( 'Add New', 'cuckoo' ),
		'new_item'				=> __( 'New Item', 'cuckoo' ),
		'edit_item'				=> __( 'Edit Item', 'cuckoo' ),
		'update_item'			=> __( 'Update Item', 'cuckoo' ),
		'view_item'				=> __( 'View Item', 'cuckoo' ),
		'view_items'			=> __( 'View Items', 'cuckoo' ),
		'search_items'			=> __( 'Search Item', 'cuckoo' ),
		'not_found'				=> __( 'Not found', 'cuckoo' ),
		'not_found_in_trash'	=> __( 'Not found in Trash', 'cuckoo' ),
		'featured_image'		=> __( 'Featured Image', 'cuckoo' ),
		'set_featured_image'	=> __( 'Set featured image', 'cuckoo' ),
		'remove_featured_image'	=> __( 'Remove featured image', 'cuckoo' ),
		'use_featured_image'	=> __( 'Use as featured image', 'cuckoo' ),
		'insert_into_item'		=> __( 'Insert into item', 'cuckoo' ),
		'uploaded_to_this_item'	=> __( 'Uploaded to this item', 'cuckoo' ),
		'items_list'			=> __( 'Items list', 'cuckoo' ),
		'items_list_navigation'	=> __( 'Items list navigation', 'cuckoo' ),
		'filter_items_list'		=> __( 'Filter items list', 'cuckoo' )
	);
	$rewrite = array(
		'slug'					=> 'ckpt',
		'with_front'			=> true,
		'pages'					=> true,
		'feeds'					=> true
	);
	$args = array(
		'label'					=> __( 'CK Custom Post', 'cuckoo' ),
		'description'			=> __( 'CK Custom Post Description', 'cuckoo' ),
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
	register_post_type( 'ckpt', $args );
}
add_action( 'init', 'ck_post_type', 0 );

// Register Custom Taxonomy
function ck_taxonomy() {
	$labels = array(
		'name'							=> __( 'CK Categories', 'cuckoo' ),
		'singular_name'					=> __( 'CK Category', 'cuckoo' ),
		'menu_name'						=> __( 'CK Category', 'cuckoo' ),
		'all_items'						=> __( 'All Items', 'cuckoo' ),
		'parent_item'					=> __( 'Parent Item', 'cuckoo' ),
		'parent_item_colon'				=> __( 'Parent Item:', 'cuckoo' ),
		'new_item_name'					=> __( 'New Item Name', 'cuckoo' ),
		'add_new_item'					=> __( 'Add New Item', 'cuckoo' ),
		'edit_item'						=> __( 'Edit Item', 'cuckoo' ),
		'update_item'					=> __( 'Update Item', 'cuckoo' ),
		'view_item'						=> __( 'View Item', 'cuckoo' ),
		'separate_items_with_commas'	=> __( 'Separate items with commas', 'cuckoo' ),
		'add_or_remove_items'			=> __( 'Add or remove items', 'cuckoo' ),
		'choose_from_most_used'			=> __( 'Choose from the most used', 'cuckoo' ),
		'popular_items'					=> __( 'Popular Items', 'cuckoo' ),
		'search_items'					=> __( 'Search Items', 'cuckoo' ),
		'not_found'						=> __( 'Not Found', 'cuckoo' ),
		'no_terms'						=> __( 'No items', 'cuckoo' ),
		'items_list'					=> __( 'Items list', 'cuckoo' ),
		'items_list_navigation'			=> __( 'Items list navigation', 'cuckoo' )
	);
	$rewrite = array(
		'slug'							=> 'ck_category',
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
	register_taxonomy( 'ck_category', array( 'ckpt' ), $args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'							=> __( 'CK Tags', 'cuckoo' ),
		'singular_name'					=> __( 'CK Tag', 'cuckoo' ),
		'menu_name'						=> __( 'CK Tag', 'cuckoo' ),
		'all_items'						=> __( 'All Items', 'cuckoo' ),
		'parent_item'					=> __( 'Parent Item', 'cuckoo' ),
		'parent_item_colon'				=> __( 'Parent Item:', 'cuckoo' ),
		'new_item_name'					=> __( 'New Item Name', 'cuckoo' ),
		'add_new_item'					=> __( 'Add New Item', 'cuckoo' ),
		'edit_item'						=> __( 'Edit Item', 'cuckoo' ),
		'update_item'					=> __( 'Update Item', 'cuckoo' ),
		'view_item'						=> __( 'View Item', 'cuckoo' ),
		'separate_items_with_commas'	=> __( 'Separate items with commas', 'cuckoo' ),
		'add_or_remove_items'			=> __( 'Add or remove items', 'cuckoo' ),
		'choose_from_most_used'			=> __( 'Choose from the most used', 'cuckoo' ),
		'popular_items'					=> __( 'Popular Items', 'cuckoo' ),
		'search_items'					=> __( 'Search Items', 'cuckoo' ),
		'not_found'						=> __( 'Not Found', 'cuckoo' ),
		'no_terms'						=> __( 'No items', 'cuckoo' ),
		'items_list'					=> __( 'Items list', 'cuckoo' ),
		'items_list_navigation'			=> __( 'Items list navigation', 'cuckoo' )
	);
	$rewrite = array(
		'slug'							=> 'ck_tag',
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
	register_taxonomy( 'ck_tag', array( 'ckpt' ), $args );
}
add_action( 'init', 'ck_taxonomy', 0 );
