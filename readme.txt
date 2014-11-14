=== Qeryz Microsurvey Tool ===
Contributors: h3sean
Donate link: https://qeryz.com/
Tags: survey tool, qeryz, microsurvey
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Qeryz is a pop-up, as-you-go microsurvey that you can put in any and every webpage you have in your website.

== Description ==

Get 700% more responses than a normal survey.
Qeryz is a pop-up, as-you-go microsurvey tool that you can put in any and every webpage you have in your website. 
Never ask your customers to click on a link to go to your survey. Gather customer insights without the hassle. 
Create surveys in multiple choice, checkbox, scale or a simple text area. 


== Installation ==

This section describes how to install the plugin and get it working.


1. Upload the plugin folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Sign in to the survey using your Qeryz username and password.
4. Activate your survey in your Qeryz dashboard

== Frequently Asked Questions ==

= What is this plugin for? =

This plugin is developed so that you don't have to copy-paste the Qeryz code to each of your pages in Wordpress. Simply enter your username and password and activate your Qeryz survey for you to get started with Qeryz.

== Screenshots ==

1. screenshot1.png 
2. screenshot2.jpg
3. screenshot3.png

== Upgrade Notice ==

= 1.1.3 =
* If survey is not showing after updating the plugin, please click on the plugin dashboard and deactivate your account. Then try to login in or try to deactivate the plugin and then activate.

== Changelog ==

= 1.1.3 =
* Rename user_details.txt file to qeryz_user_details.txt
* Change the location of qeryz_user_details.txt file from wp-admin folder to plugin directory
* Added $qeryz_user_details variable for qeryz_user_details.txt location 
* Remove unnecessary div tags
* Added icon-128x128.png and icon-256x256.png on assets folder

= 1.1.2 =
* Fix error for logging
* Commented url replace on wp_remote_post

= 1.1.1 =
* Change wp_register_script qeryz_cookie to qeryz_js
* Change qryz_v3.js to qryz_wordpress_v3.js
* Change button's label to Launch Qeryz in admin panel
* Change php Constant http to https
* Change the password value to "" if password is not blank

= 1.1.0 =
* Change jquery to javascript qeryz code to avoid conflict in other plugins and themes
* Remove cookie.js file in plugin
* Added new javascript file
* Remove image in survey button
* Fix survey button
* Bugfix on survey not showing on some sites
* Change QERYZ_SIGN_UP URL
* Added user_details.txt on wp_admin to access qeryz account in dashboard
* Remove qeryz_cookie

= 1.0 =
* First version. No changes yet.
