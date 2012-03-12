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
?>
        <footer>
            <!-- <?php bloginfo('url'); ?> -->
            <section class="footer-header">
                <div class="footer-inside">
                    
                </div>
            </section>
            <section class="footer-inside text-center">
                <p>Designed by <a href="http://eightfoldstudios.com" target="_blank">Jake Likewise</a> and <a href="http://jessethoman.com" target="_blank">Jesse Thoman</a>| Coded by <a href="http://glencheney.com">Glen Cheney</a></p>
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
    /*window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });*/
    
    $(document).ready(function(){
        Vestride.themeUrl = '<? echo get_template_directory_uri(); ?>';
    });
    
    /*
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    */
    </script>


    <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
    <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
    <![endif]-->

<?php wp_footer(); ?>