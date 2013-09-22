<?php require_once('LIB_project1.php'); ?>
<?php require_once('P2_Utils.class.php'); ?>
<?php
    $bio_success = adminBio();
    $post_success = adminBlogPost();
    $feed_success = P2_Utils::adminFeeds();
    echo head("Project 2 539", array("styles.css", "jwysiwyg/jquery.wysiwyg.css"), array("http://code.jquery.com/jquery-1.4.2.min.js", "jwysiwyg/jquery.wysiwyg.js" ));
?>
<body>
    <?php echo nav("admin.php"); ?>
    <div id="container">
        <div id="content">
            <div id="admin">
                <?php if(isset($bio_success) && $bio_success == 'bio') echo "<h3>Bio has been updated</h3>"; ?>
                <h2>Update Bio</h2>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <textarea id="bio" cols="100" rows="30" name="bio"><?php echo get_bio(false); ?></textarea>
                    <br />
                    <input type="password" name="password" placeholder="Password"/> Password <?php if(isset($bio_success) && $bio_success == 'wrongPass') echo "<span style=\"color: red\" >Incorrect password</span>"; ?>
                    <br />
                    <input type="submit" name="submit" value="Submit" />
                </form>

                <?php if(isset($post_success) && $post_success == 'post') echo "<h3>Your post has been added</h3>"; ?>
                <h2>Add blog post</h2>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <input type="text" name="title" placeholder="Title" <?php if(isset($post_success) && is_array($post_success)) echo 'value="'.$post_success[0].'"'; ?>/> Title
                    <br />Post content<br />
                    <textarea id="post" cols="100" rows="25" name="content" placeholder="Post content"><?php if(isset($post_success) && is_array($post_success)) echo $post_success[1]; ?></textarea>
                    <br />
                    <input type="text" name="date" value="<?php echo date("F j, Y"); ?>" readonly/> Date
                    <br />
                    <input type="password" name="password" placeholder="Password" /> Password <?php if(isset($post_success) && is_array($post_success) || $post_success == 'wrongPass') echo "<span style=\"color: red\" >Incorrect password</span>"; ?>
                    <br />
                    <input type="submit" name="submit" value="Submit" />
                    <input type="submit" name="updateRss" value="Force RSS Update" />
                </form>
				
                <?php if(isset($feed_success)) echo "<h3>$feed_success"; ?>
                <h2>Choose feeds to follow (10 max)</h2>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <?php echo P2_Utils::rssCheckboxes(); ?>
                    <br />
                                        <input type="hidden" name="feeds" value="feeds" />
                    <input type="password" name="password" placeholder="Password"/> Password <?php if(isset($feeds_success) && $feeds_success == 'wrongPass') echo "<span style=\"color: red\" >Incorrect password</span>"; ?>
                    <br />
                    <input type="submit" name="submit" value="Submit" />
                </form>
            </div><!-- #main_content -->
        </div><!-- #content -->
    </div><!-- #container -->
    <?php echo footer(); ?>
	<script type="text/javascript">
    //Adds what you see is what you get editor to the textareas
		$(document).ready(function(){
		   $("#bio").wysiwyg();
		   $("#post").wysiwyg();
		});
	</script>
</body>
</html>