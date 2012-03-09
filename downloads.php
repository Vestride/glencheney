<?php
/**
 * Template Name: Downloads Template
 * 
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header();
vestride_header('downloads');
get_template_part('backdrop', 'small');
?>
<div id="main" role="main">    
    <section id="blog">
        <h3 class="section-title text-right"><span>Downloads<span class="title-icon icon-download"></span></span></h3>
        
        <?php $posts = new WP_Query(array('post_type' => 'post', 'posts_per_page' => -1, 'category_name' => 'downloads')); ?>
        <?php if ($posts->have_posts()) : ?>
        <div class="has-posts">
            <?php vestride_content_nav('nav-above'); ?>

            <?php /* Start the Loop */ ?>
            <?php while ($posts->have_posts()) : $posts->the_post(); ?>

                <?php get_template_part('content'); ?>

            <?php endwhile; ?>

            <?php vestride_content_nav('nav-below'); ?>
        </div>
        <?php else : ?>

            <article id="post-0" class="post no-results not-found">
                <header class="entry-header">
                    <h1 class="entry-title"><?php _e('Nothing Found', 'vestride'); ?></h1>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'vestride'); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .entry-content -->
            </article><!-- #post-0 -->

        <?php endif; ?>
    </section>
</div>
<?php get_footer(); ?>
<script>
$(document).ready(function() {
    Vestride.onHomePage = false;
});
</script>
<?php vestride_end(); ?>