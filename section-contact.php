<?php
    $theme_options = vestride_get_theme_options();
    $twitter_username = $theme_options['twitter'];
    $facebook_username = $theme_options['facebook'];
    $vimeo_username = $theme_options['vimeo'];
    $dribbble_username = $theme_options['dribbble'];
    $flickr_username = $theme_options['flickr'];
    $googleplus_username = $theme_options['googleplus'];
    $youtube_username = $theme_options['youtube'];
    $github_username = $theme_options['github'];
    $linkedin_username = $theme_options['linkedin'];
    $gamertag = $theme_options['gamertag'];
?>
    <section id="contact">
        <h3 class="section-title text-right"><span>Contact<span class="title-icon icon-message"></span></span></h3>
        <div class="contact">
            <div class="contact-form">
                <h2>Message Us</h2>
                <p class="greeting">Have a <strong>comment</strong> or <strong>question</strong>? Just want to <strong>say hello</strong>? We&rsquo;d love to hear from you!</p>
                <form>
                    <div class="notification error-notification" style="display: none;"></div>
                    <input type="hidden" name="name" value="" />
                    <div class="inputs">
                        <div class="rfloat">
                            <div class="input-wrapper">
                                <div class="arrow-container"><span class="arrow-down"></span></div>
                                <input type="text" data-placeholder="Subject" name="subject" tabindex="2" class="input-dark" id="f-subject" />
                            </div>
                            <div class="input-wrapper">
                                <div class="arrow-container"><span class="arrow-down"></span></div>
                                <input type="tel" data-placeholder="Phone" name="phone" tabindex="4" class="input-dark" id="f-phone" />
                            </div>
                        </div>
                        <div class="input-wrapper">
                            <div class="arrow-container"><span class="arrow-down"></span></div>
                            <input type="text" data-placeholder="Name*" name="actual_name" tabindex="1" required class="input-dark" id="f-name" />
                        </div>
                        <div class="input-wrapper">
                            <div class="arrow-container"><span class="arrow-down"></span></div>
                            <input type="email" data-placeholder="Email*" name="email" tabindex="3" required class="input-dark" id="f-email" />
                        </div>
                        <div class="textarea-container">
                            <div class="arrow-container"><span class="arrow-down"></span></div>
                            <textarea data-placeholder="Message*" name="message" tabindex="5" required class="input-dark" id="f-textarea"></textarea>
                        </div>
                    </div>
                    <p class="main-color">
                        <em>* Required fields</em>
                    </p>
                    <div class="send-wrapper">
                        <div class="send ir" id="contact-submit" tabindex="6">Send!</div>
                    </div>
                </form>
            </div>
            <div class="follow-us">
                <h2 class="short">Follow Us</h2>
                <div class="clearfix">
                    <a href="http://facebook.com/<?php echo $facebook_username; ?>" class="facebook" target="_blank">Visit our Facebook page!<span></span></a>
                    <a href="http://twitter.com/<?php echo $twitter_username; ?>" class="twitter" target="_blank">Follow us on Twitter<span></span></a>
                    <a href="http://vimeo.com/<?php echo $vimeo_username; ?>" class="vimeo" target="_blank">Watch our videos on Vimeo<span></span></a>
                    <a href="http://youtube.com/user/<?php echo $youtube_username; ?>" class="youtube" target="_blank">Watch our videos on YouTube<span></span></a>
                    <a href="http://dribbble.com/<?php echo $dribbble_username; ?>" class="dribbble" target="_blank">View our works in progress<span></span></a>
                    <a href="http://flickr.com/people/<?php echo $flickr_username; ?>" class="flickr" target="_blank">Look at our pretty photos<span></span></a>
                    <!--
                    <a href="http://www.linkedin.com/in/<?php echo $linkedin_username; ?>" class="linkedin" target="_blank">Check us out on Linkedin<span></span></a>
                    <a href="http://live.xbox.com/en-US/profile/profile.aspx?GamerTag=<?php echo $gamertag; ?>" class="xbox" target="_blank">Game with us on Xbox LIVE<span></span></a>
                    -->
                </div>
            </div>
        </div>
    </section>