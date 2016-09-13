<?php
/**
 * Plugin Name: Download Featured Images
 * Plugin URI: https://github.com/shaile/shail-wp/tree/master/downloadfeaturedImages
 * Description: Download feature images .
 * Version: 2.2
 * Author: Shaile(shaile.martin@gmail.com)
 * Author URI: https://wordpress.org/support/profile/shaile
 * License: A "Slug" license name e.g. GPL12
 */
defined('ABSPATH') or die("No script kiddies please...!");
add_action('begin_fetch_post_thumbnail_html', 'dfi_download_featured_images');

/**
 * 
 * @global type $post
 * 
 */
function dfi_download_featured_images() {
    global $post;
    //get featured enable lists
    $post_options = (array) json_decode(get_option('featured_enable'));

    $singular = '';
    $is_page = '';

    if (!empty($post_options['page'])) {
        $is_page = is_page();
        unset($post_options['page']);
    }

    if (!empty($post_options)) {
        $post_options = array_values($post_options);
        $singular = is_singular($post_options);
    } else {
        $singular = $is_page;
    }
    if (!empty($post_options) && ($is_page != '')) {
        $singular = ($is_page || $singular);
    }
//    echo '<pre>';
//    print_r($post_options);
//    exit;
    if ($singular && has_post_thumbnail()) {
        $url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
        //check download icon enable for all
        $default_download = json_decode(get_option('featured_enable'))->dfi_enable_download;
//        print_r($default_download); 
//        exit;
        $icon = get_post_meta($post->ID, 'featured_download', true);
       if (($url[0] != '') && (($icon == 'yes') || ($default_download == 'enable_download'))) {
            dfi_add_download_button($url[0]);
        }
    }
}

/**
 * 
 * @param type $url
 */
function dfi_add_download_button($url) {
    //clean the fileurl
    $file_url = stripslashes(trim($url));
    //get filename
    $file_name = basename($file_url);
    echo '<span class="download">
        <a href="' . $file_url . '" download="' . $file_name . '">
        <img src="' . plugins_url('img/download.png', __FILE__) . '" alt="' . $file_name . '" title="Download"></a> </span>';
}

/**
 * Add Front end button style
 */
function dfi_download_featured_scripts() {
    wp_register_style('featured-styles', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_style('featured-styles');
}

add_action('wp_enqueue_scripts', 'dfi_download_featured_scripts');

/**
 * Admin style 
 */
function dfi_download_featured_admin_style(){
    wp_register_style('featured-admin-styles', plugin_dir_url(__FILE__) . 'css/mazekro_admin.css');
    wp_enqueue_style('featured-admin-styles');
}

 add_action( 'admin_enqueue_scripts', 'dfi_download_featured_admin_style' );




/**
 * Adds a meta box to the post editing screen
 */
function dfi_featured_custom_meta() {
    $get_options = json_decode(get_option('featured_enable'));
    if ($get_options) {
        foreach ($get_options as $k => $post_type) {
            add_meta_box('featured_meta', __('Show Download Icon', 'featured'), 'dfi_featured_meta_callback', $post_type, 'side');
        }
    }
}

add_action('add_meta_boxes', 'dfi_featured_custom_meta');

/**
 * Outputs the content of the meta box
 */
function dfi_featured_meta_callback($post) {
    wp_nonce_field(basename(__FILE__), 'featured_nonce');
    $featured_stored_meta = get_post_meta($post->ID, 'featured_download', true);
    ?>

    <p>
        <label for="featured_download" class="featured-row-title">
            <?php _e('Add Download Icon', 'prfx-textdomain') ?>
        </label>
        <input type="checkbox" name="featured_download" id="featured_download" 
               value="yes" <?php
            if (isset($featured_stored_meta)) {
                checked($featured_stored_meta, 'yes');
            }
            ?> />
    </p>

    <?php
}

/**
 * Saves the custom meta input
 */
function dfi_featured_meta_save($post_id) {
    // Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = ( isset($_POST['featured_nonce']) && wp_verify_nonce($_POST['featured_nonce'], basename(__FILE__)) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }

    
    // Checks for input and saves if needed    
    if (isset($_POST['featured_download'])) {
        $value = sanitize_text_field('yes');
        update_post_meta($post_id, 'featured_download', $value);
    } else {
        update_post_meta($post_id, 'featured_download', '');
    }
}

add_action('save_post', 'dfi_featured_meta_save');

/**
 * Create featured image download menu
 */
add_action('admin_menu', 'dfi_featured_download_menu');

function dfi_featured_download_menu() {
    $icon_url = plugins_url('img/mazeKro.png', __FILE__);
    //create custom top-level menu
    add_menu_page('Download Featured Images', 'Featured Settings', 'manage_options', 'dfi_featured_settings', 'dfi_featured_download_settings_page', $icon_url);
}

/**
 * Function to dsplay setting page
 */
function dfi_featured_download_settings_page() { 
    $post_types = array_diff(get_post_types(), array("attachment", "revision", "nav_menu_item"));
    $action = 'admin.php?page=dfi_featured_settings';
    $is_valid_nonce = ( isset($_POST['save']) && wp_verify_nonce($_POST['save'], basename(__FILE__)) ) ? 'true' : 'false';
   
    // Exits script depending on save status
    if (!$is_valid_nonce) {
        return;
    }
    
    $option_name = 'featured_enable';
    
    if (isset($_POST['save'])) {
        $get_options = (object) $_POST;
    } else {
        $get_options = json_decode(get_option($option_name));
    }
    include 'include/settings.php';
    
//exit;
    if (isset($_POST['save'])) {
        unset($_POST['save']);
        $new_value = sanitize_text_field(json_encode($_POST));
        
        if (get_option($option_name) !== false) {

            // The option already exists, so we just update it.
            update_option($option_name, $new_value);
        } else {

            // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
            $deprecated = null;
            $autoload = 'no';
            add_option($option_name, $new_value, $deprecated, $autoload);
        }
    }
}

/*Slider Feature Functions*/

//Add Thumb slider with content
function dfi_featured_download_thumb_slider($content){
    global $post;
    
    if (is_single()) {
        $slider_options = json_decode(get_option('featured_enable'));
        if($slider_options->dfi_enable_slider == 'dfi_enable'){
          $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 10, 'post__not_in' => array($post->ID) ) );        
          if($slider_options->dfi_slider == 'before'){
             include 'include/relatedposts.php';
          }else{             
            ob_start(); // turn on output buffering
            include 'include/relatedposts.php';
            $content .= ob_get_contents(); // get the contents of the output buffer
            ob_end_clean(); //  clean (erase) the output buffer and turn off output buffering   
          }          
        }
    }  
    return $content;
}

add_filter( "the_content", "dfi_featured_download_thumb_slider" );


/**
 * Add Front end slider js style
 */
function dfi_download_featured_slider_scripts() {
    wp_register_script('featured-slider-min', plugin_dir_url(__FILE__) . 'js/mazekro.slider.min.js');
    wp_enqueue_script('featured-slider-min');
    wp_register_script('featured-slider', plugin_dir_url(__FILE__) . 'js/mazekro.js');
    wp_enqueue_script('featured-slider');
    
}

add_action('wp_enqueue_scripts', 'dfi_download_featured_slider_scripts');




