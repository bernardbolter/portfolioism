<?php
/**
 * Defines the Artworks custom post type for the Portfolio WordPress theme from Artism.org
 *
 * @package Portfolioism
 * @since 1.0.0
 */

 function portfolioism_register_post_type() {
     $singular = "Artwork";
     $plural = "Artworks";

     $labels = array(
         'name'                 => $plural,
         'singular_name'        => $singular,
         'add_new_label'        => 'Add New Art',
         'add_new_item'         => 'Add New ' . $singular,
         'edit'                 => 'Edit Art',
         'edit_item'            => 'Edit ' , $singular,
         'new_item'             => 'New ' . $singular,
         'view'                 => 'View ' . $singular,
         'view_item'            => 'View ' . $singular,
         'search_term'          => 'Search ' . $singular,
         'parent'               => 'Parent ' . $singular,
         'not_found'            => 'No ' . $plural . ' Found',
         'not_found_in_trash'   => 'No ' . $plural . ' in Trash'
     );

     $args = array(
         'labels'               => $labels,
         'public'               => true,
         'publicly_queryable'   => true,
         'exclude_from_search'  => false,
         'show_in_nav_menu'     => true,
         'show_ui'              => true,
         'show_in_menu'         => true,
         'show_in_admin_bar'    => true,
         'menu_position'        => 4,
         'menu_icon'            => 'dashicons-admin-appearance',
         'can_export'           => true,
         'delete_with_user'     => false,
         'hierarchical'         => false,
         'has_archive'          => true,
         'query_var'            => true,
         'capability_type'      => 'post',
         'map_meta_cap'         => true,
         'rewrite'              => array(
             'slug'         => 'artwork',
             'with_front'   => true,
             'pages'        => true,
             'feeds'        => true
         ),
         'show_in_rest'             => true,
         'rest_controller_class'    => "AP_REST_Posts_Controller",
         'supports'                 => array(
             'title',
             'thumbnail'
         ),
         'show_in_graphql'          => true,
         'graphql_single_name'      => 'artwork',
         'graphql_plural_name'      => 'artworks'
    );

    register_post_type( 'artwork', $args );
 }

 add_action( 'init', 'portfolioism_register_post_type');