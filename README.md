shariff-social-share
====================
The Shariff-Social-Share Wordpress-Plugin is based on the open-source-project [ct shariff](https://github.com/heiseonline/shariff) from [ct und heise online](http://www.heise.de/ct/artikel/Shariff-Social-Media-Buttons-mit-Datenschutz-2467514.html).

## Installation
1. Download this repo [https://github.com/JG-Bits/shariff-social-share/archive/master.zip](https://github.com/JG-Bits/shariff-social-share/archive/master.zip)
2. Unzip the downloaded archive, if directoryname contains "-master" remove/rename it.
3. enter your domain in backend/index.php in line 22 and your facebook app-id and secret in line 36-37. If you dont know how to create a facebook-app-id, you get more information here: [https://developers.facebook.com/docs/apps/register](https://developers.facebook.com/docs/apps/register)
4. Upload the directory containing this modified plugin to your Website using FTP or upload it at the WordPress-Backend --> Plugins
5. activate the plugin
6. Configure it in Settings --> Shariff-Social-Share
7. Have fun :-)

## Use of Shortcodes
With help of Shortcodes you can place the Social-Share-Buttons on any place in your editor. A direct integration in a template file is mostly possible. 

Simple:

    [shariff-social-share]
    
With attributes for Shortcode related settings:

    [shariff-social-share atts="Wert"]
    

| atts (Attribut) | 		  Wert		 |
| :-------------- | :------------------: |
| color           | colored, white, grey |
| orientation     | horizontal, vertical |
| class           | html class attribute |
| styles          | CSS-Styles			 |


## CSS & JS Import-modes
For embedding CSS and Javascript there are following modes available:

* automatically
* manually

### automatically
Automatically the CSS and JS file loads in relation to:

* Settings for embedding on page and posts
* websites-/postbased deactivation

#### manually
The CSS and JS file are only loaded manually when Shortcode is embedded into the page or post.

## Screenshot
![Shariff-Social-Share Screenshot](https://www.jg-bits.de/wp-content/uploads/2015/07/shariff-social-share-wp-plugin-v1.1.0-e1436651371658.png)

## Database-Prefix

All settings of the plugin are saved via the WordPress-Settings-API into the database with the following prefix:

    shariff_social_share_
