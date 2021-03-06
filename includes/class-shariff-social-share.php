<?php
require_once('class-shariff-social-share-output-generator.php');
require_once('class-shariff-social-share-activator.php');

/**
 * The file that defines the core plugin class
 *
 * @since      1.0.0
 * @package    shariff_social_share
 * @subpackage shariff_social_share/includes
 *
 * @copyright		2014 JG-Bits UG (haftungsbeschränkt) / Hendrik Jürst
 *
 * @license 		GPLv2 or later
 * @license 		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    shariff_social_share
 * @subpackage shariff_social_share/includes
 * @author     JG-Bits UG (haftungsbeschränkt) / Hendrik Jürst <info@jg-bits.de>
 */
class shariff_social_share_class
{
	/**
	 * @since    1.0.0
	 * @access   public
	 * @var      string    const plugin_settings_prefix    The Plugin-prefix.
	 */
	const plugin_settings_prefix = "shariff_social_share_";
	
	function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'admin_page_init' ) );
		add_action( 'admin_enqueue_scripts', array($this, 'load_scripts_styles'), 100 );
	}

	/**
	 * adds the settings-page to wordpress-backend
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function add_plugin_page()
	{
		add_options_page('Shariff Social Share', 'Shariff Social Share', 'manage_options', self::plugin_settings_prefix . 'page', array($this, 'add_admin_page'));
	}

	/**
	 * outputs the settings-page-content
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function add_admin_page()
	{
		?>
	    <div class="wrap">
	 
	        <div id="icon-themes" class="icon32"></div>
	        <h2><?php echo __("Shariff Social Share Settings", 'shariff-social-share'); ?></h2>
	        <p class="description"><?php echo __('For individual embedding of the Social-Share-Buttons you can use the following Shortcode:', 'shariff-social-share');?> </p>
			<code>[shariff-social-share]</code>
			<p class="description"><?php echo __('or set individual settings for share-buttons only for this shortcode:', 'shariff-social-share');?></p>
			<code>[shariff-social-share color="standard" orientation="vertical" class="myclass" styles="margin: 10px;"] <?php echo __('for more see: ', 'shariff-social-share');?><a href="https://github.com/JG-Bits/shariff-social-share">https://github.com/JG-Bits/shariff-social-share</a></code>
			
	        <?php //settings_errors(); ?>
	 
	        <form method="post" action="options.php">
	            <?php settings_fields( self::plugin_settings_prefix . 'setting' ); ?>
	            <?php do_settings_sections( self::plugin_settings_prefix . 'setting' ); ?>

	            <?php submit_button(); ?>
	        </form>
	 
	    </div><!-- /.wrap -->
	    <?php
	}

	/**
	 * adds settings-sections & fields to setting page
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function admin_page_init()
	{

	    add_settings_section(
	        'plattforms_settings_section',
	        __('Platforms', 'shariff-social-share'),
	       '',
	        self::plugin_settings_prefix . 'setting'
	    );
	     
	    add_settings_field( 
	        'facebook',                     
	        'Facebook',              
	        array($this, 'get_checkbox'),  
	        self::plugin_settings_prefix . 'setting',                          
	        'plattforms_settings_section',         
	        array(                              
	            'plattforms_facebook'
	        )
	    );
	     
	    add_settings_field( 
	        'twitter',                      
	        'Twitter',               
	        array($this, 'get_checkbox'),   
	        self::plugin_settings_prefix . 'setting',                          
	        'plattforms_settings_section',
	        array(                              
	            'plattforms_twitter'
	        )
	    );

	    add_settings_field(
	        'google+',
	        'Google+',
	        array($this, 'get_checkbox'),
	        self::plugin_settings_prefix . 'setting',
	        'plattforms_settings_section',
	        array(
	            'plattforms_googleplus'
	        )
	    );

	    add_settings_field(
	        'linkedIn',
	        'linkedIn',
	        array($this, 'get_checkbox'),
	        self::plugin_settings_prefix . 'setting',
	        'plattforms_settings_section',
	        array(
	            'plattforms_linkedin'
	        )
	    );

	    add_settings_field(
	        'pinterest',
	        'pinterest',
	        array($this, 'get_checkbox'),
	        self::plugin_settings_prefix . 'setting',
	        'plattforms_settings_section',
	        array(
	            'plattforms_pinterest'
	        )
	    );

	    add_settings_field(
	        'xing',
	        'xing',
	        array($this, 'get_checkbox'),
	        self::plugin_settings_prefix . 'setting',
	        'plattforms_settings_section',
	        array(
	            'plattforms_xing'
	        )
	    );

	    add_settings_field(
	        'whatsapp',
	        'whatsapp',
	        array($this, 'get_checkbox'),
	        self::plugin_settings_prefix . 'setting',
	        'plattforms_settings_section',
	        array(
	            'plattforms_whatsapp'
	        )
	    );

	    add_settings_field( 
	        'mail',                      
	        'Mail',               
	        array($this, 'get_checkbox'),   
	        self::plugin_settings_prefix . 'setting',                          
	        'plattforms_settings_section',
	        array(                              
	            'plattforms_mail'
	        )
	    );

	    
	    add_settings_section(
	        'design_settings_section',
	        'Design',
	        array($this, 'print_design_preview'),
	        self::plugin_settings_prefix . 'setting'
	    );

	    add_settings_field( 
	        'orientation',
	        __('Orientation', 'shariff-social-share'),
	        array($this, 'get_dropdown'),
	        self::plugin_settings_prefix . 'setting',
	        'design_settings_section',
	        array(
	            'design_orientation',
	            array('horizontal' => 'horizontal', 'vertical' => 'vertical')
	        )
	    );

	    add_settings_field( 
	        'color',
	        __('Color', 'shariff-social-share'),
	        array($this, 'get_dropdown'),
	        self::plugin_settings_prefix . 'setting',
	        'design_settings_section',
	        array(
	            'design_color',
	            array('standard' => __('colored', 'shariff-social-share'), 
	            	'grey' => __('grey', 'shariff-social-share'), 
	            	'white' => __('white', 'shariff-social-share'))
	        )
	    );

	    add_settings_field( 
	        'position',
	        __('Placement for share buttons', 'shariff-social-share'),
	        array($this, 'get_dropdown'),
	        self::plugin_settings_prefix . 'setting',
	        'design_settings_section',
	        array(
	            'design_position',
	            array('top' => __('top', 'shariff-social-share'), 'bottom' => __('bottom', 'shariff-social-share'), 'topbottom' => __('top &amp; bottom', 'shariff-social-share'))
	        )
	    );

	    add_settings_field( 
	        'embedding',
	        __('Embedding', 'shariff-social-share'),
	        array($this, 'get_dropdown'),
	        self::plugin_settings_prefix . 'setting',
	        'design_settings_section',
	        array(
	            'design_embedding',
	            array('automatic' => __('automatic', 'shariff-social-share'), 'ma­nu­al' => __('manual', 'shariff-social-share')),
	            FALSE,
	            array('<b>' . __('automatical: use this to embed at the defined position for each post /page', 'shariff-social-share') . '</b>',
	            	'<b>' . __('manual: use this if you only want to embed manually e.g. with Shortcode', 'shariff-social-share') . '</b>')
	        )
	    );

	    add_settings_field( 
	        'css',
	        __('deactivate CSS', 'shariff-social-share'),
	        array($this, 'get_checkbox'),
	        self::plugin_settings_prefix . 'setting',
	        'design_settings_section',
	        array(
	            'design_css',
	            __('Activate this to use your own CSS-styles', 'shariff-social-share')
	        )
	    );

	    add_settings_field( 
	        'css-class',
	        __('CSS-Class', 'shariff-social-share'),
	        array($this, 'print_css_class_setting'),
	        self::plugin_settings_prefix . 'setting',
	        'design_settings_section'
	    );

	    add_settings_field( 
	        'css-styles',
	        __('CSS-styles', 'shariff-social-share'),
	        array($this, 'print_css_styles_setting'),
	        self::plugin_settings_prefix . 'setting',
	        'design_settings_section'
	    );

	    add_settings_field( 
	        'pages',
	        __('Pages', 'shariff-social-share'),
	        array($this, 'get_checkbox'),
	        self::plugin_settings_prefix . 'setting',
	        'design_settings_section',
	        array(
	            'design_pages',
	            __('activating the &#10004; embeddes on pages', 'shariff-social-share')
	        )
	    );

	    add_settings_field( 
	        'posts',
	        __('Posts', 'shariff-social-share'),
	        array($this, 'get_checkbox'),
	        self::plugin_settings_prefix . 'setting',
	        'design_settings_section',
	        array(
	            'design_posts',
	            __('activating the &#10004; embeddes on posts', 'shariff-social-share')
	        )
	    );
	     
	    // Finally, we register the fields with WordPress

	    $settings_activator = new shariff_social_share_activator();
	    $settings_activator->register_settings();

	}

	/**
	 * echo content for backend-preview
	 *
	 * @since    1.0.0
	 */
	public function print_design_preview()
	{
		$sharif_html = '<div class="shariff-preview"><p class="description"><b>' . __('Live-Preview', 'shariff-social-share') . '</b></p>';
		$sharif_html .= '<div class="shariff shariff-social-share" data-backend-url="' . plugins_url( 'backend/index.php', dirname(__FILE__) ) . '" data-orientation="horizontal" data-services="[&quot;facebook&quot;,&quot;twitter&quot;,&quot;googleplus&quot;,&quot;mail&quot;,&quot;info&quot;,&quot;linkedin&quot;,&quot;pinterest&quot;,&quot;xing&quot;,&quot;whatsapp&quot;]" data-theme="' . esc_attr(get_option(self::plugin_settings_prefix . 'design_color')) . '" data-lang="de" data-url="">
	<ul class="theme-' . esc_attr(get_option(self::plugin_settings_prefix . 'design_color')) . ' orientation-horizontal">';
		$sharif_html .= 
			'<li class="shariff-button facebook' . (esc_attr(get_option(self::plugin_settings_prefix . 'plattforms_facebook')) != 1 ? ' hide': '') . '">

				<a href="">
					<span class="fa fa-facebook"></span>
					<span class="share_text">' . __('share', 'shariff-social-share') . '</span>
				</a>
			</li>
			<li class="shariff-button twitter' . (esc_attr(get_option(self::plugin_settings_prefix . 'plattforms_twitter')) != 1 ? ' hide': '') . '">
				<a href="">
					<span class="fa fa-twitter"></span>
					<span class="share_text">tweet</span>
				</a>
			</li>
			<li class="shariff-button googleplus' . (esc_attr(get_option(self::plugin_settings_prefix . 'plattforms_googleplus')) != 1 ? ' hide': '') . '">
				<a href="">
					<span class="fa fa-google-plus"></span>
					<span class="share_text">+1</span>
				</a>
			</li>
			<li class="shariff-button linkedin' . (esc_attr(get_option(self::plugin_settings_prefix . 'plattforms_linkedin')) != 1 ? ' hide': '') . '">
				<a href="">
					<span class="fa fa-linkedin"></span>
					<span class="share_text">' . __('share', 'shariff-social-share') . '</span>
				</a>
			</li>
			<li class="shariff-button pinterest' . (esc_attr(get_option(self::plugin_settings_prefix . 'plattforms_pinterest')) != 1 ? ' hide': '') . '">
				<a href="">
					<span class="fa fa-pinterest"></span>
					<span class="share_text">' . __('share', 'shariff-social-share') . '</span>
				</a>
			</li>
			<li class="shariff-button xing' . (esc_attr(get_option(self::plugin_settings_prefix . 'plattforms_xing')) != 1 ? ' hide': '') . '">
				<a href="">
					<span class="fa fa-xing"></span>
					<span class="share_text">' . __('share', 'shariff-social-share') . '</span>
				</a>
			</li>
			<li class="shariff-button whatsapp' . (esc_attr(get_option(self::plugin_settings_prefix . 'plattforms_whatsapp')) != 1 ? ' hide': '') . '">
				<a href="">
					<span class="fa fa-whatsapp"></span>
					<span class="share_text">' . __('share', 'shariff-social-share') . '</span>
				</a>
			</li>
			<li class="shariff-button mail' . (esc_attr(get_option(self::plugin_settings_prefix . 'plattforms_mail')) != 1 ? ' hide': '') . '">
				<a href="">
					<span class="fa fa-envelope"></span>
					<span class="share_text">mail</span>
				</a>
			</li>
			<li class="shariff-button info">
				<a href="">
					<span class="fa fa-info"></span>
					<span class="share_text">Info</span>
				</a>
			</li>
		</ul>
	</div></div>';
		echo $sharif_html;
	}

	/**
	 * echo output for css-class-setting
	 *
	 * @since    1.0.0
	 */
	public function print_css_class_setting( $args )
	{
		$value = esc_attr(get_option(self::plugin_settings_prefix . 'design_css_class'));
		$html = '<input type="text" id="' . self::plugin_settings_prefix . 'design_css_class' . '" name="' . self::plugin_settings_prefix . 'design_css_class' . '" value="' . $value . '">';
		$html .= '<p class="description">' . __('for design adjustments you can insert the desired classes for CSS', 'shariff-social-share') . '</p>';

		echo $html;
	}

	/**
	 * echo output for css-styles-setting
	 *
	 * @since    1.0.0
	 */
	public function print_css_styles_setting( $args )
	{
		$value = esc_attr(get_option(self::plugin_settings_prefix . 'design_css_styles'));
		$html = '<input type="text" id="' . self::plugin_settings_prefix . 'design_css_styles' . '" name="' . self::plugin_settings_prefix . 'design_css_styles' . '" value="' . $value . '">';
		$html .= '<p class="description">' . __('for design adjustments you can insert any desired CSS-styles', 'shariff-social-share') . '</p>';

		echo $html;
	}

	/**
	 * generates checkboxes for setting-fields
	 *
	 * @since    1.0.0
	 */
	public function get_checkbox($option)
	{
		$array_count = count($option);

		if ($array_count == 1)
		{
			echo '<input type="checkbox" id="' . self::plugin_settings_prefix . $option[0] .'" name="' . self::plugin_settings_prefix . $option[0] . '" value="1" ' . checked(1, get_option(self::plugin_settings_prefix . $option[0]), false) . '/>';
		}
		elseif ($array_count == 2)
		{
			$html = '<input type="checkbox" id="' . self::plugin_settings_prefix . $option[0] .'" name="' . self::plugin_settings_prefix . $option[0] . '" value="1" ' . checked(1, get_option(self::plugin_settings_prefix . $option[0]), false) . '/>';
			$html .= '<label for="' . self::plugin_settings_prefix . $option[0] . '"> '  . $option[1] . '</label>'; 
			echo $html;	
		}
		elseif ($array_count == 3)
		{
			$html = '<input type="checkbox" id="' . self::plugin_settings_prefix . $option[0] .'" name="' . self::plugin_settings_prefix . $option[0] . '" value="1" ' . checked(1, get_option(self::plugin_settings_prefix . $option[0]), false) . '/>';
			if (!empty($option[1]))
			{
				$html .= '<label for="' . self::plugin_settings_prefix . $option[0] . '"> '  . $option[1] . '</label>';
			}
			$html .= '<p class="description">' . $option[2] . '</p>';
			echo $html;
		}

	}

	/**
	 * generates dropdown input for setting-fields
	 *
	 * @since   1.0.0
	 */
	public function get_dropdown($options)
	{
		$array_count = count($options);
		if ($array_count >= 2)
		{
			if (is_array($options[1]))
			{
				$html = '<select id="' . self::plugin_settings_prefix . $options[0] . '" name="' . self::plugin_settings_prefix . $options[0] . '">';

				foreach ($options[1] as $key => $value) 
				{
					$html .= '<option value="' . $key . '" ';
					if (get_option(self::plugin_settings_prefix . $options[0]) == $key)
					{
						$html .= 'selected';
					}
					$html .=  '>'. $value .'</option>';
				}

				$html .= '</select>';
				echo $html;
			}
			if (isset($options[2]))
			{
				if ($options[2] != FALSE) {
					$html .= '<label for="' . self::plugin_settings_prefix . 'design_css_styles"> '  . $options[0] . '</label>';
					echo $html;
				}

				if (is_array($options[3])) {

					foreach ($options[3] as $key) {
						echo '<p class="description">' . $key . '</p>';
					}
				}
			}
		}

	}

	/**
	 * load scripts and styles for live preview in backend
	 *
	 * @since    1.0.0
	 */
	public function load_scripts_styles()
	{
		if (isset($_GET['page']) && $_GET['page'] != 'shariff_social_share_page') {
			return;
		}

		wp_register_style( 'social_shariff_share_styles', plugins_url( '/shariff-social-share/frontend/shariff.min.css' ) );
		wp_enqueue_style( 'social_shariff_share_styles' );

		wp_register_script( 'social_shariff_share_script_preview', plugins_url( '/shariff-social-share/preview.js', dirname( dirname(__FILE__) ) ) );
		wp_enqueue_script( 'social_shariff_share_script_preview');
	}
	
}
?>
