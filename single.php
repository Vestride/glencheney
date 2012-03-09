<?php
/**
 * The Template for displaying all single posts.
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
    <?php while (have_posts()) : the_post(); ?>

        <?php get_template_part('content', 'single'); ?>

        <?php comments_template('', true); ?>

    <?php endwhile; // end of the loop. ?>
</div><!-- #main -->
<?php get_footer(); ?>
<script>
$(document).ready(function() {
    Vestride.onHomePage = false;
});
</script>
<?php vestride_end(); ?>