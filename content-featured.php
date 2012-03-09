<?php
/**
 * The template for displaying content featured in the showcase.php page template
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
global $feature_class;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($feature_class); ?>>
    <header class="entry-header">
       <h1 class="entry-title section-title text-right"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'vestride'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

        <div class="entry-meta">
            <?php vestride_posted_on(); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-summary">
        <?php the_excerpt(); ?>
        <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'vestride') . '</span>', 'after' => '</div>')); ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <?php
        /* translators: used between list items, there is a space after the comma */
        $tag_list = get_the_tag_list('', __(', ', 'vestride'));
        if ('' != $tag_list) {
            $utility_text = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'vestride');
        } else {
            $utility_text = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'vestride');
        }
        printf(
                $utility_text,
                /* translators: used between list items, there is a space after the comma */ get_the_category_list(__(', ', 'vestride')), $tag_list, esc_url(get_permalink()), the_title_attribute('echo=0')
        );
        ?>

        <?php edit_post_link(__('Edit', 'vestride'), '<span class="edit-link">', '</span>'); ?>
        <?php vestride_nav_single(); ?>
    </footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
