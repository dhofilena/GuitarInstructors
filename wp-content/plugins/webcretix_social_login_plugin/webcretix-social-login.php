<?php
/*
Plugin Name: Webcretix Social Login
Plugin URI: http://www.oneall.com/
Description: Allow your visitors to <strong>comment, login and register with 25+ social networks</strong> like Twitter, Facebook, LinkedIn, Instagram, Вконтакте, Google or Yahoo.
Version: 4.6
Author: OneAll
Author URI: http://www.oneall.com/
License: GPL2
 */

/**
 * Initialise
 */

require_once(dirname (__FILE__) . '/includes/communication.php');
require_once(dirname (__FILE__) . '/includes/toolbox.php');

 
 
add_action('init', 'webcretix_social_login_init', 9);
add_action('wp_enqueue_scripts', 'wpb_adding_scripts'); 
add_action('wp_logout','webcretix_social_login_logout');

function wpb_adding_scripts() {
	wp_register_script('all','https://connect.facebook.net/en_US/all.js',null,'1.1', true);
	wp_register_script('fb_app_script', plugins_url('fb_app_script.js', __FILE__), array('jquery'),'1.1', true);
	wp_enqueue_script('all');
	wp_enqueue_script('fb_app_script');	
}


 




