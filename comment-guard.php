<?php
/*
Plugin Name: CommentGuard
Description: Blocks spam comments by verifying human behavior.
Version: 1.0
Author: Aryan Nayak
*/

defined('ABSPATH') or die('No script kiddies please!');

// Load JS only on single post pages
function cg_enqueue_scripts() {
    if (is_single() && comments_open()) {
        wp_enqueue_script('cg-guard-js', plugin_dir_url(__FILE__) . 'js/guard.js', array(), null, true);
    }
}
add_action('wp_enqueue_scripts', 'cg_enqueue_scripts');
