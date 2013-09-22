<?php require_once('LIB_project1.php'); ?>
<?php require_once('P2_Utils.class.php'); ?>
<?php
    echo head("Project 2 539", "styles.css", "http://code.jquery.com/jquery-1.4.2.min.js");
    $post = P2_Utils::getPost($_GET['post']);
?>
<body>
    <?php echo nav(''); ?>
    <div id="container">
        <div id="content">
            <article>
                <h2 class="entry_title"><?php echo $post->postTitle; ?></h2>
                <div>
                    Posted on <span class="entry_date"><?php echo $post->postDate; ?></span>
                </div><!-- .entry_meta -->

                <div class="entry_content">
                    <?php echo $post->postContent; ?>
                </div><!-- .entry_content -->
            </article>
        </div><!-- #content -->
    </div><!-- #container -->
</body>
</html>