<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<link href="http://fonts.googleapis.com/css?family=Oswald:400,300,700|Shadows+Into+Light" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url') ?>/font/stylesheet.css" type="text/css" charset="utf-8" />

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="logo">
  <img src="<?php echo get_bloginfo('template_url') ?>/images/logo.png" />
  <div id="topRight">
  <?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
		<div id="secondary" class="searchBox" role="complementary" style="float:right;">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		</div><!-- #secondary -->
  <?php endif; ?>
  <div class="clear"></div>
  <div id="social">
  <img src="<?php echo get_bloginfo('template_url') ?>/images/facebook.png" /><img src="<?php echo get_bloginfo('template_url') ?>/images/twitter.png" /><img src="<?php echo get_bloginfo('template_url') ?>/images/gmail.png" /><img src="<?php echo get_bloginfo('template_url') ?>/images/facebook.png" /></div>
    <?php
    if (get_user_role() == 'contributor' || get_user_role() == 'administrator' ){ ?>
		<div class="welcome">Welcome <font color="#FFFF00"><?php $current_user = wp_get_current_user(); echo $current_user->display_name; ?></font> &nbsp;|&nbsp; <a href="<?php get_site_url(); ?>wp-admin/" title="View My Account">My Account</a> &nbsp;|&nbsp; <a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout" style="color: #F00;">Logout</a></div>
	<?php } ?>
  </div>
</div>
<div id="page" class="hfeed site">
	
	<div id="main" class="wrapper">