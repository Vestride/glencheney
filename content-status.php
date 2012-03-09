<?php
/**
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <hgroup>
            <h1 class="entry-title section-title text-right"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'vestride'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            <h3 class="entry-format"><?php _e('Status', 'vestride'); ?></h3>
        </hgroup>

        <?php if (comments_open() && !post_password_required()) : ?>
            <div class="comments-link">
                <?php comments_popup_link('<span class="leave-reply">' . __('Reply', 'vestride') . '</span>', _x('1', 'comments number', 'vestride'), _x('%', 'comments number', 'vestride')); ?>
            </div>
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php if (is_search()) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
    <?php else : ?>
        <div class="entry-content">
            <div class="avatar"><?php echo get_avatar(get_the_author_meta('ID'), apply_filters('vestride_status_avatar', '65')); ?></div>

            <?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'vestride')); ?>
            <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'vestride') . '</span>', 'after' => '</div>')); ?>
        </div><!-- .entry-content -->
    <?php endif; ?>

    <footer class="entry-meta">
        <?php vestride_posted_on(); ?>
        <?php if (comments_open()) : ?>
            <span class="sep"> | </span>
            <span class="comments-link"><?php comments_popup_link('<span class="leave-reply">' . __('Leave a reply', 'vestride') . '</span>', __('<b>1</b> Reply', 'vestride'), __('<b>%</b> Replies', 'vestride')); ?></span>
        <?php endif; ?>
        <?php edit_post_link(__('Edit', 'vestride'), '<span class="edit-link">', '</span>'); ?>
        <?php vestride_nav_single(); ?>
    </footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
