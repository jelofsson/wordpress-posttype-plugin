<?php
/**
 * Provide a administration widget form-view for the plugin
 *
 * LICENSE: http://opensource.org/licenses/MIT
 *
 * @category   WP_Plugin
 * @package    Portfolio_Widget_Plugin
 * @subpackage Portfolio_Widget_Plugin/Includes/Templates
 * @copyright  Copyright (c) 2015 Jimmi Elofsson <contact@jimmi.eu>
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @version    $Id:$
 * @link       https://github.com/jelofsson
 * @since      Version 1.0.0
 *
 */
?>
<div>
    <h2><?php the_title(); ?></h2>
    <p>
        <?php the_excerpt() ?>
    </p>
</div>