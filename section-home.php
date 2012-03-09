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
                <span class="carousel-item-title"></span>
                <div class="carousel-control-container">
                    <div class="carousel-control"></div>
                </div>
            </div>
            <div class="divider"></div>
            <nav class="quick-links clearfix">
                <div>
                    <h4><span class="sprite sprite-question"></span>Who <strong>We Are</strong></h4>
                    <p>Eightfold Studios is a design company based in Corvallis, Oregon</p>
                    <p><a href="#about">Learn More<span class="sprite sprite-arrow-right"></span></a></p>
                </div>
                <div>
                    <h4><span class="sprite sprite-briefcase"></span>What <strong>We Do</strong></h4>
                    <p>Our mission is to bring ideas to life. To put it simply, well, we create things.</p>
                    <p><a href="#work">View our work<span class="sprite sprite-arrow-right"></span></a></p>
                </div>
                <div>
                    <h4><span class="sprite sprite-message"></span>Our <strong>Blog</strong></h4>
                    <p>Want to know what we&rsquo;re up to? Keep up with our latest projects and interests.</p>
                    <p><a href="<?php bloginfo('url'); ?>/blog">Visit our blog<span class="sprite sprite-arrow-right"></span></a></p>
                </div>
                <div>
                    <h4><span class="sprite sprite-download"></span>Free <strong>Downloads</strong></h4>
                    <p>Like free stuff? Of course you do. Download wallpapers, icons, and more!</p>
                    <p><a href="<?php bloginfo('url'); ?>/downloads">Get free stuff!<span class="sprite sprite-arrow-right"></span></a></p>
                </div>
            </nav>
        </section>