<?php
/**
 * @package WordPress
 * @subpackage Vestride
 */
get_header();
vestride_header('home');
get_template_part('backdrop');
?>

<div id="main" class="homepage" role="main">
    <div id="sections">
        <?
            get_template_part('section', 'home');
            get_template_part('section', 'about');
            get_template_part('section', 'work');
            get_template_part('section', 'contact');
        ?>
    </div>
</div>
<?php get_footer(); ?>
<script defer src="<? echo get_template_directory_uri(); ?>/js/index.js"></script>
<?php vestride_end(); ?>