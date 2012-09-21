<?php
$featured_projects = vestride_get_featured_project_posts();
?>
    <section id="featured">
        <h3 class="section-title text-right"><span>Featured<span class="circle-icon title-icon icon-star"></span></span></h3>
        <div class="carousel-container">
            <ul class="carousel">
                <? foreach ($featured_projects as $project) : ?>
                <li>
                    <a href="<? echo $project->permalink; ?>"  data-title="<? echo $project->post_title; ?>" data-categories='<? echo json_encode($project->categories); ?>'>
                        <? echo $project->img; ?>
                    </a>
                </li>
                <? endforeach; ?>
            </ul>
            <span class="carousel-item-title"></span>
            <div class="carousel-control-container">
                <div class="carousel-links"></div>
                <div class="carousel-control"></div>
            </div>
        </div>
    </section>