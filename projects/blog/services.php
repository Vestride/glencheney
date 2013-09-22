<?php require_once('LIB_project1.php'); ?>
<?php require_once('P2_Utils.class.php'); ?>
<?php echo head("Project 2 539", array("styles.css", "jwysiwyg/jquery.wysiwyg.css"), "http://code.jquery.com/jquery-1.4.2.min.js");
if(isset($_GET['page']))
    $page = $_GET['page'];
else
    $page = 0;
?>
<body>
    <?php echo nav("services.php"); ?>
    <div id="container">
        <div id="content" class="services">
            <?php echo P2_Utils::buildReachGamesTable($page); ?>
            <div class="pagination">
                <span class="next"><a href="services.php?page=<?php echo $page+1;?>">Next&raquo;</a></span>
                <?php if($page > 0): ?>
                <span class="previous"><a href="services.php?page=<?php echo $page-1;?>">&laquo;Previous</a></span>
                <?php else: ?>
                &nbsp;
                <?php endif; ?>
            </div>
            <h2>Project 2 RSS Feed</h2>
            <a href="project2.rss">Link</a>
            <h2>Classmate blogs</h2>
            <?php foreach(P2_Utils::getStudentPosts() as $key => $student):
                $name = explode("_", $key);
                $name = $name[0].' '.$name[1];
            ?>
            <h3><?php echo $name ?></h3>
            <?php foreach($student as $index => $post): if('url' == $index) continue; ?>
                <article>
                    <h3 class="entry_title"><?php echo $post->postTitle; ?></h3>
                    <div>
                        Posted on <span class="entry_date"><?php echo date('n.j.y', strtotime($post->postDate)); ?></span>
                    </div><!-- .entry_meta -->

                    <div class="entry_content">
                        <?php echo $post->postContent; ?>
                    </div><!-- .entry_content -->
                </article>
            <?php endforeach; ?>
            <a href="<?php echo $student->url; ?>">View Rss</a>
            <hr />
            <?php endforeach; ?>
        </div><!-- #content -->
    </div><!-- #container -->
    <?php echo footer(); ?>
</body>
</html>