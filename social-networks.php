<?php

$theme_options = vestride_get_theme_options();
$twitter_username = $theme_options['twitter'];
$use_twitter = $theme_options['use_twitter'];
$facebook_username = $theme_options['facebook'];
$use_facebook = $theme_options['use_facebook'];
$vimeo_username = $theme_options['vimeo'];
$use_vimeo = $theme_options['use_vimeo'];
$dribbble_username = $theme_options['dribbble'];
$use_dribbble = $theme_options['use_dribbble'];
$flickr_username = $theme_options['flickr'];
$use_flickr = $theme_options['use_flickr'];
$googleplus_username = $theme_options['googleplus'];
$use_googleplus = $theme_options['use_googleplus'];
$youtube_username = $theme_options['youtube'];
$use_youtube = $theme_options['use_youtube'];
$github_username = $theme_options['github'];
$use_github = $theme_options['use_github'];
$linkedin_username = $theme_options['linkedin'];
$use_linkedin = $theme_options['use_linkedin'];
$gamertag = $theme_options['gamertag'];
$use_gamertag = $theme_options['use_gamertag'];

$used = 0;
$username_limit = 6;
?>

<?php if ($use_facebook == 'yes' && $used < $username_limit) : ?>
<a href="http://facebook.com/<?php echo $facebook_username; ?>" class="facebook" target="_blank">Visit my Facebook profile!<span></span></a>
<?php $used++; endif; ?>
<?php if ($use_twitter == 'yes' && $used < $username_limit) : ?>
<a href="http://twitter.com/<?php echo $twitter_username; ?>" class="twitter" target="_blank">Follow me on Twitter<span></span></a>
<?php $used++; endif; ?>
<?php if ($use_github == 'yes' && $used < $username_limit) : ?>
<a href="http://github.com/<?php echo $github_username; ?>" class="github" target="_blank">Check out some repos<span></span></a>
<?php $used++; endif; ?>
<?php if ($use_vimeo == 'yes' && $used < $username_limit) : ?>
<a href="http://vimeo.com/<?php echo $vimeo_username; ?>" class="vimeo" target="_blank">Watch my videos on Vimeo<span></span></a>
<?php $used++; endif; ?>
<?php if ($use_youtube == 'yes' && $used < $username_limit) : ?>
<a href="http://youtube.com/user/<?php echo $youtube_username; ?>" class="youtube" target="_blank">Watch my videos on YouTube<span></span></a>
<?php $used++; endif; ?>
<?php if ($use_dribbble == 'yes' && $used < $username_limit) : ?>
<a href="http://dribbble.com/<?php echo $dribbble_username; ?>" class="dribbble" target="_blank">View my works in progress<span></span></a>
<?php $used++; endif; ?>
<?php if ($use_flickr == 'yes' && $used < $username_limit) : ?>
<a href="http://flickr.com/people/<?php echo $flickr_username; ?>" class="flickr" target="_blank">Look at my pretty photos<span></span></a>
<?php $used++; endif; ?>
<?php if ($use_linkedin == 'yes' && $used < $username_limit) : ?>
<a href="http://www.linkedin.com/in/<?php echo $linkedin_username; ?>" class="linkedin" target="_blank">Check me out on Linkedin<span></span></a>
<?php $used++; endif; ?>
<?php if ($use_googleplus == 'yes' && $used < $username_limit) : ?>
<a href="http://plus.google.com/<?php echo $googleplus_username; ?>" class="googleplus">Read my thoughts on Google+<span></span></a>
<?php $used++; endif; ?>
<?php if ($use_gamertag == 'yes' && $used < $username_limit) : ?>
<a href="http://live.xbox.com/en-US/profile/profile.aspx?GamerTag=<?php echo $gamertag; ?>" class="xbox" target="_blank">Game with me on Xbox LIVE<span></span></a>
<?php $used++; endif; ?>
