/**
 * Shariff Social Share
 *
 * @version         1.1.0
 * @package         shariff_social_share
 * @license         CC BY-SA 4.0
 * @license         http://creativecommons.org/licenses/by-sa/4.0/
 * @copyright       2014 JG-Bits UG (haftungsbeschränkt)
 *
 * @wordpress-plugin
 * Plugin Name:     Shariff Social Share
 * Plugin URI:      http://example.com/plugin-name-uri/
 * Description:     Easy and indiviudal embedding of your favourite share-buttons and privacy-protection for share-functionality
 * Version:         1.1.0
 * Author:          JG-Bits UG (haftungsbeschränkt) / Oliver Heidemann
 * Author URI:      http://www.jg-bits.de/
 * License:         CC BY-SA 4.0
 * License URI:     http://creativecommons.org/licenses/by-sa/4.0/
 * Text Domain:     shariff-social-share
 * Domain Path:     /languages
 */

jQuery( document ).ready( function( $ ) {

    var validator = {
        shariff_social_share_plattforms_twitter: 'twitter',
        shariff_social_share_plattforms_facebook: 'facebook',
        shariff_social_share_plattforms_googleplus: 'googleplus',
        shariff_social_share_plattforms_linkedin: 'linkedin',
        shariff_social_share_plattforms_pinterest: 'pinterest',
        shariff_social_share_plattforms_xing: 'xing',
        shariff_social_share_plattforms_whatsapp: 'whatsapp',
        shariff_social_share_plattforms_mail: 'mail'
    }

    var pressed = false;

    $( '#shariff_social_share_plattforms_twitter' ).change( function( e ) {
        pressed = (this);
        removeSocial( pressed );
    });

    $( '#shariff_social_share_plattforms_facebook' ).change( function( e ) {
        pressed = (this);
        removeSocial( pressed );
    });

    $( '#shariff_social_share_plattforms_googleplus' ).change( function( e ) {
        pressed = (this);
        removeSocial( pressed );
    });

    $( '#shariff_social_share_plattforms_linkedin' ).change( function( e ) {
        pressed = (this);
        removeSocial( pressed );
    });

    $( '#shariff_social_share_plattforms_pinterest' ).change( function( e ) {
        pressed = (this);
        removeSocial( pressed );
    });

    $( '#shariff_social_share_plattforms_xing' ).change( function( e ) {
        pressed = (this);
        removeSocial( pressed );
    });

    $( '#shariff_social_share_plattforms_whatsapp' ).change( function( e ) {
        pressed = (this);
        removeSocial( pressed );
    });

    $( '#shariff_social_share_plattforms_mail' ).change( function( e ) {
        pressed = (this);
        removeSocial( pressed );
    });

    var removeSocial = function( pressedButton ) {
        var id = pressedButton.id;

        if ( ! $( '#' + id ).prop( 'checked' ) ) {
            $( '.shariff-button.' + validator[ id ] ).addClass( "hide" );
        } else {
            $( '.shariff-button.' + validator[ id ] ).removeClass( "hide" );
        }
    }

    var orientation = function( object ) {
        var orientation = jQuery(object).val();
        var ul = $( 'div.shariff ul' );

        if ( orientation == 'horizontal' ) {
            ul.removeClass( 'orientation-vertical' );
            ul.addClass( 'orientation-horizontal' );
        } else {
            ul.removeClass( 'orientation-horizontal' );
            ul.addClass( 'orientation-vertical' );
        }
    }

    $( '#shariff_social_share_design_orientation' ).change( function( e ) {
        pressed = (this);
        orientation( pressed );
    });

    orientation( $( '#shariff_social_share_design_orientation' ) );


    $( '#shariff_social_share_design_color' ).change( function( e ) {
        var selectedValue = jQuery(this).val();
        var colors = [ 'white', 'grey', 'colored' ];
        var value = '';

        if ( ( value = colors.indexOf( selectedValue ) ) >= 0 && value < colors.length ) {
            $( 'div.shariff ul' ).addClass( 'theme-' + colors[ value ] );
            colors.splice( value, 1 );

            $.each( colors, function( color ) {
                    $( 'div.shariff ul' ).removeClass( 'theme-' + colors[ color ] );
                }
            )
        }
    });
});