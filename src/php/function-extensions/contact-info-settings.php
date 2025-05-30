<?php
/**
 * Create Contact Info Settings Page
 * 
 * HOW TO USE THESE SETTINGS IN DIFFERENT FILES:
 * 
 * 1. In PHP Files:
 *    $settings = get_contact_info_settings();
 *    $whatsapp_number = $settings['whatsapp_number'];
 *    $whatsapp_message = $settings['whatsapp_message'];
 * 
 * 2. In JavaScript Files:
 *    const whatsappNumber = contactInfoSettings.whatsappNumber;
 *    const whatsappMessage = contactInfoSettings.whatsappMessage;
 *
 */

// Add menu item to WordPress admin
add_action('admin_menu', 'add_contact_info_page');
function add_contact_info_page() {
    add_menu_page(
        'Contact Info Settings',
        'Contact Info',
        'manage_options',
        'contact-info-settings',
        'render_contact_info_page',
        'dashicons-phone',
        6
    );
}

// Register settings
add_action('admin_init', 'register_contact_info_settings');
function register_contact_info_settings() {
    register_setting('contact_info_settings', 'whatsapp_number');
    register_setting('contact_info_settings', 'whatsapp_message');
}

// Render the settings page
function render_contact_info_page() {
    ?>
    <div class="wrap">
        <h1>Contact Information Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('contact_info_settings');
            do_settings_sections('contact_info_settings');
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="whatsapp_number">WhatsApp Number</label>
                    </th>
                    <td>
                        <input type="text" id="whatsapp_number" name="whatsapp_number" 
                               value="<?php echo esc_attr(get_option('whatsapp_number')); ?>" 
                               class="regular-text">
                        <p class="description">Enter the WhatsApp number with country code (e.g., 447523683134)</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="whatsapp_message">Default Message</label>
                    </th>
                    <td>
                        <textarea id="whatsapp_message" name="whatsapp_message" 
                                  class="large-text" rows="4"><?php echo esc_textarea(get_option('whatsapp_message', 'Hello, I came across an opportunity on your website and would appreciate more information regarding')); ?></textarea>
                        <p class="description" style="max-width: 400px;">This message will be used to send to the user when they click the whatsapp button on the investment deals or any other page that has property name at the end <br> <span style="font-weight: bold;"> e.g Your Message [investment deal 1]</span>.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Function to expose settings to JavaScript
add_action('wp_enqueue_scripts', 'enqueue_contact_info_settings');
function enqueue_contact_info_settings() {
    // First register and enqueue your script
    wp_register_script('whatsapp-button', get_template_directory_uri() . '/src/js/whatsapp-button.js', array('jquery'), '1.0', true);
    wp_enqueue_script('whatsapp-button');

    // Then localize it with your settings
    wp_localize_script('whatsapp-button', 'contactInfoSettings', array(
        'whatsappNumber' => get_option('whatsapp_number'),
        'whatsappMessage' => get_option('whatsapp_message')
    ));
}

// Helper function to get settings in PHP files
function get_contact_info_settings() {
    return array(
        'whatsapp_number' => get_option('whatsapp_number'),
        'whatsapp_message' => get_option('whatsapp_message')
    );
} 