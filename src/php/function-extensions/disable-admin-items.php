<?php

// Disable Posts, Comments and Clean Dashboard
function disable_theme_features() {
    // Remove Posts and Comments from admin menu
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
    
    // Disable comments completely
    add_filter('comments_open', '__return_false');
    add_filter('comments_array', '__return_empty_array');
    
    // Remove comment support
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
    
    // Remove dashboard widgets
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
}
add_action('admin_init', 'disable_theme_features');