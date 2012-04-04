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
    'post_parent' => $post->ID,
    'post_mime_type' => 'image',
    'orderby' => 'menu_order'
);
$attachments = get_posts($args);
$screenshots = array();
foreach ($attachments as $attachment) {
    $screenshot = wp_get_attachment_image_src($attachment->ID, 'featured');
    $screenshot['full'] = $attachment->guid;
    $screenshot['title'] = $attachment->post_title;
    $screenshot['caption'] = $attachment->post_excerpt;
    $screenshot['description'] = $attachment->post_content;
    $screenshot['alt'] = $screenshot['caption'] != '' ? $screenshot['caption'] : $screenshot['title'];
    $screenshots[] = $screenshot;
}
$screenshots = array_reverse($screenshots);
$videoEmbed = wp_specialchars_decode(get_metadata('post', $post->ID, 'video', true), ENT_QUOTES);
$hasVideo = $videoEmbed != '' ? true : false;
$hero = get_the_post_thumbnail(get_the_ID(), 'featured');
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
        
        <section class="project-images">
            <div class="project-carousel-container js-project-carousel-container">
                
                <div class="project-hero js-project-hero <?php echo $hasVideo ? 'is-video' : ''; ?>">
                    <?php
                        if ($hasVideo) echo $videoEmbed;
                        else echo $hero;
                    ?>
                </div>
                
                <ul class="js-project-carousel project-carousel">
                    <?php foreach ($screenshots as $screenshot) : ?>
                    <li>
                        <img src="<?php echo $screenshot[0]; ?>" alt="<?php echo $screenshot['alt']; ?>" 
                             title="<?php echo $screenshot['title']; ?>" width="<?php echo $screenshot[1]; ?>"
                             height="<?php echo $screenshot[2]; ?>" />
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="js-slideshow-nav carousel-nav">
                <div class="carousel-control"></div>
                <div class="text-center">
                    <span class="js-carousel-prev arrow arrow-left lfloat">Prev Image</span>
                    <button class="js-close-slideshow">Close</button>
                    <span class="js-carousel-next arrow rfloat">Next Image</span>
                </div>
            </div>
            
            <div class="js-view-images-container text-center">
                <button class="js-view-images view-images text-center">View Project Images</button>
            </div>
        </section>
        
        <?php if ($externalLink != '') : ?>
        <section class="clearfix">
            <a href="<?php echo $externalLink; ?>" class="arrow launch-site rfloat" target="_blank">Launch Site</a>
        </section>
        <?php endif; ?>
        
        <div class="clearfix">
            <section class="project-content lfloat">
                <h2>Details</h2>
                <div class="post-content"><?php the_content(); ?></div>
            </section>

            <section class="grid-2 rfloat">
                <h2 class="short">Tags</h2>
                <p><?php echo $tag_list; ?></p>
            </section>
        </div>

        
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
