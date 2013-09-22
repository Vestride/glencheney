<?php 

class RSSFeed {
    static function buildRss($numPosts=10) {
        $posts = getPosts(0, $numPosts);
        $date = date('r');

        $rss = <<<END
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
<channel>
<title>Glen's $numPosts most recent blog posts</title>
<link>http://people.rit.edu/gec5190/pfw/project2/</link>
<description>This is the description of my rss2 feed</description>
<lastBuildDate>$date</lastBuildDate>
<language>en-us</language>

END;
		
        foreach($posts as $key => $post) {
            $post->post_date = date("r", strtotime($post->post_date));
            $rss .= "<item>\n";
            $rss .= "<title>$post->post_title</title>\n";
            $rss .= "<link>http://people.rit.edu/gec5190/pfw/project2/display_post.php?id=$post->permalink</link>\n";
            $rss .= "<guid>http://people.rit.edu/gec5190/pfw/project2/display_post.php?id=$post->permalink</guid>\n";
            $rss .= "<pubDate>$post->post_date</pubDate>\n";
            $rss .= "<description><![CDATA[ $post->post_content ]]></description>\n";
            $rss .= "</item>\n";
        }

        $rss .= "</channel>\n</rss>";

        return file_put_contents("project2.rss", $rss);
    }
}

?>