<?php

/**
 * The file that defines the post-type class
 *
 * A class definition that includes attributes and functions used to
 * implement a custom post-type in WordPress.
 *
 * LICENSE: http://opensource.org/licenses/MIT
 *
 * @since      Version 1.0.0
 * @category   WP_Plugin
 * @package    CustomPostType_Widget
 * @subpackage CustomPostType_Widget/Classes/PostType
 * @copyright  Copyright (c) 2015 Jimmi Elofsson <contact@jimmi.eu>
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @version    $Id:$
 * @link       https://github.com/jelofsson
 *
 */

/**
 * The post-type class.
 *
 * This is used to define admin-specific hooks, and
 * public-facing site hooks for a custom post-type.
 *
 * @since      1.0.0
 * @package    CustomPostType_Widget
 * @subpackage CustomPostType_Widget/Classes/PostType
 * @author     Your Name <email@example.com>
 */
class PostType
{
    
    /**
	 * The name of this post_type.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $name    The string used to name this post-type.
	 */
    protected $name;
        
    /**
	 * The name in singular of this post_type.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $name    The string used to name (singular) this post-type.
	 */
    protected $nameSingular;
    
    /**
	 * The unique identifier of the post_type.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $identifier    The string used to uniquely identify the post-type.
	 */
    protected $identifier;
    
    /**
	 * Additional arguments for the post_type.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $args    arguments for the post-type.
	 */
    protected $args;
        
	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
     * @param string $identifier
     * @param string $name
     * @param string $nameSingular
     * @param array  $args          Optional array of arguments
	 */
    public function __construct($identifier, $name, $nameSingular, $args=Array()) 
    {
        $this->name         = $name;
        $this->nameSingular = $nameSingular;
        $this->identifier   = urlencode($identifier);
        $this->args         = is_array($args) ? $args : array();
        
        $this->definePosttypeHooks();
	}   
        
    /**
     * Register our post_type on WordPress init
     *
     * This function creates a hook so that WordPress can recognize our post_type.
     *
     * @since  1.0.0
     * @access private
     */    
    private function definePosttypeHooks()
    {   
        add_action('init', function() {
            
            $defaultPosttypeArgs = array(
                'labels' => array(
                    'name' => __($this->name),
                    'singular_name' => __($this->nameSingular)
                ),
                'supports' => array(
                    'title',
                    'excerpt',
                    'editor',
                    'thumbnail'
                ),
                'public' => true,
                'has_archive' => true
            );
            
            // merge default with arguments passed in constructor
            $args = array_merge($defaultPosttypeArgs, $this->args);
            
            register_post_type($this->identifier, $args);
        });
    }
    
    /**
     * Get data form inaccessible properties.
     *
     * @since 1.0.0
     */
    public function __get($name)
    {
        switch($name) {
            case 'identifier':
                return $this->identifier;
                break;
            default:
                $trace = debug_backtrace();
                    trigger_error(
                        'Undefined property via __get(): ' . $name .
                        ' in ' . $trace[0]['file'] .
                        ' on line ' . $trace[0]['line'],
                        E_USER_NOTICE);
                    return null;
                break;
        }
    }
}