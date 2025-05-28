<?php
/**
 * Plugin Name: Comment Guard
 * Description: A simple plugin to block spam comments with custom filters and basic human verification.
 * Version: 1.0
 * Author: Aryan Nayak
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Block spam based on keywords
add_filter('preprocess_comment', 'cg_block_spam_keywords');

function cg_block_spam_keywords($commentdata) {
    $blocked_keywords = array('viagra', 'casino', 'free money');

    foreach ($blocked_keywords as $word) {
        if (stripos($commentdata['comment_content'], $word) !== false) {
            wp_die('Your comment contains disallowed content and was blocked.');
        }
    }

    return $commentdata;
}

// Enqueue JS for human verification (e.g., simple check)
function cg_enqueue_scripts() {
    if (is_single() && comments_open()) {
        wp_enqueue_script('cg-guard-js', plugin_dir_url(__FILE__) . 'js/guard.js', array(), null, true);
    }
}
add_action('wp_enqueue_scripts', 'cg_enqueue_scripts');
