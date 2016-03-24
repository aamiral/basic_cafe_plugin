<?php

/*
* Plugin Name: Basic Cafe Plugin
* Plugin URI: http://hayaaleena.com
* Description: Assignment 4
* Author: Haya & Aleena
* Author URI: http://haya&aleena.com
* Version: 1.0
*/

//this enqueues the css stylesheet file to the plugin.
function bcplugin_enqueue_scripts(){
	wp_enqueue_style('plugin-css', plugins_url('basic_cafe_plugin/css/style.css'));
}
add_action('wp_enqueue_scripts', 'bcplugin_enqueue_scripts');



//shortcode http://www.tcbarrett.com/2012/11/wordpress-shortcode-to-make-a-list-of-your-custom-post-type-posts/#.VvME5sdeDVo
add_shortcode( 'custom_posts', 'tcb_sc_custom_posts' );
function tcb_sc_custom_posts( $atts ){
  global $post;
  $default = array(
    'type'      => 'product',
    'post_type' => 'acme_product',
    'limit'     => 3,
    'status'    => 'publish'
  );
  $r = shortcode_atts( $default, $atts );
  extract( $r );

  if( empty($post_type) )
    $post_type = $type;

  $post_type_ob = get_post_type_object( $post_type );
  if( !$post_type_ob )
    return '<div class="warning"><p>No such post type <em>' . $post_type . '</em> found.</p></div>';

  $return = '<h3>' . $post_type_ob->post . '</h3>';

  $args = array(
    'post_type'   => $post_type,
    'numberposts' => $limit,
    'post_status' => $status,
  );
 
  $posts = get_posts( $args );
  if( count($posts) ):
    $return .= '<ul>';
    foreach( $posts as $post ): setup_postdata( $post );
      $return .= '<li>' . get_the_title() . '</li>';
    endforeach; wp_reset_postdata();
    $return .= '</ul>';
  else :
    $return .= '<p>No posts found.</p>';
  endif;
  
  return $return;
}


//custom post type

function create_post_type() {
  register_post_type( 'acme_product',
    array(
      'labels' => array(
        'name' => __( 'Products' ),
        'singular_name' => __( 'Product' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}

add_action( 'init', 'create_post_type' );
add_post_type_support( $post_type, $supports )

?>