<?php
/**
 * Plugin Name: Comment Guard
 * Description: A simple plugin to block spam comments with custom filters.
 * Version: 1.0
 * Author: Aryan Nayak
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Hook into comment pre-processing
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
