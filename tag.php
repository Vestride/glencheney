<?php
/**
 * The template used to display Tag Archive pages
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

    <?php if (have_posts()) : ?>

        <header class="page-header">
            <h1 class="page-title section-title text-right"><span><?php printf(__('Tag Archives: %s', 'vestride'), '<span>' . single_tag_title('', false) . '</span>'); ?></span></h1>

            <?php
            $tag_description = tag_description();
            if (!empty($tag_description))
                echo apply_filters('tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>');
            ?>
        </header>

        <?php vestride_content_nav('nav-above'); ?>

        <?php /* Start the Loop */ ?>
        <?php while (have_posts()) : the_post(); ?>

            <?php
            /* Include the Post-Format-specific template for the content.
             * If you want to overload this in a child theme then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part('content', get_post_format());
            ?>

        <?php endwhile; ?>

        <?php vestride_content_nav('nav-below'); ?>

    <?php else : ?>

        <article id="post-0" class="post no-results not-found">
            <header class="entry-header">
                <h1 class="entry-title section-title text-right"><span><?php _e('Nothing Found', 'vestride'); ?></span></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'vestride'); ?></p>
                <?php get_search_form(); ?>
            </div><!-- .entry-content -->
        </article><!-- #post-0 -->

    <?php endif; ?>

</div><!-- #main -->
<?php get_footer(); ?>
<script>
    $(document).ready(function() {
        Vestride.onHomePage = false;
    });
</script>
<?php vestride_end(); ?>
