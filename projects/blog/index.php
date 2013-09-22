<?php require_once('LIB_project1.php'); ?>
<?php require_once('P2_Utils.class.php'); ?>
<?php $posts = getPosts(0,3); ?>
<?php echo head("Project 2 539", "styles.css", "http://code.jquery.com/jquery-1.4.2.min.js"); ?>

<body>
    <?php echo nav("index.php"); ?>
    <div id="container">
        <div id="content">
            <div id="sidebar">
                <?php echo get_bio(); ?>
            </div><!-- #sidebar -->
            <div id="main_content">
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
            </div><!-- #main_content -->
        </div><!-- #content -->
    </div><!-- #container -->
    <?php echo footer(); ?>
</body>
</html>