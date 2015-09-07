<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * and creates a instance of the core plugin class.
 *
 * LICENSE: http://opensource.org/licenses/MIT
 *
 * @category   WP_Plugin
 * @package    Portfolio_Widget_Plugin
 * @subpackage Portfolio_Widget_Plugin/Bootstrap
 * @copyright  Copyright (c) 2015 Jimmi Elofsson <contact@jimmi.eu>
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @version    $Id:$
 * @link       https://github.com/jelofsson
 * @since      Version 1.0.0
 *
 * @wordpress-plugin
 * Plugin Name: Portfolio Widget Plugin
 * Description: Publish and display portfolio items
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
 */
require plugin_dir_path( __FILE__ ) . 'Plugin.php';
$plugin = new Plugin();