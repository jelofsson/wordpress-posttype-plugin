<?php

/**
* Widget for displaying Portfolio items
*
* This file is read by WordPress, 
* it contains actions that starts the plugin and also the main core class.
*
* LICENSE: http://opensource.org/licenses/MIT
*
* @category   WP_Plugin
* @package    Portfolio_Widget_Plugin
* @subpackage Widget
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
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Register our widget when widgets init
 */
add_action('widgets_init', create_function('', 
    'return register_widget("portfolio_widget_plugin");'
));

/**
 * Create our new post type when we init
 */
add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'pwp_portfolio',
        array(
            'labels' => array(
            'name' => __( 'Portfolio' ),
            'singular_name' => __( 'Portfolio' )
        ),
            'public' => true,
            'has_archive' => true,
        )
    );
}

class Portfolio_widget_plugin extends WP_Widget {

	/**
     * Constructor
     */
    function __construct() 
    {
        parent::WP_Widget(false, $name = __(
            'Portfolio Widget Plugin', 
            'portfolio_widget_plugin'
        ));
	}

	/**
     * Create the widget form in the administration
     */
	function form($instance) 
    {	
        // check value
        $number = ($instance) ? esc_attr($instance['number']) : 5;
        // output form
        include('View/Form.php');
	}

	/**
     * Save widget data during edition
     */
	function update($new_instance, $old_instance) 
    {
        // get old instance
		$instance = $old_instance;
        // set instance value
        $instance['number'] = strip_tags($new_instance['number']);

        return $instance;
	}

	/**
     * Display the widget content on the front-end
     */
	function widget($args, $instance) 
    {
        /* ... */
	}
}