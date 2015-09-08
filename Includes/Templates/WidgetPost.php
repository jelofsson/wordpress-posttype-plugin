<?php
/**
 * Provide a administration widget form-view for the plugin
 *
 * LICENSE: http://opensource.org/licenses/MIT
 *
 * @category   WP_Plugin
 * @package    CustomPostType_Widget
 * @subpackage CustomPostType_Widget/Includes/Templates
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
    <p>
        <?php if ( ( function_exists('has_post_thumbnail') ) && ( has_post_thumbnail() ) ) :  ?>
            <?php the_post_thumbnail( 'full' ); ?>
        <?php endif; ?>
    </p>
</div>