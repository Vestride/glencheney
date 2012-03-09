<?php
/**
 * The template for displaying page content in the showcase.php page template
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('intro'); ?>>
    <header class="entry-header">
        <h1 class="entry-title section-title text-right"><span><?php the_title(); ?></span></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'vestride') . '</span>', 'after' => '</div>')); ?>
        <?php edit_post_link(__('Edit', 'vestride'), '<span class="edit-link">', '</span>'); ?>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
