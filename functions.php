<?php

/**
 * Child Theme
 *
 */

function fildisi_child_theme_setup() {

}
add_action( 'after_setup_theme', 'fildisi_child_theme_setup' );


//Omit closing PHP tag to avoid accidental whitespace output errors.


// WordPress function to automatically
// add ALT tags to images on upload.
// https://gist.github.com/ciccarone/db3985a34e95fff72118c01478b67088
function alt_tag_adder( $post_ID ) {
  if ( wp_attachment_is_image( $post_ID ) ) {
    $tc_title = get_post( $post_ID )->post_title;
    $tc_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $tc_title );
    $tc_title = ucwords( strtolower( $tc_title ) );
    $tc_meta = array(
      'ID'  =>  $post_ID,
    );
    update_post_meta( $post_ID, '_wp_attachment_image_alt', $tc_title );
    wp_update_post( $tc_meta );
  }
}

add_action( 'add_attachment', 'alt_tag_adder' );



function custom_js() {
  echo '<script src="https://kit.fontawesome.com/cff905c27f.js" crossorigin="anonymous"></script>';
}
add_action( 'wp_head', 'custom_js' );


function custom_enqueue() {
    wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/script.js',
        array( 'jquery' )
    );
    wp_enqueue_style(
        'animate-css',
        '/cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css',
        
    );
}

add_action( 'wp_enqueue_scripts', 'custom_enqueue' );

//Page Slug Body Class
function add_slug_body_class( $classes ) {
  global $post;
  if ($page_type = get_field('page_type', $post->ID)) {
    $classes[] = $page_type;
  }
  return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );
