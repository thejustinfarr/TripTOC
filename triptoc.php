<?php
/*
Plugin Name: Trip TOC
Plugin URI: 
Description: Making it easy for travel bloggers to add a table of contents to posts that belong to a series.
Author: Josh, Denny, & Justin from Frequent Flyer Services
Version: 1.0
Author URI: http://justinfarrdesigns.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Includes all files from the easytocFILES subfolder
foreach ( glob( plugin_dir_path( __FILE__ ) . "triptocFILES/*.php" ) as $file ) {
    include_once $file;
}