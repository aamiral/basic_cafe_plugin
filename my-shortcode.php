<?php

/*
* Plugin Name: Basic Cafe Plugin
* Plugin URI: http://hayaaleena.com
* Description: Assignment 3, in this assignment we were to create a plugnin that consists a widget, custom post type, and a shortcode to display posts from our custom post type. 
* Author: Haya & Aleena
* Author URI: http://haya&aleena.com
* Version: 1.0
*/

//this enqueues the css stylesheet file to the plugin.
function bcplugin_enqueue_scripts(){
	wp_enqueue_style('plugin-css', plugins_url('basic_cafe_plugin/css/style.css'));
}
add_action('wp_enqueue_scripts', 'bcplugin_enqueue_scripts');



// this shortcode allows users to display certain number of posts from the custom post type on any page they add the shortcode on. The code is retrieved from: http://wordpress.stackexchange.com/questions/183538/display-custom-post-type-with-shortcode
 add_shortcode( 'bcshortcode', 'display_custom_post_type' );

    function display_custom_post_type(){
        $args = array(
            'post_type' => 'acme_recipe',// this is the post type of our custom post
            'post_status' => 'publish', // this allows the posts to be published on the actual site
            'posts_per_page'=> '3' // the number of posts to display from the custom post type
        );

        $content = '';
        $query = new WP_Query( $args );
        if( $query->have_posts() ){
            while( $query->have_posts() ){
                $query->the_post();
                $content .= '<p><a href="' . get_permalink() . '"</a>' . get_the_title() .  		get_the_content() .  '</p>'; // this displays the title, content, and attaches the link of the post
            }
        }
        wp_reset_postdata();
        return $content;
    }

//this is a function for custom post type that will allow users to add in recipes on the website. The code is retrieved from https://codex.wordpress.org/Post_Types 

function create_post_type() {
  register_post_type( 'acme_recipe',
    array(
      'labels' => array(
        'name' => __( 'Recipes' ),
        'singular_name' => __( 'recipes' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}

add_action( 'init', 'create_post_type' );
add_post_type_support( $post_type, $supports )

?>