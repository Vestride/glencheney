
    <section id="blog">
        <h3 class="section-title text-right"><span>Blog<span class="title-icon icon-blog"></span></span></h3>
        
        <?php if (have_posts()) : ?>

            <?php vestride_content_nav('nav-above'); ?>

            <?php /* Start the Loop */ ?>
            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('content', get_post_format()); ?>

            <?php endwhile; ?>

            <?php vestride_content_nav('nav-below'); ?>

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