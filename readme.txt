=== basic_cafe_plugin ===

Contributors: Aleena Aamir and Haya Kazmi
Tags: cafe, basic, theme

Requires at least: 4.0
Tested up to: 4.4.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A starter theme called basic_cafe 

== Description ==

Hi. I'm a plugin called basic_cafe_plugin. The plugin adds a custom post type on your dashboard named Recipe, add a widget that shows posts form Recipe, a widget for social media sites, and a shortcode that you can add on any page to display Recipe posts. 

== Installation ==
	
1- In your admin panel, go to Plugins and activate 'Basic Cafe Plugin'.

== Widget ‘Basic Cafe Social Links Widget’ ==

1- In your admin panel, go to Plugins and activate 'Basic Cafe Social Links Widget'.
2- 1. In your admin panel, go to Appearance -> Widgets
3- Drag the 'Social Links' widget to the required menu bar
4- From here you can add links for facebook or twitter

== Widget ‘PostWidget’==

1- In your admin panel, go to Plugins and activate ‘Postwidget’.
2- 1. In your admin panel, go to Appearance -> Widgets
3- Drag the ‘postwidget’ widget to the required menu bar
4- From here you change the settings such as how many posts to appear.

==Custom Post Type Attributes==
1- bcshortcode => is the name of the shortcode for the custom post type
2-‘acme_recipe' => is the name of the post type for the custom post type
3- name => is the name displayed on your admin panel. 

== Using Custom Post Type ==
1- In your admin panel, you will see the Recipe tab, hover over and click on add new to create new posts.
2- Once done you may add a featured image that you can choose from the media library on Wordpress.

== Shortcode Attributes ==
1- post_type => is the attribute that displays the custom post type. 
2- post_status => must be publish, to ensure your posts are visible on the front-end of the website.
3- posts_per_page => sets the number of custom posts you want to display on your page.

==Using the Shortcode ==
1- Create a new page or go to existing page where you want to display posts form custom post type
2- in the content box add the following code:
			
		[bcshortcode type=acme_product]
 
3- Publish, and you should be able to see the posts on the page.



== Credits ==

* Based on Underscores http://underscores.me/, (C) 2012-2016 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
*(C) 2016 Haya Kazmi (999833417) and Aleena Aamir (1000272046), [MIT](http://opensource.org/licenses/MIT)
