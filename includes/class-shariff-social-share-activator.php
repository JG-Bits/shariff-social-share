<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @since      1.0.0
 * @package    shariff_social_share
 * @subpackage shariff_social_share/includes
 *
 * @copyright		2014 JG-Bits UG (haftungsbeschränkt) /Hendrik Jürst
 *
 * @license 		GPLv2 or later
 * @license 		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * called if a class wants to acess the plugin-settings in database
 *
 * @since      		1.0.0
 * @package    		shariff_social_share
 * @subpackage 		shariff_social_share/includes
 *
 * @author     		JG-Bits UG (haftungsbeschränkt) / Hendrik Jürst <info@jg-bits.de>
 * @copyright		2014 JG-Bits UG (haftungsbeschränkt)
 *
 * @license 		GPLv2 or later
 * @license 		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class shariff_social_share_activator
{

	/**
	 * @since    1.0.0
	 * @access   public
	 * @var      string    const plugin_settings_prefix    The Plugin-prefix.
	 */
	const plugin_settings_prefix = "shariff_social_share_";
	
	/**
	 * @since    1.0.0
	 * @access   public
	 */
	public static function register_settings()
	{
		register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'plattforms_googleplus',
	        'intval'
	    );
	     
	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'plattforms_facebook',
	        'intval'
	    );
	     
	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'plattforms_twitter',
	        'intval'
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'plattforms_linkedin',
	        'intval'
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'plattforms_pinterest',
	        'intval'
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'plattforms_xing',
	        'intval'
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'plattforms_whatsapp',
	        'intval'
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'plattforms_mail',
	        'intval'
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'design_embedding',
	        'esc_attr'
	        
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'design_orientation',
	        'esc_attr'
	        
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'design_color',
	        'esc_attr'
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'design_position',
	        'esc_attr'
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'design_css',
	        'intval'
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'design_css_class',
	        'esc_attr'
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'design_css_styles',
	        'esc_attr'
	    );

	    register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'design_pages',
	        'intval'
	    );

	     register_setting(
	        self::plugin_settings_prefix . 'setting',
	        self::plugin_settings_prefix . 'design_posts',
	        'intval'
	    );
	}

	/**
	 * called on plugin-activation-hook
	 *
	 * @since      1.0.0
	 *
	 * @package    shariff_social_share
	 * @subpackage shariff_social_share/includes
	 */
	public static function init_default_settings()
	{
		//first register setting to update default settings
		self::register_settings();

		//default plattform settings
		add_option(self::plugin_settings_prefix . 'plattforms_googleplus', 1);
		add_option(self::plugin_settings_prefix . 'plattforms_facebook', 1);
		add_option(self::plugin_settings_prefix . 'plattforms_twitter', 1);
		add_option(self::plugin_settings_prefix . 'plattforms_linkedin', 1);
		add_option(self::plugin_settings_prefix . 'plattforms_pinterest', 1);
		add_option(self::plugin_settings_prefix . 'plattforms_xing', 1);
		add_option(self::plugin_settings_prefix . 'plattforms_whatsapp', 1);
		add_option(self::plugin_settings_prefix .'plattforms_mail', 1);

		//default design settings
		add_option(self::plugin_settings_prefix . 'design_embedding', 'automatic');
		add_option(self::plugin_settings_prefix . 'design_orientation', 'horizontal');
		add_option(self::plugin_settings_prefix . 'design_color', 'colored');
		add_option(self::plugin_settings_prefix . 'design_position', 'bottom');
		add_option(self::plugin_settings_prefix . 'design_css', 0);
		add_option(self::plugin_settings_prefix . 'design_css_class', '');
		add_option(self::plugin_settings_prefix . 'design_css_styles', '');
		add_option(self::plugin_settings_prefix . 'design_pages', 1);
		add_option(self::plugin_settings_prefix . 'design_posts', 1);

	}
}
?>