<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <hgroup>
            <h1 class="entry-title section-title text-right"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'vestride'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            <h3 class="entry-format"><?php _e('Quote', 'vestride'); ?></h3>
        </hgroup>

        <div class="entry-meta">
            <?php vestride_posted_on(); ?>
        </div><!-- .entry-meta -->

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
            <?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'vestride')); ?>
            <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'vestride') . '</span>', 'after' => '</div>')); ?>
        </div><!-- .entry-content -->
    <?php endif; ?>

    <footer class="entry-meta">
        <?php $show_sep = false; ?>
        <?php
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list(__(', ', 'vestride'));
        if ($categories_list):
            ?>
            <span class="cat-links">
                <?php
                printf(__('<span class="%1$s">Posted in</span> %2$s', 'vestride'), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list);
                $show_sep = true;
                ?>
            </span>
        <?php endif; // End if categories ?>
        <?php
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list('', __(', ', 'vestride'));
        if ($tags_list):
            if ($show_sep) :
                ?>
                <span class="sep"> | </span>
                <?php endif; // End if $show_sep  ?>
            <span class="tag-links">
                <?php
                printf(__('<span class="%1$s">Tagged</span> %2$s', 'vestride'), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list);
                $show_sep = true;
                ?>
            </span>
        <?php endif; // End if $tags_list ?>

        <?php if (comments_open()) : ?>
            <?php if ($show_sep) : ?>
                <span class="sep"> | </span>
            <?php endif; // End if $show_sep  ?>
            <span class="comments-link"><?php comments_popup_link('<span class="leave-reply">' . __('Leave a reply', 'vestride') . '</span>', __('<b>1</b> Reply', 'vestride'), __('<b>%</b> Replies', 'vestride')); ?></span>
        <?php endif; // End if comments_open()  ?>

        <?php edit_post_link(__('Edit', 'vestride'), '<span class="edit-link">', '</span>'); ?>
        <?php vestride_nav_single(); ?>
    </footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
