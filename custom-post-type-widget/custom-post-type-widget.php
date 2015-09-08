<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the
 * plugin admin area. This file also includes all of the dependencies used by
 * the plugin, and creates a instance of the core plugin class.
 *
 * LICENSE: http://opensource.org/licenses/MIT
 *
 * @category   WP_Plugin
 * @package    CustomPostType_Widget
 * @subpackage CustomPostType_Widget/Bootstrap
 * @copyright  Copyright (c) 2015 Jimmi Elofsson <contact@jimmi.eu>
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @version    $Id:$
 * @link       https://github.com/jelofsson
 * @since      Version 1.0.0
 *
 * @wordpress-plugin
 * Plugin Name: Custom Post Type Widget
 * Description: Create custom posts and display them trough a widget
 * Version: 1.0.0
 * Author: Jimmi Elofsson
 * Author URI: http://www.jimmi.eu/
 * License: MIT
 */

/*
 * If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' )) {
	die;
}

/**
 * Loading the core class of our plugin, located in Plugin.php
 * TODO: fix a __autoload function
 */
require plugin_dir_path( __FILE__ ) . 'Plugin.php';
// creating an instance of our plugin
$plugin = new Plugin();