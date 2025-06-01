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

        /* Hide Property Management in left sidebar but keep Appearance visible */
        #adminmenu li.menu-top.menu-top-first:not(#menu-appearance):not(#menu-settings):not(#menu-tools):not([class*="menu-appearance"]) {
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

// Remove Screen Options and Help tabs
function remove_screen_options_and_help() {
    // Remove Screen Options tab
    add_filter('screen_options_show_screen', '__return_false');
    
    // Remove Help tab
    add_filter('contextual_help', 'remove_help_tabs', 999, 3);
}
add_action('admin_head', 'remove_screen_options_and_help');

// Function to remove help tabs
function remove_help_tabs($old_help, $screen_id, $screen) {
    $screen->remove_help_tabs();
    return $old_help;
}

// Add sidebar toggle functionality
function add_sidebar_toggle_script() {
    if (!is_admin()) return;

    // Get current screen
    $screen = get_current_screen();
    $is_editing_post = ($screen && $screen->base === 'post');
    $current_post_type = $screen ? $screen->post_type : '';
    
    // Clean up post type name for display
    $display_post_type = ucwords(str_replace('_', ' ', $current_post_type));
    ?>
    <style>
        /* Hide sidebar by default except for specific menu items */
        #adminmenuwrap:not(.force-show), 
        #adminmenuback:not(.force-show) {
            display: none !important;
        }
        
        /* Adjust main content when sidebar is hidden */
        .folded #wpcontent,
        .folded #wpfooter,
        #wpcontent,
        #wpfooter {
            margin-left: 0 !important;
        }

        /* Show sidebar when toggled */
        body.show-sidebar #adminmenuwrap,
        body.show-sidebar #adminmenuback {
            display: block !important;
        }

        /* Reset Appearance menu styles to WordPress defaults */
        body.show-sidebar #adminmenu #menu-appearance {
            display: block !important;
            position: relative !important;
        }

        body.show-sidebar #adminmenu #menu-appearance > a.menu-top {
            display: block !important;
            position: relative !important;
            padding: 5px 0 !important;
        }

        body.show-sidebar #adminmenu #menu-appearance .wp-submenu {
            display: none !important;
            position: absolute !important;
            top: -1000em !important;
            left: 160px !important;
            margin-top: 0 !important;
            padding: 7px 0 8px !important;
            z-index: 9999 !important;
            background-color: #2c3338 !important;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2) !important;
        }

        body.show-sidebar #adminmenu #menu-appearance.opensub .wp-submenu,
        body.show-sidebar #adminmenu #menu-appearance.wp-has-current-submenu .wp-submenu {
            display: block !important;
            top: 0 !important;
        }

        body.show-sidebar #adminmenu #menu-appearance .wp-submenu li {
            padding: 0 !important;
            margin: 0 !important;
        }

        body.show-sidebar #adminmenu #menu-appearance .wp-submenu a {
            padding: 5px 12px !important;
        }

        /* Only hide Property Management in left sidebar */
        #adminmenu li.menu-top.menu-top-first:not(#menu-appearance):not(#menu-settings):not(#menu-tools) {
            display: none !important;
        }

        body.show-sidebar #wpcontent,
        body.show-sidebar #wpfooter {
            margin-left: 160px !important;
        }

        /* Toggle button styles */
        .admin-quick-nav {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 9999;
        }

        .admin-quick-nav button {
            padding: 8px 15px;
            background: #1d2327;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            min-width: 80px;
            height: auto;
        }

        .admin-quick-nav button:hover {
            background: #2c3338;
            transform: translateY(-1px);
        }

        .admin-quick-nav button.settings {
            width: auto;
            flex-direction: row;
            padding: 10px 15px;
        }

        .admin-quick-nav button .dashicons {
            font-size: 20px;
            width: 20px;
            height: 20px;
            margin-bottom: 4px;
        }

        .admin-quick-nav button span.button-text {
            font-size: 12px;
            margin-top: 2px;
            text-align: center;
            line-height: 1.2;
        }

        .admin-quick-nav button span.post-type-text {
            font-size: 11px;
            opacity: 0.9;
            display: block;
            margin-top: 2px;
        }

        /* Password modal styles */
        .password-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10000;
        }

        .password-modal input {
            margin: 10px 0;
            padding: 8px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .password-modal button {
            background: #1d2327;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }
    </style>

    <!-- Password Modal -->
    <div class="modal-overlay" id="modalOverlay"></div>
    <div class="password-modal" id="passwordModal">
        <h3>Enter Password</h3>
        <input type="password" id="sidebarPassword" placeholder="Enter password">
        <button onclick="validatePassword()">Submit</button>
    </div>

    <!-- Navigation Buttons -->
    <div class="admin-quick-nav">
        <button onclick="window.location.href='<?php echo admin_url(); ?>'" title="Home">
            <span class="dashicons dashicons-admin-home"></span>
            <span class="button-text">Home</span>
        </button>
        <?php if ($is_editing_post && $current_post_type): ?>
        <button onclick="window.location.href='<?php echo admin_url('edit.php?post_type=' . $current_post_type); ?>'" title="View All <?php echo $display_post_type; ?>s">
            <span class="dashicons dashicons-list-view"></span>
            <span class="button-text">View All<span class="post-type-text"><?php echo $display_post_type; ?>s</span></span>
        </button>
        <?php endif; ?>
        <?php if (!$is_editing_post): ?>
        <button onclick="window.location.href='<?php echo admin_url('edit.php?post_type=page'); ?>'" title="Pages">
            <span class="dashicons dashicons-admin-page"></span>
            <span class="button-text">Pages</span>
        </button>
        <button onclick="window.location.href='<?php echo admin_url('admin.php?page=contact-info-settings'); ?>'" title="Contact Info">
            <span class="dashicons dashicons-phone"></span>
            <span class="button-text">Contact</span>
        </button>
        <button id="sidebar-toggle" class="settings">Advanced Settings</button>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('sidebar-toggle');
            const passwordModal = document.getElementById('passwordModal');
            const modalOverlay = document.getElementById('modalOverlay');
            const correctPassword = '42069';
            let sidebarVisible = false;

            // Function to ensure Appearance menu behaves correctly
            function setupAppearanceMenu() {
                if (document.body.classList.contains('show-sidebar')) {
                    const appearanceMenu = document.querySelector('#menu-appearance');
                    if (appearanceMenu) {
                        // Remove any inline styles that might interfere
                        appearanceMenu.style = '';
                        appearanceMenu.querySelector('.wp-submenu').style = '';
                        appearanceMenu.querySelectorAll('.wp-submenu li').forEach(item => {
                            item.style = '';
                        });
                    }
                }
            }

            // Check localStorage for sidebar state
            if (localStorage.getItem('sidebarVisible') === 'true') {
                document.body.classList.add('show-sidebar');
                sidebarVisible = true;
                if (toggleButton) {
                    toggleButton.textContent = 'Hide Advanced Settings';
                }
                setupAppearanceMenu();
            }

            if (toggleButton) {
                toggleButton.addEventListener('click', function() {
                    if (!sidebarVisible) {
                        passwordModal.style.display = 'block';
                        modalOverlay.style.display = 'block';
                    } else {
                        hideSidebar();
                    }
                });
            }

            window.validatePassword = function() {
                const password = document.getElementById('sidebarPassword').value;
                if (password === correctPassword) {
                    showSidebar();
                    passwordModal.style.display = 'none';
                    modalOverlay.style.display = 'none';
                    document.getElementById('sidebarPassword').value = '';
                } else {
                    alert('Incorrect password');
                }
            }

            function showSidebar() {
                document.body.classList.add('show-sidebar');
                sidebarVisible = true;
                if (toggleButton) {
                    toggleButton.textContent = 'Hide Advanced Settings';
                }
                localStorage.setItem('sidebarVisible', 'true');
                setupAppearanceMenu();
            }

            function hideSidebar() {
                document.body.classList.remove('show-sidebar');
                sidebarVisible = false;
                if (toggleButton) {
                    toggleButton.textContent = 'Advanced Settings';
                }
                localStorage.setItem('sidebarVisible', 'false');
            }

            // Close modal when clicking overlay
            modalOverlay.addEventListener('click', function() {
                passwordModal.style.display = 'none';
                modalOverlay.style.display = 'none';
                document.getElementById('sidebarPassword').value = '';
            });

            // Run setupAppearanceMenu periodically to handle any dynamic changes
            setInterval(setupAppearanceMenu, 1000);
        });
    </script>
    <?php
}
add_action('admin_footer', 'add_sidebar_toggle_script');

