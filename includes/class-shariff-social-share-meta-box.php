<?php
require_once("class-shariff-social-share.php");

/**
 * The file contains the class for build the frontend-output
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
class shariff_social_share_meta_box extends shariff_social_share_class
{
	
	function __construct()
	{
		add_action( 'add_meta_boxes', array($this, 'add_shariff_social_share_box'));
		add_action( 'save_post', array($this, self::plugin_settings_prefix . 'save_meta_box' ));
	}

	/**
	 * adds the meta box in page- and post-editor
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param 	 string $post_type contains the post-type
	 */
	public function add_shariff_social_share_box($post_type)
	{
		$post_types = array('post', 'page');     //limit meta box to certain post types
		if ( in_array( $post_type, $post_types ))
		{
			add_meta_box(
				'shariff_social_share_meta_box',
				'Shariff Social Share',
				array( $this, 'render_meta_box_content' ),
				$post_type,
				'advanced',
				'high'
			);
        }
	}

	/**
	 * generates output for meta-box in post-/page-editor
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param 	 WP_Post $post The object for the current post/page.
	 */
	public function render_meta_box_content( $post )
	{
		$values = get_post_custom( $post->ID );
		$check = isset( $values[self::plugin_settings_prefix . 'post_page_based_deactivation'] ) ? esc_attr( $values[self::plugin_settings_prefix . 'post_page_based_deactivation'][0] ) : '';
		$selected = isset( $values[self::plugin_settings_prefix . 'post_page_based_position'] ) ? esc_attr( $values[self::plugin_settings_prefix . 'post_page_based_position'][0] ) : '';
		wp_nonce_field( self::plugin_settings_prefix . 'meta_box', self::plugin_settings_prefix. 'meta_box_nonce' );
		?>
		<p>
			<input type="checkbox" id="<?php echo self::plugin_settings_prefix . 'post_page_based_deactivation'; ?>" name="<?php echo self::plugin_settings_prefix . 'post_page_based_deactivation'; ?>" <?php checked( $check, 'on' ); ?>/>
	        <label for="<?php echo self::plugin_settings_prefix . 'post_page_based_deactivation';?>"><?php echo __('deactivate?', 'shariff-social-share');?></label>
    	</p>
        <p>
	        <label for="<?php echo self::plugin_settings_prefix . 'post_page_based_position'; ?>">Position</label>
	        <select name="<?php echo self::plugin_settings_prefix . 'post_page_based_position'; ?>" id="<?php echo self::plugin_settings_prefix . 'post_page_based_position'; ?>" <?php if ($check){ echo 'disabled="disabled"'; }?>>
	            <option value="default" <?php selected( $selected, 'top' ); ?>><?php echo __('default', 'shariff-social-share');?></option>
	            <option value="top" <?php selected( $selected, 'top' ); ?>><?php echo __('top', 'shariff-social-share'); ?></option>
	            <option value="bottom" <?php selected( $selected, 'bottom' ); ?>><?php echo __('bottom', 'shariff-social-share');?></option>
	            <option value="topbottom" <?php selected( $selected, 'topbottom' ); ?>><?php echo __('top &amp; bottom', 'shariff-social-share');?></option>
	        </select>
    	</p>
   		<?php
	}

	/**
	 * save meta-box settings
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param 	 int $post_id The ID of the post being saved.
	 */
	public function shariff_social_share_save_meta_box( $post_id )
	{
		// Bail if we're doing an auto save
	    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	     
	    // if our nonce isn't there, or we can't verify it, bail
	    if( !isset( $_POST[self::plugin_settings_prefix. 'meta_box_nonce'] ) || !wp_verify_nonce( $_POST[self::plugin_settings_prefix. 'meta_box_nonce'], self::plugin_settings_prefix . 'meta_box' ) ) return;

	    // if our current user can't edit this post, bail
    	if( !current_user_can( 'edit_post', $post_id ) ) return;

    	if (isset($_POST[self::plugin_settings_prefix . 'post_page_based_deactivation'])) {
    		update_post_meta( $post_id, self::plugin_settings_prefix . 'post_page_based_deactivation', esc_attr( $_POST[self::plugin_settings_prefix . 'post_page_based_deactivation'] ) );
    	}
    	else
    		update_post_meta( $post_id, self::plugin_settings_prefix . 'post_page_based_deactivation', 0 );	

    	if (isset($_POST[self::plugin_settings_prefix . 'post_page_based_position'])) {
    		update_post_meta( $post_id, self::plugin_settings_prefix . 'post_page_based_position', esc_attr( $_POST[self::plugin_settings_prefix . 'post_page_based_position'] ) );
    	}
	}
}
?>