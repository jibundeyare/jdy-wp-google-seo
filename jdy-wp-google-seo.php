<?php

/*
 * Plugin Name: Jibundeyare WP Google SEO
 * Description: This Wordpress plugin adds HTML code needed for Googler SEO in the `head` tag and right after the opening `body` tag. Prerequisites: This plugin assumes the theme uses the `wp_body_open` hook.
 * Author: Jibundeyare contact@jibundeyare.com
 * Author URI: https://jibundeyare.com
 * Version: 1.0
 * License: MIT License
 */

// register options
function jdy_admin_init() {
    register_setting('jdy_wp_google_seo_options_group', 'jdy_wp_google_seo_head');
    register_setting('jdy_wp_google_seo_options_group', 'jdy_wp_google_seo_body_open');
}
add_action('admin_init', 'jdy_admin_init');

// register admin menu
function jdy_admin_menu() {
    add_options_page('Jibundeyare WP Google SEO', 'Jdy WP Google SEO', 'manage_options', 'jdy-wp-google-seo', 'jdy_wp_google_seo_form');
}
add_action('admin_menu', 'jdy_admin_menu');

// callback function which displays an html form
function jdy_wp_google_seo_form() {
?>
    <div class="wrap">
        <h2>Jibundeyare WP Google SEO - <?php echo __('Setting') ?></h2>
        <form method="post" action="options.php">
            <?php settings_fields('jdy_wp_google_seo_options_group'); ?>
            <div>
                <div>
                    <label for="first_field_id">Head:</label>
                </div>
                <textarea class="regular-text" name="jdy_wp_google_seo_head"><?php echo get_option('jdy_wp_google_seo_head'); ?></textarea>
            </div>
            <div>
                <div>
                    <label for="second_field_id">Body open:</label>
                </div>
                <textarea class="regular-text" name="jdy_wp_google_seo_body_open"><?php echo get_option('jdy_wp_google_seo_body_open'); ?></textarea>
            </div>
            <?php submit_button(); ?>
        </form>
        <p>
            Plugin Name: Jibundeyare WP Google SEO<br>
            Description: This Wordpress plugin adds HTML code needed for Googler SEO in the `head` tag and right after the opening `body` tag. Prerequisites: This plugin assumes the theme uses the `wp_body_open` hook.<br>
            Author: Jibundeyare contact@jibundeyare.com<br>
            Author URI: https://jibundeyare.com<br>
            Version: 1.0<br>
            License: MIT License<br>
        </p>
    </div>
<?php
}

// register a link in the plugins list page
function jdy_plugin_action_links( $actions ) {
    $links = array(
        '<a href="'.admin_url('options-general.php?page=jdy-wp-google-seo').'">'.__( 'Settings' ).'</a>',
    );

    $actions = array_merge($actions, $links);

    return $actions;
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'jdy_plugin_action_links' );

// display html code in the head tag
function jdy_wp_head() {
    // @debug
    // echo "<!-- jdy_wp_google_seo -->\n";
    echo get_option('jdy_wp_google_seo_head');
    echo "\n";
}
// priority -1 ensures the function will be called before all others
add_action('wp_head', 'jdy_wp_head', -1);

// display html code after the opening body tag
function jdy_wp_body_open() {
    // @debug
    // echo "<!-- jdy_wp_google_seo -->\n";
    echo get_option('jdy_wp_google_seo_body_open');
    echo "\n";
}
// priority -1 ensures the function will be called before all others
add_action('wp_body_open', 'jdy_wp_body_open', -1);

