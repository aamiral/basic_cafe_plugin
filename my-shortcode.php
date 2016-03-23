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

//this function allows to edit the content. http://wordpress.stackexchange.com/questions/183538/display-custom-post-type-with-shortcode
function display_custom_post_type(){
        $args = array(
            'post_type' => 'my-custom-post-type',
            'post_status' => 'publish'
        );

        $string = '';
        $query = new WP_Query( $args );
        if( $query->have_posts() ){
            $string .= '<ul>';
            while( $query->have_posts() ){
                $query->the_post();
                $string .= '<li>' . get_the_title() . '</li>';
            }
            $string .= '</ul>';
        }
        wp_reset_postdata();
        return $string;
    }
add_shortcode( 'shortcodename', 'display_custom_post_type' );


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