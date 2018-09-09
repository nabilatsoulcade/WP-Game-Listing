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
