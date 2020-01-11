<?php
/**
 * Define the fields for the artwork custom post type in the Portfolioism wordpress theme
 * 
 * @package Portfolioism
 * @since 1.0.0
 * 
 */

 function portfolioism_add_custom_metabox() {
     add_meta_box(
        'portfolioism_meta',
        'Artwork',
        'portfolioism_meta_callback',
        'artwork'
     );
 }

 add_action( 'add_meta_boxes', 'portfolioism_add_custom_metabox');

 function portfolioism_meta_callback( $post ) {
     wp_nonce_field( basename(__FILE__), 'portfolioism_artwork_nonce' );
     $portfolioism_stored_meta = get_post_meta( $post->ID );
    ?>
     <div class="medium">
        <h1>Medium</h1>
        <input type="text" name="medium" id="medium" value="<?php if ( ! empty ( $portfolioism_stored_meta['medium'] ) ) echo esc_attr( $portfolioism_stored_meta['medium'][0] ); ?>" />
     </div>
     <div class="height">
        <h1>Height</h1>
        <input type="text" name="height" id="height" value="<?php if ( ! empty ( $portfolioism_stored_meta['height'] ) ) echo esc_attr( $portfolioism_stored_meta['height'][0] ); ?>" />
     </div>
     <div>
        <?php 
            echo '<pre>'; print_r($portfolioism_stored_meta); echo 'pre';
        ?>
     </div>
    <?php
 }

 function portfolioism_meta_save( $post_id ) {
     // Check the save status
     $is_autosave = wp_is_post_autosave( $post_id );
     $is_revision = wp_is_post_revision( $post_id );
     $is_valid_nonce = ( isset( $_POST[ 'portfolioism_valid_nonce' ]) && wp_verify_nonce( $_POST['poortfolioism_valid_nonce'], basename(__FILE__) ) ) ? 'true' : 'false';
 
    if ( $is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }

    if ( isset( $_POST['medium'] ) ) {
        update_post_meta($post_id, 'medium', sanitize_text_field($_POST['medium'] ) );
    }

    if ( isset ($_POST['height'] ) ) {
        update_post_meta($post_id, 'height', sanitize_text_field($_POST['height'] ) );
    }
}

add_action( 'save_post', 'portfolioism_meta_save');

function portfolioism_register_custom_fields() {
    register_rest_field(
        'artwork',
        'medium',
        array(
            'get_callback' => 'portfolioism_show_fields'
        )
    );
    register_rest_field(
        'artwork',
        'height',
        array(
            'get_callabck' => 'portfolioism_show_fields'
        )
    );
}

add_action( 'rest_api_init', 'protfolioism_register_custom_fields' );

function portfolioism_show_fields($object, $field_name, $request) {
    return get_post_meta($object['id'], $field_name, true);
}

add_action( 'graphql_register_types', function() {
    register_graphql_field( 'Artwork', 'medium', [
       'type' => 'String',
       'description' => __( 'what the art is made of', 'wp-graphql' ),
       'resolve' => function( $post ) {
         $color = get_post_meta( $post->ID, 'medium', true );
         return ! empty( $color ) ? $color : 'blue';
       }
    ] );
  } );