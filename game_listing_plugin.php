<?php
/*
* Plugin Name: Game Post Type
* Description: Adds Games as a Post Type, as well as shortcodes and widgets for displaying them
* Version: 1.0
* Author: Nabil Sekirime
* Author URI: http://nabilsekirime.com
*/

//Includes all PHP Files in &PluginDirector% /includes/php
  foreach( glob(dirname(__FILE__) . '/includes/*.php') as $class_path )
  		{
  			require_once( $class_path );
  		}

//Include all relevent CSS for the plugin

function enqueue_load_fa()
    {
    wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    }
add_action( 'wp_enqueue_scripts', 'enqueue_load_fa');
