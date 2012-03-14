<?
$project_categories = get_terms('type', array('number' => 5));

$projects = vestride_get_project_posts();
?>
    <section id="work">
        <h3 class="section-title text-right"><span>Work<span class="title-icon icon-briefcase"></span></span></h3>
        <div class="paginate">
            <h2 class="short filter-title">Most Recent</h2>
            
            <div class="paginate-container">
                <span class="pages">Page 0/0</span>
                <ul class="filter-options">
                    <li class="filter-option active" data-key="all"><div class="sprite sprite-recent"></div><span>Most Recent</span>
                    <? foreach ($project_categories as $cat) : ?>
                    </li><li class="filter-option" data-key="<?= $cat->slug; ?>"><div class="sprite sprite-<?= $cat->slug; ?>"></div><span><?= $cat->name; ?></span>
                    <? endforeach; ?>
                    </li><li class="paginate-nav paginate-prev nav-prev">
                    </li><li class="paginate-nav paginate-next nav-next"></li>
                </ul>

                <div id="grid">
                    <?php foreach ($projects as $project): ?>
                    <div class="item" data-key='<?= json_encode($project->term_slugs); ?>'>
                        <div class="item-img"><? echo $project->img; ?></div>
                        <div class="item-details-container">
                            <div class="item-details">
                                <h4 class="item-title"><a href="<? echo $project->permalink; ?>" title="Launch project"><?= $project->post_title; ?></a></h4>
                                <h5 class="item-type main-color"><?php echo implode(', ', $project->terms); ?></h5>
                                <p class="item-post-excerpt"><?php echo $project->post_excerpt; ?></p>
                                <p class="item-link"><a href="<? echo $project->permalink; ?>" title="Launch project">View project<span class="sprite sprite-arrow-right"></span></a></p>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>
            </div>
            <div class="controls"><div class="paginate-controls"></div></div>
        </div>
        
    </section>