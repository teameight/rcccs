<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
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
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php wp_title( '|', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Begin .header -->
<header class="header cf" role="banner">
    <div class="wrap">
        <a href="<?php bloginfo('url'); ?>" class="logo"><img src="<?php echo(THEME_DIR); ?>/images/logo.png" alt="Logo Alt Text" /></a>
        <div id="nav-wrap">
            <a href="<?php bloginfo('url'); ?>" class="logo-mini"><img src="<?php echo(THEME_DIR); ?>/images/logo-mini.png" alt="Logo Alt Text" /></a>
            <nav id="nav" class="nav">
                <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false)); ?>
            </nav><!--end .nav-->
        </div>
    </div>
    <div class="subnav">
        <div class="wrap">
            <?php get_template_part( 'partials/section', 'services' ); ?>
        </div>
    </div>



<style type="text/css">
 .logo {  }
</style>


</header>
<div id="content">
<!-- End .header -->