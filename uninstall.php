<?php
require_once plugin_dir_path( __FILE__ ) . 'includes/class-shariff-social-share-activator.php';
/**
 * if called when user wants to delete the plugin
 * removes all settings from database
 *
 * @link       http://www.jg-bits.de
 * @since      1.0.0
 *
 * @package    Shariff Social Share
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

$register_settings = new shariff_social_share_activator();
$register_settings->register_settings();

delete_option();

//default plattform settings
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'plattforms_googleplus');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'plattforms_facebook');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'plattforms_twitter');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'plattforms_linkedin');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'plattforms_pinterest');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'plattforms_xing');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'plattforms_whatsapp');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'plattforms_mail');

//default design settings
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'design_embedding');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'design_orientation');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'design_color');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'design_position');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'design_css');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'design_css_class');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'design_css_styles');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'design_pages');
delete_option(shariff_social_share_activator::plugin_settings_prefix . 'design_posts');
