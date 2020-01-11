<?php
/** 
 * Portfolioism Functions and Definitions
 * 
 * @package Portfolioism
 * @since 1.0.0
 * 
*/

require_once ( get_template_directory() . '/artworks/index.php');

if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150, true ); // default Post Thumbnail dimensions (cropped)
}