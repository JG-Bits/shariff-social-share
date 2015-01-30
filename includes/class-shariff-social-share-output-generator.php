<?php
/**
 * The file contains the class for build the frontend-output
 *
 * @since      		1.0.0
 * @package    		shariff_social_share
 * @subpackage 		shariff_social_share/includes
 *
 * @copyright		2014 JG-Bits UG (haftungsbeschränkt) / Hendrik Jürst
 *
 * @license 		GPLv2 or later
 * @license 		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * This class is used to geneterate the frontend-output 
 *
 * @since      1.0.0
 * @package    shariff_social_share
 * @subpackage shariff_social_share/includes
 * @author     JG-Bits UG (haftungsbeschränkt) / Hendrik Jürst <info@jg-bits.de>
 */
class shariff_social_share_output_generator
{
	/**
	 * @since    1.0.0
	 * @access   public
	 * @var      string    const plugin_settings_prefix    The Plugin-prefix.
	 */
	const plugin_settings_prefix = "shariff_social_share_";

	public $position;
	public $active;
	public $plattforms;
	public $orientation;
	public $color;
	public $classes;
	public $styles;

	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $plattform_keys	The options plattforms-prefix.
	 */
	private $plattform_keys = array('plattforms_facebook', 
									'plattforms_twitter',
									'plattforms_googleplus',
									'plattforms_mail');

	/**
	 * filters the post-/page content and adds social-share-buttons if activated at the
	 * defined position
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param 	 string $content post-/page-content from the_content-/the_excerpt-filter.
	 * @return 	 string content with or without social-share buttons and their position (top 
	 *			 bottom ...)
	 */
	public function generate_output( $content )
	{

		if ($this->active != TRUE) {
			if (!empty($this->classes)) {
				$this->classes = " " . $this->classes;
			}

			if (!empty($this->styles)) {
				$this->styles = ' style="' . $this->styles . '"';
			}

			$sharif_html = '<div class="shariff shariff-social-share' . $this->classes . '"' . $this->styles . ' data-backend-url="'.plugins_url( 'backend/index.php', dirname(__FILE__) ).'" 
							data-orientation="' . $this->orientation . '" data-services="' . $this->plattforms . '" 
							data-theme="' . $this->color . '" data-lang="' . __('en', 'shariff-social-share') . '" data-url="'.get_permalink().'"></div>';
			switch ($this->position) {
				case 'top':
					return $sharif_html . $content;
					break;
				case 'bottom':
					return $content . $sharif_html;
					break;
				case 'topbottom':
					return $sharif_html . $content . $sharif_html;
					break;
				default:
					return $content;
					break;
			}
			
		}
		else
		{
			return $content;
		}
	}

	/**
	 * generates dropdown input for setting-fields
	 *
	 * @since    1.0.0
	 * @access   public
	 * @return 	 null returns null if design_embedding = manual or page-/post-embedding is deactivated
	 */
	public function get_settings( $shortcode = FALSE)
	{
		global $post;

		if ($shortcode == FALSE) {
			if (get_option(self::plugin_settings_prefix . 'design_embedding') === 'ma­nu­al') {
				$this->active = TRUE;
				return;
			}

			/* if deactivated on pages or posts dont show share-buttons */
			if (isset($post) || $this->active == TRUE) {
				if ($post->post_type == 'page' && !get_option(self::plugin_settings_prefix . 'design_pages')) {
					remove_filter('the_content', array($this, 'generate_output'));
					remove_filter('the_excerpt', array($this, 'generate_output'));
					return;
				}

				if ($post->post_type == 'post' && !get_option(self::plugin_settings_prefix . 'design_posts')) {
					remove_filter('the_content', array($this, 'generate_output'));
					remove_filter('the_excerpt', array($this, 'generate_output'));
					return;
				}
			}
		}
		
		/************************************************************************************************/

		if ($shortcode == FALSE) {
			if (isset($post) && !$this->active == TRUE) {
				$meta_deactivation = get_post_meta($post->ID, self::plugin_settings_prefix . 'post_page_based_deactivation');
				$meta_position = get_post_meta($post->ID, self::plugin_settings_prefix . 'post_page_based_position');
				

				if (empty($meta_deactivation) || $meta_deactivation[0] == FALSE || is_home())
				{
					$this->active = FALSE;
					if (!get_option(self::plugin_settings_prefix . 'design_css')) {
						add_action('wp_enqueue_scripts', array($this, 'load_shariff_social_share_styles'));
					}
					add_action('wp_footer', array($this, 'load_shariff_social_share_js'));

				}
				else
				{
					$this->active = TRUE;
				}

				if (!empty($meta_position[0])) {
					if ($meta_position[0] != 'default') {
						$this->position = esc_attr($meta_position[0]);
					}
					else
					{
						$this->position = FALSE;
					}
				}
				else
				{
					$this->position = FALSE;
				}
			}
		}

		/* get general settings */
		foreach ($this->plattform_keys as $key) {
			if (get_option(self::plugin_settings_prefix . $key)) {
				if (empty($this->plattforms)) {
					$this->plattforms = '[&quot;' . explode('_', $key)[1] . '&quot;';
				}
				else
				{
					$this->plattforms .= ',&quot;' . explode('_', $key)[1] . '&quot;';
				}
			}
		}
		if (!empty($this->plattforms)) {
			$this->plattforms .= ',&quot;info&quot;]';
		}

		$this->orientation = esc_attr(get_option(self::plugin_settings_prefix . 'design_orientation'));
		$this->color = esc_attr(get_option(self::plugin_settings_prefix . 'design_color'));
		if ($this->position == FALSE) {
			$this->position = esc_attr(get_option(self::plugin_settings_prefix . 'design_position'));	
		}
		$this->classes = esc_attr(get_option(self::plugin_settings_prefix . 'design_css_class'));
		$this->styles = esc_attr(get_option(self::plugin_settings_prefix . 'design_css_styles'));
	}


	/**
	 * embed CSS-File in head
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function load_shariff_social_share_styles()
	{
		wp_register_style( 'social_shariff_share_styles', plugins_url( '/shariff-social-share/frontend/shariff.min.css' ) );
		wp_enqueue_style( 'social_shariff_share_styles' );
	}

	/**
	 * add js-script to footer and load async to prevent blocking
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function load_shariff_social_share_js()
	{
		echo '<script async src="'. plugins_url( '/shariff-social-share/frontend/shariff.min.js', dirname( dirname(__FILE__) ) ).'"></script>'."\n";
	}
}
?>