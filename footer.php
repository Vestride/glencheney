<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Vestride
 * @since Vestride 1.0
 */


$theme_options = vestride_get_theme_options();
$google_analytics = $theme_options['ga'];
?>
        <footer>
            <!-- <?php bloginfo('url'); ?> -->
            <section class="footer-header">
                <div class="footer-inside">
                    
                </div>
            </section>
            <section class="footer-inside text-center">
                <p>Designed by <a href="http://glencheney.com">Glen Cheney</a>, <a href="http://eightfoldstudios.com" title="Eightfold Studios" target="_blank">Jake Likewise</a>, and <a href="http://jessethoman.com" title="Jesse Thoman's portfolio" target="_blank">Jesse Thoman</a>| Coded by <a href="http://glencheney.com">Glen Cheney</a></p>
                <p><small>&copy; <?= date('Y'); ?> Glen Cheney. All rights reserved.</small></p>
            </section>
        </footer>
    </div> <!-- end of #container -->


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
    <script>window.jQuery || document.write('<script src="<? echo get_template_directory_uri(); ?>/js/libs/jquery-1.7.1.min.js"><\/script>')</script>


    <script defer src="<? echo get_template_directory_uri(); ?>/js/plugins.js"></script>
    <script defer src="<? echo get_template_directory_uri(); ?>/js/script.js"></script>

    <div id="fb-root"></div>
    <script>    
    $(document).ready(function(){
        Vestride.themeUrl = '<? echo get_template_directory_uri(); ?>';
    });
    
    <?php if ($google_analytics != '') : ?>
    var _gaq=[['_setAccount','<?php echo $google_analytics; ?>'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
    <? endif; ?>
    </script>
<?php wp_footer(); ?>