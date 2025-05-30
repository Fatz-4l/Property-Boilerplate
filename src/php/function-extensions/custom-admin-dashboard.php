<?php
/**
 * Custom Admin Dashboard Modifications
 * Adds custom buttons for investment deals and booking properties management
 */

// Remove all default dashboard widgets
function remove_default_dashboard_widgets() {
    global $wp_meta_boxes;
    $wp_meta_boxes['dashboard'] = array();
}
add_action('wp_dashboard_setup', 'remove_default_dashboard_widgets');

// Add custom dashboard widgets
function add_custom_dashboard_widgets() {
    wp_add_dashboard_widget(
        'investment_deals_dashboard_widget',
        'Investment Deals Management',
        'render_investment_deals_dashboard_widget'
    );
    
    wp_add_dashboard_widget(
        'booking_properties_dashboard_widget',
        'Booking Properties Management',
        'render_booking_properties_dashboard_widget'
    );
}
add_action('wp_dashboard_setup', 'add_custom_dashboard_widgets');

// Shared styles for dashboard buttons
function get_dashboard_button_styles() {
    ?>
    <style>
        /* Import Montserrat font */
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

        /* Hide WordPress logo and icon */
        #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon {
            display: none !important;
        }

        /* Add Dashboard text */
        #wpadminbar #wp-admin-bar-wp-logo > .ab-item::before {
            content: 'Dashboard' !important;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif !important;
            font-size: 14px !important;
            font-weight: 400 !important;
            color: #ffffff !important;
        }

        /* Hover state */
        #wpadminbar #wp-admin-bar-wp-logo:hover > .ab-item::before {
            color: #72aee6 !important;
        }

        /* Adjust container alignment */
        #wpadminbar #wp-admin-bar-wp-logo > .ab-item {
            display: flex !important;
            align-items: center !important;
            padding: 0 8px !important;
            background: transparent !important;
        }

        /* Apply Montserrat to main content areas */
        .wrap h1,
        .wrap h2,
        .wrap h3,
        .wrap h4,
        .wrap h5,
        .wrap h6,
        .postbox h2,
        .postbox h3,
        #wpbody-content,
        .dashboard-buttons,
        .inside,
        .dashboard-button {
            font-family: 'Montserrat', sans-serif !important;
            font-weight: 600 !important;
        }

        /* Extra bold for headings */
        .wrap h1,
        .wrap h2,
        .postbox h2 {
            font-weight: 700 !important;
        }

        .dashboard-buttons {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 10px 0;
        }
        .dashboard-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px 24px;
            background-color: #1d2327;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            font-size: 15px;
            font-weight: 700 !important;
            transition: all 0.2s ease;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            letter-spacing: 0.3px;
            gap: 10px;
        }
        .dashboard-button .dashicons {
            font-size: 20px;
            width: 20px;
            height: 20px;
            transition: transform 0.2s ease;
        }
        .dashboard-button:hover .dashicons {
            transform: scale(1.1);
        }
        .dashboard-button:hover {
            background-color: #2c3338;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .dashboard-button:active {
            transform: translateY(0);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        #dashboard-widgets .postbox {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }
        #dashboard-widgets .postbox h2 {
            border-bottom: 1px solid #e5e7eb;
            padding: 15px 20px;
            font-size: 16px;
            font-weight: 700 !important;
            cursor: default;
            user-select: none;
        }
        #dashboard-widgets .inside {
            padding: 20px;
            margin: 0;
        }
        /* Remove minimize button and functionality */
        .postbox .handle-order-higher,
        .postbox .handle-order-lower,
        .postbox .handlediv {
            display: none !important;
        }
        .postbox.closed .inside {
            display: block !important;
        }
        /* Disable drag functionality */
        .meta-box-sortables {
            pointer-events: none;
        }
        .postbox {
            pointer-events: auto;
        }
        .postbox .hndle {
            cursor: default !important;
        }
        .sortable-placeholder,
        .ui-sortable-handle {
            pointer-events: none !important;
        }
        /* Hide any drag indicators */
        #dashboard-widgets .ui-sortable-helper,
        #dashboard-widgets .ui-sortable-placeholder {
            display: none !important;
        }

        /* Custom styles for Property Management title */
        #wpbody-content .wrap h1 {
            font-size: 24px;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }
    </style>
    <?php
}

// Render the investment deals widget content
function render_investment_deals_dashboard_widget() {
    get_dashboard_button_styles();
    ?>
    <div class="dashboard-buttons">
        <a href="<?php echo admin_url('post-new.php?post_type=investment_deals'); ?>" class="dashboard-button">
            <span class="dashicons dashicons-plus-alt2"></span>
            Add New Investment Deal
        </a>
        <a href="<?php echo admin_url('edit.php?post_type=investment_deals'); ?>" class="dashboard-button">
            <span class="dashicons dashicons-money-alt"></span>
            Manage Investment Deals
        </a>
    </div>
    <?php
}

