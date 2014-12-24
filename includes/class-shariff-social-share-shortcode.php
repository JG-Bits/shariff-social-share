<?php
require_once('class-shariff-social-share-output-generator.php');

/**
 * The file contains the class for implement shortcode-functionality
 *
 * @since      	1.0.0
 * @package    	shariff_social_share
 * @subpackage 	shariff_social_share/includes
 *
 * @copyright	2014 JG-Bits UG (haftungsbeschränkt) / Hendrik Jürst
 *
 * @license 	GPLv2 or later
 * @license 	http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * This class is used to add the meta-box in page-/post-editor
 *
 * @since      	1.0.0
 * @package    	shariff_social_share
 * @subpackage 	shariff_social_share/includes
 * @author     	JG-Bits UG (haftungsbeschränkt) / Hendrik Jürst <info@jg-bits.de>
 */
class shariff_social_share_shortcode
{
	const plugin_settings_prefix = "shariff_social_share_";

	function __construct()
	{
		add_action( 'init', array($this, 'register_shortcodes'));
		add_action('get_header', array($this, 'has_shortcode'));	
	}

	/**
	 * if page-/post-content has shortcode enqueue script and style
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes()
	{
		add_shortcode( 'shariff-social-share', array($this, 'shariff_social_share_styles_shortcode'));
	}

	/**
	 * if page-/post-content has shortcode enqueue script and style
	 *
	 * @since    1.0.0
	 */
	public function shariff_social_share_styles_shortcode( $atts )
	{
		$output_gen = new shariff_social_share_output_generator();
		$output_gen->get_settings(TRUE);

		//sets orientation if set in shortcode
		if (isset($atts['orientation']))
		{
			if ($atts['orientation'] == 'horizontal' || $atts['orientation'] == 'vertical')
			{
				$output_gen->orientation = $atts['orientation'];
			}

		}
		//sets shortcode color if used
		if (isset($atts['color']))
		{
			if ($atts['color'] == 'colored' || $atts['color'] == 'grey' || $atts['color'] == 'white')
			{
				$output_gen->color = $atts['color'];
			}	
		}
		//sets class if in shortcode
		if (isset($atts['class']))
		{
			$output_gen->classes = esc_attr($atts['class']);
		}
		//sets css-styles if in shortcode
		if (isset($atts['styles']))
		{
			$output_gen->styles = esc_attr($atts['styles']);
		}

		if (!empty($output_gen->classes)) {
			$output_gen->classes = " " . $output_gen->classes;
		}

		if (!empty($output_gen->styles)) {
			$output_gen->styles = ' style="' . $output_gen->styles . '" ';
		}

		$sharif_html = '<div class="shariff' . $output_gen->classes . '"' . $output_gen->styles . 'data-backend-url="'.plugins_url( 'backend/index.php', dirname(__FILE__) ).'" 
							data-orientation="' . $output_gen->orientation . '" data-services="' . $output_gen->plattforms . '" 
							data-theme="' . $output_gen->color . '"></div>';
		return $sharif_html;
	}

	/**
	 * if page-/post-content has shortcode enqueue script and style
	 *
	 * @since    1.0.0
	 */
	public function has_shortcode()
	{
		global $post;
		$page_post_based_deactivation = get_post_meta($post->ID, self::plugin_settings_prefix . 'post_page_based_deactivation');

		if (get_option(self::plugin_settings_prefix . 'design_embedding') === 'ma­nu­al' || 
			(get_option(self::plugin_settings_prefix . 'design_embedding') === 'automatic' && !get_option(self::plugin_settings_prefix . 'design_pages') && is_page($post->ID)) ||
			(get_option(self::plugin_settings_prefix . 'design_embedding') === 'automatic' && !get_option(self::plugin_settings_prefix . 'design_posts') && get_post_type( $post->ID) == 'post') ||
			$page_post_based_deactivation[0] == TRUE) 
		{
			$content = get_post($post->ID);
			if ( has_shortcode( $content->post_content, 'shariff-social-share' ))
			{
				$output_gen = new shariff_social_share_output_generator();
				$output_gen->get_settings(TRUE);

				add_action('wp_enqueue_scripts', array($output_gen, 'load_shariff_social_share_styles'));
				add_action('wp_footer', array($output_gen, 'load_shariff_social_share_js'));
			}
		}
	}
}
?>