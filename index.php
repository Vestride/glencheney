<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Vestride
 */
get_header();

vestride_header('home');

get_template_part('backdrop');
?>

<div id="main" class="homepage" role="main">
    <div id="sections">
        <?
            get_template_part('section', 'home');
            get_template_part('section', 'about');
            get_template_part('section', 'work');
            get_template_part('section', 'contact');
            //get_template_part('section', 'blog');
        ?>
    </div>
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
<script defer src="<? echo get_template_directory_uri(); ?>/js/index.js"></script>
<?php vestride_end(); ?>