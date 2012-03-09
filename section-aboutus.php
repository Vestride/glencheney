<?
$our_mission_id = 6;
$our_mission = get_page($our_mission_id);
$our_mission->subtitle = get_post_meta($our_mission_id, 'subtitle', true);
$our_mission_title = explode(' ', $our_mission->post_title);
$our_mission->title = $our_mission_title[0] . ' <strong>' . $our_mission_title[1] . '</strong>';

$es_id = 8;
$es = get_page($es_id);
$es->subtitle = get_post_meta($es_id, 'subtitle', true);
$es_title = explode(' ', $es->post_title);
$es->title = $es_title[0] . ' <strong>' . $es_title[1] . '</strong>';

$people = vestride_get_featured_people();
?>
    <section id="about">
        <h3 class="section-title text-right"><span>About Us<span class="title-icon icon-person"></span></span></h3>
        <div class="about-us">
            <img class="hero" src="<?= get_template_directory_uri(); ?>/img/aboutus-hero.png" alt="An Eightfold Production" />
            
            <section class="section-info clearfix">
                <div class="section-details rfloat">
                    <article><?= $es->post_content; ?></article>
                </div>
                <div class="section-overview">
                    <span class="article-title"><?= $es->title; ?></span>
                    <span class="article-subtitle"><?= $es->subtitle; ?></span>
                </div>
            </section>
            
            <section class="section-info clearfix">
                <div class="section-details rfloat">
                    <article><?= $our_mission->post_content; ?></article>
                </div>
                <div class="section-overview">
                    <span class="article-title"><?= $our_mission->title; ?></span>
                    <span class="article-subtitle"><?= $our_mission->subtitle; ?></span>
                </div>
            </section>
            
            <?php foreach($people as $person) : ?>
            <section class="section-info clearfix">
                <div class="section-details section-with-title rfloat">
                    <span class="article-title"><?= $person->fname . ' <strong>' . $person->lname . '</strong>'; ?></span>
                    <span class="article-subtitle"><?= $person->position; ?></span>
                    <article><?= $person->post_content; ?></article>
                </div>
                <div class="section-overview">
                    <div class="hero hero-person"><?php echo $person->img; ?></div>
                    <ul class="follow-us follow-us-small">
                        <?php 
                            $count = 0;
                            foreach ($person->social as $network => $link) : 
                            if ($link == '') continue;
                            $count++;
                            if ($count > 4) break;
                        ?>
                        <li><a href="<?php echo $link; ?>" class="<?php echo $network; ?> ir" target="_blank"><?php echo ucfirst($network); ?><span></span></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>
            
            <?php endforeach; ?>
        </div>
    </section>