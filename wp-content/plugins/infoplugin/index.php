<?php
/**
 * Plugin Name: Info Plugin
 * Plugin URI: https://github.com/shaile/shail-wp/tree/master/downloadfeaturedImages
 * Description: Info Plugin.
 * Version: 2.2
 * Author: Shaile(shaile.martin@gmail.com)
 * Author URI: https://wordpress.org/support/profile/shaile
 * License: A "Slug" license name e.g. GPL12
 */
defined('ABSPATH') or die("No script kiddies please...!");
add_action('begin_fetch_post_thumbnail_html', 'dfi_download_featured_images');




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
