<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across 
 * both the public-facing side of the site and the admin area.
 *
 * LICENSE: http://opensource.org/licenses/MIT
 *
 * @since      Version 1.0.0
 * @category   WP_Plugin
 * @package    CustomPostType_Widget
 * @subpackage CustomPostType_Widget/Plugin
 * @copyright  Copyright (c) 2015 Jimmi Elofsson <contact@jimmi.eu>
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @version    $Id:$
 * @link       https://github.com/jelofsson
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
 * @package    CustomPostType_Widget
 * @subpackage CustomPostType_Widget/Plugin
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
	protected $_version;
    
    /**
	 * The name of this plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $name    The string used to name this plugin.
	 */
	public $name;
    
    /**
	 * The string used to uniquely identify this plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $identifier    The unique identifier of this plugin.
	 */
	protected $_identifier;
    
    /**
	 * Used for post-type handing in this plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    PostType    $postType    Used for post-type in this plugin.
	 */
	protected $_postType;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout 
     * the plugin. Load the dependencies, define the locale, and set the hooks
     * for the admin area and the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
    public function __construct() 
    {
        $this->_version    = '1.0.0';
        $this->name        = 'Custom Post Type Widget';
        $this->_identifier = urlencode($this->name);
        
        // create custom post-type using our PostType Class
        $postTypeIdentifier   = 'custom-posts';
        $postTypeName         = 'Custom Posts';
        $postTypeNameSingular = 'Custom Post';
        $this->_postType      = $this->_loadPostType($postTypeIdentifier, 
                                                     $postTypeName, 
                                                     $postTypeNameSingular);
        
        // instantiate the parent object
        parent::WP_Widget(false, $name = __(
            $this->name,
            $this->_identifier
        ));
        
        $this->_defineWidgetHooks();
	}
    
    /**
     * Create a new instance of a post-type class
     *
     * This function creates a new PostType object and returns it to 
     * the caller.
     *
     * @since 1.0.0
     * @access private
     * @param string $identifier
     * @param string $name
     * @param string $nameSingular
     *
     * @return PostType
     */
    private function _loadPostType($identifier, 
        $name, $nameSingular, $args=Array()
    ) {
        require_once plugin_dir_path( __FILE__ ) . 
                     '/Includes/Classes/PostType.php';
        
        return new Includes_Classes_PostType($identifier, $name, 
                                             $nameSingular, $args);
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
        include( plugin_dir_path( __FILE__ ) . 'Includes/Templates/Form.php');
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
        $p = new WP_Query(apply_filters('widget_posts_args', array(
            'posts_per_page'      => $number,
            'post_type'           => $this->_postType->get('identifier'),
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
        )));
        
        // the loop
        if ($p->have_posts()) {
            echo $before_widget;
            // each post
            while($p->have_posts()) {
                $p->the_post();
                // display the post
                include( plugin_dir_path( __FILE__ ) . 
                        'Includes/Templates/WidgetPost.php');
            }
            echo $after_widget;
        }
	}
    
    /**
     * Register our widget on WordPress widgets_init
     *
     * This function creates a hook so that WordPress can recognize our widget.
     *
     * @since  1.0.0
     * @access private
     */
    private function _defineWidgetHooks()
    {
        add_action('widgets_init', function() {
            register_widget(__CLASS__);
        });

    }
}