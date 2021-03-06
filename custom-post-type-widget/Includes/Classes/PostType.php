<?php

/**
 * The file that defines the post-type class
 *
 * A class definition that contains attributes and functions, used 
 * to implement and control a custom WordPress post-type.
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
 * @author     Jimmi Elofsson <contact@jimmi.eu>
 */
class Includes_Classes_PostType
{
    
    /**
	 * The name of this post_type.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $name    The string used to name this post-type.
	 */
    protected $_name;
        
    /**
	 * The name in singular of this post_type.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $name    String used to name (singular) post-type.
	 */
    protected $_nameSingular;
    
    /**
	 * The unique identifier of the post_type.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $identifier    String used to identify the post-type.
	 */
    protected $_identifier;
    
    /**
	 * Additional arguments for the post_type.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $args    arguments for the post-type.
	 */
    protected $_args;
        
	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout 
     * the plugin. Load the dependencies, define the locale, and set the hooks
     * for the admin area and the public-facing side of the site.
	 *
	 * @since    1.0.0
     * @param string $identifier
     * @param string $name
     * @param string $nameSingular
     * @param array  $args          Optional array of arguments
	 */
    public function __construct($identifier, $name, 
        $nameSingular, $args=Array()
    ) {
        $this->_name         = $name;
        $this->_nameSingular = $nameSingular;
        $this->_identifier   = urlencode($identifier);
        $this->_args         = is_array($args) ? $args : array();
        
        $this->_definePosttypeHooks();
	}   
        
    /**
     * Register our post_type on WordPress init
     *
     * This function creates a hook so that WordPress can recognize our 
     * post_type.
     *
     * @since  1.0.0
     * @access private
     */    
    private function _definePosttypeHooks()
    {   
        add_action('init', function() {
            
            $defaultPosttypeArgs = array(
                'labels'      => array(
                    'name'          => __($this->_name),
                    'singular_name' => __($this->_nameSingular),
                ),
                'supports'    => array(
                    'title',
                    'excerpt',
                    'editor',
                    'thumbnail',
                ),
                'public'      => true,
                'has_archive' => true,
            );
            
            // merge default with arguments passed in constructor
            $args = array_merge($defaultPosttypeArgs, $this->_args);
            
            register_post_type($this->_identifier, $args);
        });
    }
    
    /**
     * Get value from private properties.
     *
     * @since 1.0.0
     * @return mixed
     * @throws E_USER_NOTICE    if property not accessible via get
     */
    public function get($name)
    {
        switch($name) {
            case 'identifier':
                return $this->_identifier;
                break;
            default:
                $trace = debug_backtrace();
                trigger_error(
                    'Undefined property via get(): ' . $name
                    . ' in ' . $trace[0]['file']
                    . ' on line ' . $trace[0]['line'],
                    E_USER_NOTICE
                );
                return null;
                break;
        }
    }
}