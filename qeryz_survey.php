<?php
   /*
   Plugin Name: Qeryz Microsurvey Tool
   Plugin URI: https://qeryz.com
   Description: A plugin for Qeryz, a pop-up, as-you-go microsurvey that you can put in any and every webpage you have in your website.
   Version: 1.1.3
   Author: Qeryz
   Author URI: https://qeryz.com
   License: GPL2
   */


define('QERYZ_SCRIPT_DOMAIN',         "qeryz.com");
define('QERYZ_BASE_URL',              "https://qeryz.com/");
define('QERYZ_SIGNUP_REDIRECT_URL',   QERYZ_BASE_URL."subscribe.php");
define('QERYZ_LOGIN_URL',             QERYZ_BASE_URL."wplogin1.php");
define('QERYZ_SIGNUP_URL',            QERYZ_BASE_URL."subscribe.php");
define('QERYZ_DASHBOARD_LINK',        "https://qeryz.com/login/dashboard.php");
 
require_once dirname( __FILE__ ) . '/qeryz_survey_admin.php';
   
 // Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
  echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
  exit;
}

function load_qeryz_style() {    
    wp_register_style('qeryz_style', plugins_url('qeryz_css.css', __FILE__));
    wp_enqueue_style('qeryz_style');
}
add_action('admin_enqueue_scripts', 'load_qeryz_style');

function load_qeryz_js() { 
    wp_register_script('qeryz_wordpress_js', 'https://qeryz.com/survey/js/qryz_wordpress_v3.js');
    wp_enqueue_script('qeryz_wordpress_js');
}
add_action('wp_enqueue_scripts', 'load_qeryz_js');

function add_qeryz_caps() {
    $role = get_role( 'administrator' );
    $role->add_cap( 'qeryz_survey_admin' );    
}  
add_action( 'admin_init', 'add_qeryz_caps');

function qeryz_survey() {
    
    $code = get_option('qeryz_code');
    if ($code > 0){
//<!--Start of Qeryz Survey Script-->
    echo ' 
<!-- Start of code for Qeryz Survey  -->
    <script type="text/javascript">
    (function() {
        setTimeout(function(){
            var qryz_s = document.getElementsByTagName("script")[0];
            var qryz_plks = document.createElement("div"); 
            qryz_plks.id = "qryz_plks";
            qryz_plks.className = "qryz_plks";
            document.body.appendChild(qryz_plks);  
            qryzInit("https://qeryz.com/survey/qeryz_wordpress_v3.php?qryz_uid='.$code.'&qryz_url="+document.URL);  
        },0);
    })();
    </script>
';
    }

}
add_action('wp_footer', 'qeryz_survey',100);

function qeryz_survey_menu() {
//    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position ); 
    add_menu_page("Qeryz Admin", "Qeryz Survey", "qeryz_survey_admin", "qeryz_survey_admin_page", "qeryz_survey_admin_page", plugin_dir_url( __FILE__ ).'/images/qeryz_menu_icon.png');
//    add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
    add_action( 'admin_init', 'register_qeryz_plugin_settings' );
} 
add_action('admin_menu', 'qeryz_survey_menu');

function register_qeryz_plugin_settings() {

    // Authentication and codes
    register_setting( 'qeryz-settings-group', 'qeryz_id' );
    register_setting( 'qeryz-settings-group', 'qeryz_username' );
    register_setting( 'qeryz-settings-group', 'qeryz_password' );

}
function qeryz_post_request($url, $_data, $optional_headers = null)
{
//        $url = str_replace("https", "http", $url);
    
    $args = array('body' => $_data);
    $response = wp_remote_post( $url, $args );    
    return $response['body'];
}


function qeryz_url_get($filename) {
    $response = wp_remote_get($filename);
    return $response['body'];
}
?>