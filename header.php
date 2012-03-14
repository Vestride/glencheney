<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Vestride
 * @since Vestride 1.0
 */


$title = '';
/*
 * Print the <title> tag based on what is being viewed.
 */
global $page, $paged;

$title = wp_title('|', false, 'right');

// Add the blog name.
$title .= get_bloginfo('name');

// Add a page number if necessary:
if ($paged >= 2 || $page >= 2)
    $title .= ' | ' . sprintf(__('Page %s', 'vestride'), max($paged, $page));

?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title><?php echo $title; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <base href="<?php bloginfo('url'); ?>/" />
        
        <meta name="description" content="<?php bloginfo('description'); ?>" />
        <meta name="author" content="<?php echo get_template_directory_uri(); ?>/humans.txt" />
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:description" content="<?php bloginfo('description'); ?>" />
        <meta property="og:image" content="<?php bloginfo('url'); ?>/apple-touch-icon-114x114-precomposed.png" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php bloginfo('url'); ?>" />
        <meta property="og:site_name" content="Glen Cheney Portfolio" />
        <meta property="fb:admins" content="771347349" />
        <!--<link href="https://plus.google.com/107693036436931694456" rel="publisher" />-->

        <link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico" type="image/x-icon" />
        <link rel="icon" href="<?php bloginfo('url'); ?>/favicon.ico" type="image/ico" />
        <link rel="icon" href="<?php bloginfo('url'); ?>/favicon.png" type="image/png" />

        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link rel="apple-touch-icon-precomposed" href="<?php bloginfo('url'); ?>/apple-touch-icon-precomposed.png" />
        
        <link rel="stylesheet" href="<? bloginfo('stylesheet_url'); ?>" />
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,300,400,700,800' />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        
        <script src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-2.5.3.js"></script>
        <?php
        /* We add some JavaScript to pages with the comment form
         * to support sites with threaded comments (when in use).
         */
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');

        /* Always have wp_head() just before the closing </head>
         * tag of your theme, or you will break many plugins, which
         * generally use this hook to add elements to <head> such
         * as styles, scripts, and meta tags.
         */
        wp_head();
        ?>
    </head>
    <body>
        <div id="container">