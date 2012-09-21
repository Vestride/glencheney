<?
$project_categories = get_terms('type', array('number' => 5));

$projects = vestride_get_project_posts();

foreach ($project_categories as $cat) {
    $icon = '';
    switch ($cat->slug) {
        case 'code':
            $icon = 'file';
            break;
        case 'design':
            $icon = 'align-left';
            break;
        case 'miscellaneous':
            $icon = 'random';
            break;
        case 'videos':
            $icon = 'facetime-video';
            break;
        case 'web':
            $icon = 'globe';
            break;
    }

    $cat->icon = $icon;
}
?>
    <section id="work">
        <h3 class="section-title text-right"><span>Work<span class="circle-icon title-icon icon-briefcase"></span></span></h3>
        <h2 class="short filter-title">Most Recent</h2>
        <div>
            
            <ul class="filter-options clearfix">
                <li class="filter-option active" data-group="all"><div class="filter-icon icon-th"></div>Most Recent</li>
                <? foreach ($project_categories as $cat) : ?>
                <li class="filter-option" data-group="<?= $cat->slug; ?>"><div class="filter-icon icon-<?= $cat->icon; ?>"></div><?= $cat->name; ?></li>
                <? endforeach; ?>
            </ul>

            <div id="grid">
                <?php foreach ($projects as $project): ?>
                <div class="item" data-groups='<?= json_encode($project->term_slugs); ?>'>
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
        
    </section>