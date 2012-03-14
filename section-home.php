<?php
$featured_projects = vestride_get_featured_project_posts();
?>
        <section id="home" class="home">
            <h4 class="section-title"></h4>
            <div class="carousel-container">
                <ul class="carousel">
                    <? foreach ($featured_projects as $project) : ?>
                    <li>
                        <a href="<? echo $project->permalink; ?>"  data-title="<? echo $project->post_title; ?>" data-categories='<? echo json_encode($project->terms); ?>'>
                            <? echo $project->img; ?>
                        </a>
                    </li>
                    <? endforeach; ?>
                </ul>
                <div class="carousel-next sprite sprite-next"></div>
                <div class="carousel-prev sprite sprite-prev"></div>
                <div class="carousel-control-container">
                    <div class="carousel-control"></div>
                </div>
                <p class="carousel-item-title"></p>
            </div>
            <div class="divider"></div>
            <nav class="quick-links clearfix">
                <div>
                    <h4><span class="sprite sprite-person"></span>Who <strong>I am</strong></h4>
                    <p>I&rsquo;m a New Media Interactive Development student, graduating from <a href="http://rit.edu">RIT</a></p>
                    <p><a href="#about">More about me<span class="sprite sprite-arrow-right"></span></a></p>
                </div>
                <div>
                    <h4><span class="sprite sprite-briefcase"></span>What <strong>I Do</strong></h4>
                    <p>I&rsquo;m a developer with a passion for the frontend. I enjoy keeping up with new technologies and making the web awesome.</p>
                    <p><a href="#work">View my work<span class="sprite sprite-arrow-right"></span></a></p>
                </div>
                <div>
                    <h4><span class="sprite sprite-envelope"></span>Contact <strong>Me</strong></h4>
                    <p>Have a comment or question? Just want to say hello? I&rsquo;d love to hear from you!</p>
                    <p><a href="#contact">Get in touch<span class="sprite sprite-arrow-right"></span></a></p>
                </div>
                <div>
                    <h4><span class="sprite sprite-message"></span>My <strong>Blog</strong></h4>
                    <p>Want to know what I&rsquo;m up to? Keep up with my latest projects and interests.</p>
                    <p><a href="<?php bloginfo('url'); ?>/blog">Visit my blog<span class="sprite sprite-arrow-right"></span></a></p>
                </div>
            </nav>
        </section>