// Add custom styles for admin menu and View Site link
function add_view_site_styles() {
    if (!is_admin_bar_showing()) return;
    ?>
    <style>
        /* Change Dashboard icon to home */
        #adminmenu li.menu-top:first-child .wp-menu-image:before {
            content: "\f102" !important;
        }

        /* Style the View Site link */
        #wpadminbar #wp-admin-bar-site-name > .ab-item {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif !important;
            font-size: 14px !important;
            display: flex !important;
            align-items: center !important;
        }

        /* Hide the default house icon */
        #wpadminbar #wp-admin-bar-site-name > .ab-item:before {
            display: none !important;
        }

        #wpadminbar #wp-admin-bar-site-name > .ab-item .ab-icon {
            margin-right: 5px !important;
            font-size: 20px !important;
            width: 20px !important;
            height: 20px !important;
            padding: 0 !important;
        }

        #wpadminbar #wp-admin-bar-site-name > .ab-item .ab-icon:before {
            content: "\f319" !important;
            top: 0 !important;
        }

        #wpadminbar #wp-admin-bar-site-name > .ab-item .ab-label {
            font-size: 14px !important;
        }

        #wpadminbar #wp-admin-bar-site-name:hover > .ab-item .ab-icon:before,
        #wpadminbar #wp-admin-bar-site-name:hover > .ab-item .ab-label {
            color: #72aee6 !important;
        }
    </style>
    <?php
}
add_action('admin_head', 'add_view_site_styles');
add_action('wp_head', 'add_view_site_styles');

// Change site name in admin bar to "View Site"
function modify_admin_bar_site_name($wp_admin_bar) {
    // Get the site node
    $site_node = $wp_admin_bar->get_node('site-name');
    if ($site_node) {
        $site_node->title = '<span class="ab-icon dashicons dashicons-admin-site"></span><span class="ab-label">View Site</span>';
        $wp_admin_bar->add_node($site_node);
    }
}
add_action('admin_bar_menu', 'modify_admin_bar_site_name', 31); 