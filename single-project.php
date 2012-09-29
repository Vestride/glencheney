<?php
/**
 * The Template for displaying all single projects.
 *
 * @package WordPress
 * @subpackage Vestride
 * @since Vestride 1.0
 */

get_header();
vestride_header('work');
get_template_part('backdrop', 'small');
?>
<div id="main" role="main">
    <?php while (have_posts()) : the_post(); ?>

        <?php get_template_part('content', 'project'); ?>

        <?php //comments_template('', true); ?>

    <?php endwhile; // end of the loop. ?>
</div>
<?php get_footer(); ?>
<script>
$(document).ready(function() {
    Vestride.onHomePage = false;
    Vestride.Modules.Project.init();
});
</script>
<?php vestride_end(); ?>