<?php
///Register Video Games as a Post type

function cptui_register_my_cpts_video_games() {

	/**
	 * Post Type: Games.
	 */

	$labels = array(
		"name" => __( "Games", "astra" ),
		"singular_name" => __( "Game", "astra" ),
		"menu_name" => __( "Video Games", "astra" ),
		"all_items" => __( "All Games", "astra" ),
		"add_new" => __( "Add New", "astra" ),
		"add_new_item" => __( "Add New Game", "astra" ),
		"edit_item" => __( "Edit Game", "astra" ),
		"new_item" => __( "New Game", "astra" ),
		"view_item" => __( "View Game", "astra" ),
		"view_items" => __( "View Games", "astra" ),
		"search_items" => __( "Search Games", "astra" ),
		"not_found" => __( "No Games Found", "astra" ),
		"not_found_in_trash" => __( "No Games Found in Trash", "astra" ),
		"parent_item_colon" => __( "Parent Game", "astra" ),
		"featured_image" => __( "Cover Art", "astra" ),
		"set_featured_image" => __( "Set Cover Art", "astra" ),
		"remove_featured_image" => __( "Remove Cover Art", "astra" ),
		"use_featured_image" => __( "Use Cover Art", "astra" ),
		"archives" => __( "Game List", "astra" ),
		"insert_into_item" => __( "Insert into game", "astra" ),
		"uploaded_to_this_item" => __( "Uploaded to this game", "astra" ),
		"filter_items_list" => __( "Filter game list", "astra" ),
		"items_list_navigation" => __( "Game list navigation", "astra" ),
		"items_list" => __( "Game List", "astra" ),
		"attributes" => __( "Game Attributes", "astra" ),
		"parent_item_colon" => __( "Parent Game", "astra" ),
	);

	$args = array(
		"label" => __( "Games", "astra" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "video_games", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "https://gamedevknights.com/wp-content/uploads/2018/09/snes-8-407848-1.png",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "video_games", $args );
}

add_action( 'init', 'cptui_register_my_cpts_video_games' );
