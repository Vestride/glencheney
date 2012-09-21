    <section id="contact">
        <h3 class="section-title text-right"><span>Contact<span class="circle-icon title-icon icon-envelope-alt"></span></span></h3>
        <div class="contact">
            <div class="contact-form">
                <h2>Message Me</h2>
                <p class="greeting">Have a <strong>comment</strong> or <strong>question</strong>? Just want to <strong>say hello</strong>? I&rsquo;d love to hear from you!</p>
                <form>
                    <div class="notification error-notification" style="display: none;"></div>
                    <input type="hidden" name="name" value="" />
                    <div class="inputs">
                        <div class="input-wrapper">
                            <div class="arrow-container"><span class="arrow-down icon-caret-down"></span></div>
                            <input type="text" placeholder="Name*" name="actual_name" tabindex="1" required class="input-dark" id="f-name" />
                        </div>
                        <div class="input-wrapper">
                            <div class="arrow-container"><span class="arrow-down icon-caret-down"></span></div>
                            <input type="email" placeholder="Email*" name="email" tabindex="2" required class="input-dark" id="f-email" />
                        </div>
                        <div class="input-wrapper">
                            <div class="arrow-container"><span class="arrow-down icon-caret-down"></span></div>
                            <input type="text" placeholder="Subject" name="subject" tabindex="3" class="input-dark" id="f-subject" />
                        </div>
                        <div class="input-wrapper">
                            <div class="arrow-container"><span class="arrow-down icon-caret-down"></span></div>
                            <input type="tel" placeholder="Phone" name="phone" tabindex="4" class="input-dark" id="f-phone" />
                        </div>
                        <div class="textarea-container">
                            <div class="arrow-container"><span class="arrow-down icon-caret-down"></span></div>
                            <textarea placeholder="Message*" name="message" tabindex="5" required class="input-dark" id="f-textarea"></textarea>
                        </div>
                    </div>
                    <p class="main-color"><em>* Required fields</em></p>
                    <div class="send-wrapper">
                        <div class="send ir" id="contact-submit" tabindex="6">Send!</div>
                    </div>
                </form>
            </div>
            <div class="follow-us">
                <h2 class="short">Follow Me</h2>
                <div class="clearfix">
                    <?php get_template_part('social-networks'); ?>
                </div>
            </div>
        </div>
    </section>