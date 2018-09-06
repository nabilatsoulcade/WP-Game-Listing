<?php
///Registers Video Game Taxonomies

// Register Taxonomy Platform
// Taxonomy Key: platform
function create_platform_tax() {

	$labels = array(
		'name'              => _x( 'Platforms', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Platform', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Platforms', 'textdomain' ),
		'all_items'         => __( 'All Platforms', 'textdomain' ),
		'parent_item'       => __( 'Parent Platform', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Platform:', 'textdomain' ),
		'edit_item'         => __( 'Edit Platform', 'textdomain' ),
		'update_item'       => __( 'Update Platform', 'textdomain' ),
		'add_new_item'      => __( 'Add New Platform', 'textdomain' ),
		'new_item_name'     => __( 'New Platform Name', 'textdomain' ),
		'menu_name'         => __( 'Platform', 'textdomain' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( 'The systems in which a game is played on', 'textdomain' ),
		'hierarchical' => false,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_rest' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
	);
	register_taxonomy( 'platform', array('video_game', ), $args );

}
add_action( 'init', 'create_platform_tax' );

// Register Taxonomy Genre
// Taxonomy Key: genre
function create_genre_tax() {

	$labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Genres', 'textdomain' ),
		'all_items'         => __( 'All Genres', 'textdomain' ),
		'parent_item'       => __( 'Parent Genre', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
		'edit_item'         => __( 'Edit Genre', 'textdomain' ),
		'update_item'       => __( 'Update Genre', 'textdomain' ),
		'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
		'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
		'menu_name'         => __( 'Genre', 'textdomain' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( 'A classification assigned to a video game based on its gameplay interaction', 'textdomain' ),
		'hierarchical' => false,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_rest' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
	);
	register_taxonomy( 'genre', array('video_game', ), $args );

}
add_action( 'init', 'create_genre_tax' );