// Render the booking properties widget content
function render_booking_properties_dashboard_widget() {
    get_dashboard_button_styles();
    ?>
    <div class="dashboard-buttons">
        <a href="<?php echo admin_url('post-new.php?post_type=booking_properties'); ?>" class="dashboard-button">
            <span class="dashicons dashicons-plus-alt2"></span>
            Add New Booking Property
        </a>
        <a href="<?php echo admin_url('edit.php?post_type=booking_properties'); ?>" class="dashboard-button">
            <span class="dashicons dashicons-admin-home"></span>
            Manage Booking Properties
        </a>
    </div>
    <?php
}

// Force dashboard to single column layout
function force_single_column_dashboard() {
    add_screen_option(
        'layout_columns',
        array(
            'max'     => 1,
            'default' => 1
        )
    );
}
add_action('admin_head-index.php', 'force_single_column_dashboard');

// Remove "Welcome" panel
remove_action('welcome_panel', 'wp_welcome_panel');

// Customize admin footer text
function custom_admin_footer_text() {
    return 'Developed by DNA';
}
add_filter('admin_footer_text', 'custom_admin_footer_text');

// Remove WordPress version from admin footer
function custom_admin_footer_version() {
    return '';
}
add_filter('update_footer', 'custom_admin_footer_version', 11);

// Change Dashboard to Property Management
function change_admin_menu_name() {
    global $menu;
    foreach($menu as $key => $item) {
        if($item[0] === 'Dashboard') {
            $menu[$key][0] = 'Property Management';
        }
    }
}
add_action('admin_menu', 'change_admin_menu_name');

// Change Dashboard title on the page
function change_dashboard_title($title) {
    if($title === 'Dashboard') {
        return 'Property Management';
    }
    return $title;
}
add_filter('gettext', 'change_dashboard_title');
add_filter('admin_title', 'change_dashboard_title');

// Modify WordPress logo link in admin bar - ensure it runs everywhere
function modify_admin_bar_logo_link($wp_admin_bar) {
    if (!is_admin_bar_showing()) {
        return;
    }
    
    // Remove the default WordPress logo menu completely
    $wp_admin_bar->remove_node('wp-logo');
    
    // Add our custom node
    $wp_admin_bar->add_node([
        'id'    => 'custom-dashboard',
        'title' => '',
        'href'  => admin_url('/'),
        'meta'  => [
            'class' => 'custom-dashboard-link'
        ]
    ]);

    // Remove the default dashboard menu item
    $wp_admin_bar->remove_node('dashboard');
}
// Add to admin bar menu with high priority to ensure it runs after WordPress core
add_action('admin_bar_menu', 'modify_admin_bar_logo_link', 11);

// Add custom styles to both admin and front-end when logged in
function add_custom_admin_styles() {
    // Only proceed if the admin bar is showing
    if (!is_admin_bar_showing()) {
        return;
    }
    ?>
    <style>
        /* Import Montserrat font */
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

        /* Style our custom dashboard link */
        #wpadminbar #wp-admin-bar-custom-dashboard {
            display: block !important;
        }

        #wpadminbar #wp-admin-bar-custom-dashboard > .ab-item {
            display: flex !important;
            align-items: center !important;
            padding: 0 8px !important;
            background: transparent !important;
            gap: 4px !important;
        }

        #wpadminbar #wp-admin-bar-custom-dashboard > .ab-item::before {
            content: '\f333' !important;
            font-family: dashicons !important;
            font-size: 20px !important;
            color: #ffffff !important;
            line-height: 1 !important;
            padding: 0 !important;
            margin-right: 2px !important;
        }

        #wpadminbar #wp-admin-bar-custom-dashboard > .ab-item::after {
            content: 'Dashboard' !important;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif !important;
            font-size: 14px !important;
            font-weight: 400 !important;
            color: #ffffff !important;
        }

        /* Hover state */
        #wpadminbar #wp-admin-bar-custom-dashboard:hover > .ab-item::before,
        #wpadminbar #wp-admin-bar-custom-dashboard:hover > .ab-item::after {
            color: #72aee6 !important;
        }

        /* Hide default dashboard menu items */
        #wp-admin-bar-root-default > #wp-admin-bar-dashboard {
            display: none !important;
        }
    </style>
    <?php
}
// Add to both admin and front-end when admin bar is showing
add_action('admin_head', 'add_custom_admin_styles', 99);
add_action('wp_head', 'add_custom_admin_styles', 99);

// Remove the WordPress menu items and clean up admin bar
function remove_wp_logo_menu_items($wp_admin_bar) {
    if (!is_admin_bar_showing()) {
        return;
    }
    
    // Remove WordPress about menu items
    $wp_admin_bar->remove_node('about');
    $wp_admin_bar->remove_node('documentation');
    $wp_admin_bar->remove_node('support-forums');
    $wp_admin_bar->remove_node('feedback');

    // Remove update notifications
    $wp_admin_bar->remove_node('updates');

    // Remove comments icon
    $wp_admin_bar->remove_node('comments');

    // Remove '+ New' menu
    $wp_admin_bar->remove_node('new-content');
}
add_action('admin_bar_menu', 'remove_wp_logo_menu_items', 999);

// Remove update notifications from admin area
function remove_update_notifications() {
    // Remove update notifications for non-admin users
    if (!current_user_can('update_core')) {
        remove_action('admin_notices', 'update_nag', 3);
        remove_action('admin_notices', 'maintenance_nag', 10);
    }
}
add_action('admin_head', 'remove_update_notifications', 1); 