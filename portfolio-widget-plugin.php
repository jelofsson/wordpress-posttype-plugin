<?php
/**
 * Plugin Name: Portfolio Widget Plugin
 * Description: Publish and display portfolio items
 * Version: 0.0.1
 * Author: Jimmi Elofsson
 * Author URI: http://www.jimmi.eu/
 * License: GPL2
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Portfolio_widget_plugin extends WP_Widget {

	/*
    * Constructor
    */
    function __construct() 
    {
        parent::WP_Widget(false, $name = __('Portfolio Widget Plugin', 'portfolio_widget_plugin'));
	}

	/*
    * Create the widget form in the administration
    */
	function form($instance) 
    {	
	   /* ... */
	}

	/*
    * Save widget data during edition
    */
	function update($new_instance, $old_instance) 
    {
		/* ... */
	}

	/*
    * Display the widget content on the front-end
    */
	function widget($args, $instance) 
    {
		/* ... */
	}
}


/*
* Register our widget when widgets init
*/
add_action('widgets_init', create_function('', 'return register_widget("portfolio_widget_plugin");'));

/*
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
