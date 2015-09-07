<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * LICENSE: http://opensource.org/licenses/MIT
 *
 * @category   WP_Plugin
 * @package    Portfolio_Widget_Plugin
 * @subpackage Portfolio_Widget_Plugin/Plugin
 * @copyright  Copyright (c) 2015 Jimmi Elofsson <contact@jimmi.eu>
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @version    $Id:$
 * @link       https://github.com/jelofsson
 * @since      Version 1.0.0
 *
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Portfolio_Widget_Plugin
 * @subpackage Portfolio_Widget_Plugin/Plugin
 * @author     Your Name <email@example.com>
 */
class Plugin extends WP_Widget 
{
    
	/**
	 * The current version of the plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $version    The current version of the plugin.
	 */
	protected $version;
    
    /**
	 * The name of this plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;
    
    /**
	 * The unique identifier of this plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_identifier;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
    public function __construct() 
    {
        $this->version = '1.0.0';
        $this->plugin_name = 'Portfolio Widget Plugin';
        $this->plugin_identifier = urlencode($this->plugin_name);
        
        parent::WP_Widget(false, $name = __(
            $this->plugin_name,
            $this->plugin_identifier
        ));
        
        $this->define_widget_hooks();
        $this->define_posttype_hooks();
	}

	/**
     * Create the widget form in the administration
     * 
     * @since 1.0.0
     * @param array $instance
     */
	public function form($instance) 
    {	
        // check value
        $number = ($instance) ? esc_attr($instance['number']) : 5;
        // output form
        include( plugin_dir_path( __FILE__ ) . 'Admin/View/Form.php');
	}

	/**
     * Save widget data during edition
     *
     * @since 1.0.0
     * @param array $new_instance
     * @param array $old_instance
     *
     * @return array
     */
	public function update($new_instance, $old_instance) 
    {
        // get old instance
		$instance = $old_instance;
        // set instance value
        $instance['number'] = strip_tags($new_instance['number']);

        return $instance;
	}

	/**
     * Display the widget content on the front-end
     *
     * @since 1.0.0
     * @param array $args
     * @param array $instance
     */
	public function widget($args, $instance) 
    {
        extract($args);
        
        // widget options
        $number = ( ! empty($instance['number'])) ? 
                      absint($instance['number']) : 5;
        
        // widget query
        $p = new WP_Query( apply_filters('widget_posts_args', 
                                         array('posts_per_page' => $number, 
                                               'post_type' => 'portfolio',
                                               'no_found_rows' => true, 
                                               'post_status' => 'publish', 
                                               'ignore_sticky_posts' => true
        )));
        
        if ($p->have_posts()) {
            echo $before_widget;
            // each post
            while($p->have_posts()) {
                $p->the_post();
                // Display the post
                include( plugin_dir_path( __FILE__ ) . 'Public/View/WidgetPost.php');    
            }
            echo $after_widget;
        }
	}
    
    /**
     * Register our widget on WordPress widgets_init
     *
     * @since  1.0.0
     * @access private
     */
    private function define_widget_hooks()
    {
        add_action('widgets_init', function() {
            register_widget(__CLASS__);
        });

    }
    
    /**
     * Create our new post_type on WordPress init
     *
     * @since  1.0.0
     * @access private
     */    
    private function define_posttype_hooks()
    {

        add_action('init', function() {
            register_post_type( 'portfolio',
                array(
                    'labels' => array(
                    'name' => __( 'Portfolios' ),
                    'singular_name' => __( 'Portfolio' )
                ),
                    'public' => true,
                    'has_archive' => true,
                )
            );
        });
    }
}