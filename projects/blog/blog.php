<?php require_once('LIB_project1.php'); ?>
<?php require_once('P2_Utils.class.php'); ?>
<?php
if(isset($_GET['page']) && is_numeric($_GET['page']))
    $page = $_GET['page'];
else
    $page = '1';

$posts_per_page = 5;
$start = ($page-1) * $posts_per_page;
$end = $start + $posts_per_page;
$posts = getPosts($start, $end);

$total_posts = getPosts(0, 10000, true);
$numPages = ceil($total_posts/$posts_per_page);
?>
<?php echo head("Project 2 539", "styles.css", "http://code.jquery.com/jquery-1.4.2.min.js"); ?>

<body>
    <?php echo nav("blog.php"); ?>
    <div id="container">
        <div id="content">
            <div id="posts">
                <?php foreach($posts as $post) : ?>
                <article>
                    <h2 class="entry_title"><a href="<?php echo 'display_post.php?post='.$post->permalink; ?>" rel="bookmark"><?php echo $post->post_title; ?></a></h2>
                    <div>
                        Posted on <span class="entry_date"><?php echo $post->post_date; ?></span>
                    </div><!-- .entry_meta -->

                    <div class="entry_content">
                        <?php echo $post->post_content; ?>
                    </div><!-- .entry_content -->
                </article>
                <?php endforeach; ?>
            </div><!-- #posts -->
            <div class="pagination">
                <?php if($page > 1): ?>
                <span class="newer"><a href="blog.php?page=<?php echo $page-1;?>">Newer&raquo;</a></span>
                <?php endif; ?>
                <?php if($page < $numPages):?>
                <span class="older"><a href="blog.php?page=<?php echo $page+1;?>">&laquo;Older</a></span>
                <?php endif; ?>
            </div>
        </div><!-- #content -->
    </div><!-- #container -->
    <?php echo footer(); ?>
</body>
</html>