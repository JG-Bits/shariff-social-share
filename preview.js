/**
 * Shariff Social Share
 *
 * @version         1.0.0
 * @package         shariff_social_share
 * @license         CC BY-SA 4.0
 * @license         http://creativecommons.org/licenses/by-sa/4.0/
 * @copyright       2014 JG-Bits UG (haftungsbeschränkt)
 *
 * @wordpress-plugin
 * Plugin Name:     Shariff Social Share
 * Plugin URI:      http://example.com/plugin-name-uri/
 * Description:     Easy and indiviudal embedding of your favourite share-buttons and privacy-protection for share-functionality
 * Version:         1.0.0
 * Author:          JG-Bits UG (haftungsbeschränkt) / Hendrik Jürst
 * Author URI:      http://www.jg-bits.de/
 * License:         CC BY-SA 4.0
 * License URI:     http://creativecommons.org/licenses/by-sa/4.0/
 * Text Domain:     shariff-social-share
 * Domain Path:     /languages
 */

jQuery(document).ready(function($){

    var facebook_code = '<li class="shariff-button facebook"><a href=""><span class="share_text">teilen</span></a></li>';
    var twitter_code = '<li class="shariff-button twitter"><a href=""><span class="share_text">tweet</span></a></li>';
    var googleplus_code = '<li class="shariff-button googleplus"><a href=""><span class="share_text">+1</span></a></li>';
    var mail_code = '<li class="shariff-button mail"><a href=""><span class="share_text">mail</span></a></li>';

	if ($('#shariff_social_share_design_orientation').val() == 'horizontal')
	{
		$("div.shariff ul").addClass( "orientation-horizontal" );
	}
	else
	{
		$("div.shariff ul").addClass( "orientation-vertical" );
	}

	/**
	 *	plattform live live
	 */
     $('#shariff_social_share_plattforms_facebook').change(function(e) {
        if (!$('#shariff_social_share_plattforms_facebook').prop('checked')) 
        {
            $( "li" ).remove( ".shariff-button.facebook" );
        } else {
            $( "div.shariff ul" ).prepend( $( facebook_code ) );
        }
    });

     $('#shariff_social_share_plattforms_twitter').change(function(e) {
        if (!$('#shariff_social_share_plattforms_twitter').prop('checked')) 
        {
            $( "li" ).remove( ".shariff-button.twitter" );
        } else {
            if($('li.shariff-button.facebook').length == 1)
            {
                $("div.shariff ul li").eq(0).after( twitter_code );
            }
            else
            {
                $( "div.shariff ul" ).prepend( $( twitter_code ) );
            }
        }
    });

	$('#shariff_social_share_plattforms_googleplus').change(function(e) {
		if (!$('#shariff_social_share_plattforms_googleplus').prop('checked')) 
		{
			$( "li" ).remove( ".shariff-button.googleplus" );
		} else {
            if( $('li.shariff-button.facebook').length == 0 && $('li.shariff-button.twitter').length == 0)
            {
                $( "div.shariff ul" ).prepend( $( googleplus_code ) );
            }
            else if($('li.shariff-button.facebook').length == 1 && $('li.shariff-button.twitter').length == 1)
            {
                $("div.shariff ul > li:nth-child(2)").after( googleplus_code );
            }
            else if($('li.shariff-button.facebook').length == 1 || $('li.shariff-button.twitter').length == 1)
            {
                $("div.shariff ul > li:nth-child(1)").after( googleplus_code );
            }
		}
	});

    $('#shariff_social_share_plattforms_mail').change(function(e) {
        if (!$('#shariff_social_share_plattforms_mail').prop('checked')) 
        {
            $( "li" ).remove( ".shariff-button.mail" );
        } else {
            switch($("div.shariff ul li").length) {
                case 1:
                    $( "div.shariff ul" ).prepend( $( mail_code ) );
                    break;
                case 2:
                    $("div.shariff ul li").eq(0).after( mail_code );
                    break;
                case 3:
                    $("div.shariff ul > li:nth-child(2)").after( mail_code );
                    break;
                case 4:
                    $("div.shariff ul > li:nth-child(3)").after( mail_code );
                    break;
            }
        }
    });

    

	/**
	 * design live view
	 */
	$('#shariff_social_share_design_orientation').change(function(e) {
        e.preventDefault();
        var selectedValue = jQuery(this).val();
       	//alert(selectedValue);
        if (selectedValue == 'horizontal') 
        {
        	$("div.shariff ul").removeClass( "orientation-vertical" );
            $("div.shariff ul").addClass( "orientation-horizontal" );
        }
        else if (selectedValue == 'vertical') 
        {
        	$("div.shariff ul").removeClass( "orientation-horizontal" );
            $("div.shariff ul").addClass( "orientation-vertical" );
        }

    });

    $('#shariff_social_share_design_color').change(function(e) {
        e.preventDefault();
        var selectedValue = jQuery(this).val();
       	//alert(selectedValue);
        if (selectedValue == 'colored') 
        {
        	$("div.shariff ul").removeClass( "theme-white" );
        	$("div.shariff ul").removeClass( "theme-grey" );
            $("div.shariff ul").addClass( "theme-colored" );
        }
        else if (selectedValue == 'grey') 
        {
        	$("div.shariff ul").removeClass( "theme-white" );
        	$("div.shariff ul").removeClass( "theme-colored" );
            $("div.shariff ul").addClass( "theme-grey" );
        }
        else if (selectedValue == 'white') 
        {
        	$("div.shariff ul").removeClass( "theme-grey" );
        	$("div.shariff ul").removeClass( "theme-colored" );
            $("div.shariff ul").addClass( "theme-white" );
        }

    });
});