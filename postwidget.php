<?php
/**
* Plugin Name: Post Widget
* Plugin URI: http://wordpress.org
* Description: Ths widget displays an amount of posts from thee custom post type. This code is retrieved from: https://premium.wpmudev.org/blog/how-to-make-a-sidebar-widget-to-display-recent-custom-posts-by-jared-williams/
* Version: 1.1
* Author: Aleena Aamir and Haya Kazmi
* Author URI: http://wordpress.org
* Tags: custom post types, post types, latest posts, sidebar widget, plugin
* License: GPL
*/

// this function enqueues the css stylesheet


// this function registers the widget to the sidebar
function bc_latest_cpt_init() {
if ( !function_exists( 'register_sidebar_widget' ))
return;

function bc_latest_cpt($args) {
global $post;
extract($args);

// These are the options that will show
$options = get_option( 'bc_latest_cpt' );
$head = $options['head']; // title of the widget
$posttype = $options['posttype']; // type of post
$showpost = $options['showpost']; // the number of posts

$beforetitle = '';
$aftertitle = '';

// Output
echo $before_widget;

if ($head) echo $beforetitle . $head . $aftertitle;

$pq = new WP_Query(array( 'post_type' => $posttype, 'showposts' => $showpost ));
if( $pq->have_posts() ) :
?>
<ul>
<ul><?php // this adds the thumbnail of the posts to be displayed in the sidebar
 while($pq->have_posts()) : $pq->the_post(); ?>
    <p><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail() ; ?></a></p>
</ul>
</ul>
<?php wp_reset_query();
endwhile; ?>

<?php endif; ?>

<?php
echo $after_widget;
}

/**
* These are the setting that are displayed in the widgets settings on Wordpress
*/
function bc_latest_cpt_control() {

// Get options
$options = get_option( 'bc_latest_cpt' );
// options exist? if not set defaults
if ( !is_array( $options ))
$options = array(
'head' => 'Latest Posts', // name of the widget
'posttype' => 'post',// type of post displayed
'showpost' => '5' // number of posts you want to display
);
// form posted?
if ( $_POST['latest-cpt-submit'] ) {
$options['head'] = strip_tags( $_POST['latest-cpt-head'] );
$options['posttype'] = $_POST['latest-cpt-posttype'];
$options['showpost'] = $_POST['latest-cpt-showpost'];
update_option( 'bc_latest_cpt', $options );
}
// Get options for form fields to show
$head = $options['head'];
$posttype = $options['posttype'];
$showpost = $options['showpost'];

?>

<label for="latest-cpt-head"><?php echo __( 'Widget Name' ); ?>
<input id="latest-cpt-head" type="text" name="latest-cpt-head" size="30" value="<?php echo $head; ?>" />
</label>


</select><?php $args = array( 'public' => true );
$post_types = get_post_types( $args, 'names' );
foreach ($post_types as $post_type ) { ?>

<select name="latest-cpt-posttype"><option selected="selected" value="<?php echo $post_type; ?>"><?php echo $post_type;?></option></select><?php } ?>

<label for="latest-cpt-showpost"><?php echo __( 'Number of posts to show' ); ?>
<input id="latest-cpt-showpost" type="text" name="latest-cpt-showpost" size="2" value="<?php echo $showpost; ?>" />
</label>

<input id="latest-cpt-submit" type="hidden" name="latest-cpt-submit" value="1" />
<?php
}

wp_register_sidebar_widget( 'widget_latest_cpt', __('Latest Custom Posts'), 'bc_latest_cpt' );
wp_register_widget_control( 'widget_latest_cpt', __('Latest Custom Posts'), 'bc_latest_cpt_control', 300, 200 );

}
add_action( 'widgets_init', 'bc_latest_cpt_init' );

?>