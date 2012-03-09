<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
get_header();
vestride_header('');
get_template_part('backdrop', 'small');
?>
<div id="main" role="main">

    <?php the_post(); ?>

    <?php get_template_part('content', 'page'); ?>

    <?php comments_template('', true); ?>

</div><!-- #main -->

<?php get_footer(); ?>
<script>
    $(document).ready(function() {
        Vestride.onHomePage = false;
    });
</script>
<?php vestride_end(); ?>