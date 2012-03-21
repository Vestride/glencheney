<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Vestride
 * @since Vestride 1.0
 */

$args = array(
    'post_type' => 'attachment',
    'numberposts' => -1,
    'post_status' => null,
    'post_parent' => $post->ID
);
$attachments = get_posts($args);
$thumbnails = array();
$promos = array();
foreach ($attachments as $attachment) {
    $thumbnail = wp_get_attachment_image_src($attachment->ID, 'work-thumb');
    $thumbnail['title'] = $attachment->post_title;
    $thumbnail['caption'] = $attachment->post_excerpt;
    $thumbnail['description'] = $attachment->post_content;
    $thumbnails[] = $thumbnail;
    $promos[] = wp_get_attachment_image_src($attachment->ID, 'work-promo');
}
$videoEmbed = wp_specialchars_decode(get_metadata('post', $post->ID, 'video', true), ENT_QUOTES);
$hasVideo = $videoEmbed != '' ? true : false;
$hero = $hasVideo ? $videoEmbed : get_the_post_thumbnail(get_the_ID(), 'work-promo');
$externalLink = get_metadata('post', $post->ID, 'external', true);
$tag_list = get_the_tag_list('', ', ', '');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title section-title text-right"><span><?php the_title(); ?></span></h1>
        
        <!--
        <div class="entry-meta">
            <?php vestride_posted_on(); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        
        <section class="clearfix">
            <div class="project-hero rfloat"><? echo $hero; ?></div>
            <div class="project-sidebar project-specs lfloat">
                <section class="clearfix">
                    <h2 class="short">Screenshots</h2>
                    <ul class="tiles">
                        <? if ($hasVideo) : ?>
                        <li class="tile is-video active"><div class="sprite sprite-play"></div><span>Play Video</span><div class="embed hidden"><?php echo $videoEmbed; ?></div></li>
                        <? endif; ?>
                        <? for ($i = 0; $i < count($thumbnails); $i++) : ?>
                        <li class="tile" title="<?php echo $thumbnails[$i]['title']; ?>">
                            <img src="<?php echo $thumbnails[$i][0]; ?>"
                                alt="<?php echo $thumbnails[$i]['caption'] != '' ? $thumbnails[$i]['caption'] : $thumbnails[$i]['title'] ; ?>"
                                data-promo="<?php echo $promos[$i][0]; ?>"
                                data-thumb="<?php echo $thumbnails[$i][0]; ?>"
                                height="114"
                                data-caption="<?php echo $thumbnails[$i]['catption']; ?>"
                                data-description="<?php echo $thumbnails[$i]['description']; ?>" />
                        </li>
                        <? endfor; ?>
                    </ul>
                </section>
                
                <section>
                    <h2 class="short">Tags</h2>
                    <p class="tiles"><?php echo $tag_list; ?></p>
                </section>
            </div>
        </section>
        
        
        
        <section>
            <h2 class="short">Details</h2>
            <?php if ($externalLink != '') : ?>
            <a href="<?php echo $externalLink; ?>" class="arrow rfloat" target="_blank">Launch Site</a>
            <?php endif; ?>
            <div class="post-content"><?php the_content(); ?></div>
        </section>

        
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <?php
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_term_list('', 'type', '', ', ', '');

        /* translators: used between list items, there is a space after the comma */
        if ('' != $tag_list) {
            $utility_text = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'vestride');
        } elseif ('' != $categories_list) {
            $utility_text = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'vestride');
        } else {
            $utility_text = __('This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'vestride');
        }

        printf($utility_text, $categories_list, $tag_list, esc_url(get_permalink()), the_title_attribute('echo=0'), get_the_author(), esc_url(get_author_posts_url(get_the_author_meta('ID'))));
        ?>
        <?php edit_post_link(__('Edit', 'vestride'), '<span class="edit-link">', '</span>'); ?>
        
        <?php vestride_nav_single(); ?>
    </footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
