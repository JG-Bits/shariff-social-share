<?php
/**
 * Shariff Social Share
 *
 * @version  		1.1.0
 * @package         shariff_social_share
 * @license 		GPLv2 or later
 * @license 		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @copyright		2014 JG-Bits UG (haftungsbeschränkt) / Hendrik Jürst
 *
 * @wordpress-plugin
 * Plugin Name:		Shariff Social Share
 * Plugin URI:		https://www.jg-bits.de/?p=670
 * Description:		Easy and indiviudal embedding of your favourite share-buttons and privacy-protection for share-functionality
 * Version:			1.1.0
 * Author:			JG-Bits UG (haftungsbeschränkt) / Hendrik Jürst
 * Author URI:		http://www.jg-bits.de/
 * License:			GPLv2 or later
 * License URI: 	http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain:		shariff-social-share
 * Domain Path:		/languages
 */


if ( !defined( 'WPINC' ) && !defined('ABSPATH')) {
	die;
}


/**
 * include all required file
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-shariff-social-share.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-shariff-social-share-meta-box.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-shariff-social-share-shortcode.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-shariff-social-share-output-generator.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-shariff-social-share-activator.php';

/**
 *	register activation & deactivation hook
 */
register_activation_hook( __FILE__ , array( 'shariff_social_share_activator', 'init_default_settings' ) );

/**
 * Begins execution of the plugin.
 * Load Textdomain for internationalization & 
 * active plugin-functionality
 *
 * @since    1.0.0
 */
function run_shariff_social_share()
{

	load_plugin_textdomain('shariff-social-share', false, dirname(plugin_basename(__FILE__)).'/languages' );

	$plugin = new shariff_social_share_class();
	$meta_box = new shariff_social_share_meta_box();
	$shortcode = new shariff_social_share_shortcode();

	$output_gen = new shariff_social_share_output_generator();

	add_action('get_header', array($output_gen, 'get_settings') );
	add_filter('the_content', array($output_gen, 'generate_output'));
	add_filter('the_excerpt', array($output_gen, 'generate_output'));

}
run_shariff_social_share();


?>