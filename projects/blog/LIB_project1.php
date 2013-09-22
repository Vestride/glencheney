<?php
//Global variables for the user's browser info.
define("PWORD", "539");
list($browser, $browser_version, $os, $os_version, $ip_address) = userInfo();

/**
 * Pass in the page title, and an array of any stylesheets or scripts you want
 *
 * @param string $title
 * @param array $stylesheets
 * @param array $scripts
 * @return string
 */
function head($title="Glen's Blog", $stylesheets='', $scripts='') {
$str = <<<END
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='content-type' content='text/html; charset=utf-8' />
        <link rel='icon' type='image/png' href='images/favicon.png' />
        <title>$title</title>
        
END;

    if(is_array($stylesheets)) {
        foreach($stylesheets as $stylesheet) {
            $str .= "<link rel='stylesheet' type='text/css' href='$stylesheet' />\n\t\t";
        }
    }
    else if ($stylesheets != '')
        $str .= "<link rel='stylesheet' type='text/css' href='$stylesheets' />\n\t\t";
    if(is_array($scripts)) {
        foreach($scripts as $script) {
            $str .= '<script type="text/javascript" src="'.$script.'"></script>'."\n";
        }
    }
    else if ($scripts != '')
        $str .= '<script type="text/javascript" src="'.$scripts.'"></script>';

    $str .= "</head>\n";
    
    return $str;
}

/**
 * Based on the users current page, it outputs the correct heading as well as
 * determining wether or not to use html5 tags
 *
 * @global string $browser
 * @param string $currentPage
 * @return string header with navigation links
 */
function nav($currentPage) {
    global $browser;

    $heading = '';
    if($browser != "Internet Explorer") {
        //HTML5 tags capable
        $heading .= "<header>\n";
    }
    else {
        //Doesn't understand html5 tags
        $heading .= "<div id=\"header\">\n";
    }

    $heading .= "<div id='header_center'>\n";
    $heading .= "    <nav>\n";
    $heading .= "        <ul>\n";
    switch($currentPage) {
        case "index.php":
            $heading .= "            <li class='current round'><a href='index.php'>Home</a></li>\n";
            $heading .= "            <li><a href='blog.php'>Blog</a></li>\n";
            $heading .= "            <li><a href='admin.php'>Admin</a></li>\n";
            $heading .= "            <li><a href='services.php'>Services</a></li>\n";
            break;
        case "blog.php":
            $heading .= "            <li><a href='index.php'>Home</a></li>\n";
            $heading .= "            <li class='current round'><a href='blog.php'>Blog</a></li>\n";
            $heading .= "            <li><a href='admin.php'>Admin</a></li>\n";
            $heading .= "            <li><a href='services.php'>Services</a></li>\n";
            break;
        case "admin.php":
            $heading .= "            <li><a href='index.php'>Home</a></li>\n";
            $heading .= "            <li><a href='blog.php'>Blog</a></li>\n";
            $heading .= "            <li class='current round'><a href='admin.php'>Admin</a></li>\n";
            $heading .= "            <li><a href='services.php'>Services</a></li>\n";
            break;
        case "services.php":
            $heading .= "            <li><a href='index.php'>Home</a></li>\n";
            $heading .= "            <li><a href='blog.php'>Blog</a></li>\n";
            $heading .= "            <li><a href='admin.php'>Admin</a></li>\n";
            $heading .= "            <li class='current round'><a href='services.php'>Services</a></li>\n";
            break;
        default:
            $heading .= "            <li><a href='index.php'>Home</a></li>\n";
            $heading .= "            <li><a href='blog.php'>Blog</a></li>\n";
            $heading .= "            <li><a href='admin.php'>Admin</a></li>\n";
            $heading .= "            <li><a href='services.php'>Services</a></li>\n";
            break;
    }
    
    $heading .= "        </ul>\n";
    $heading .= "   </nav>\n";
    $heading .= "   <a href='index.php'><img src='images/smiley.png' alt='Glen Cheney Logo' /></a>\n";
    $heading .= "</div>\n";

    if($browser != "Internet Explorer") {
        //HTML5 tags capable
        $heading .= "</header>\n";
    }
    else {
        //Doesn't understand html5 tags
        $heading .= "</div>\n";
    }

    return $heading;
}

/**
 * Parses the client's browser's user agent string.
 * returns an array of the user's browser, browser version, os, os version and ip
 *
 * @return Array
 */
function userInfo() {
    //IP
    $ip_address = $_SERVER['REMOTE_ADDR'];

     $ua = $_SERVER['HTTP_USER_AGENT'];

    //OS
    $os = '';
    $os_version = '';
    if(stripos($ua, "windows")) {
        $os = "Windows";
        if(stripos($ua, "Windows NT 6.1"))
            $os_version = "7";
        else if(stripos($ua, "Windows NT 6.0"))
            $os_version = "Vista";
        else if(stripos($ua, "Windows NT 5.1"))
            $os_version = "XP";
        else
            $os_version = "Unknown";
    }
    else if(stripos($ua, "mac"))
        $os = "Mac";
    else if(stripos($ua, "linux"))
        $os = "Linux";
    else
        $os = "Unknown";

    //Browser
    $browser = '';
    $browser_version = '';
    if(stripos($ua, "firefox")) {
        $browser = "Firefox";
        $pos = strripos($ua, "Firefox/");
        $pos = $pos+8;
        $browser_version = substr($ua, $pos);
    }
    else if(stripos($ua, "chrome")) {
        $browser = "Chrome";
        $pos = strripos($ua, "Chrome/");
        $pos = $pos+7;
        $browser_version = substr($ua, $pos, 10);
    }
    else if(stripos($ua, "safari")) {
        $browser = "Safari";
        $pos = strripos($ua, "Version/");
        $pos = $pos+8;
        $browser_version = substr($ua, $pos, 3);
    }
    else if(stripos($ua, "Presto")) {
        $browser = "Opera";
        $pos = strripos($ua, "Version/");
        $pos = $pos+8;
        $browser_version = substr($ua, $pos, 5);
    }
    else if(stripos($ua, "MSIE")) {
        $browser = "Internet Explorer";
        $pos = strripos($ua, "MSIE ");
        $pos = $pos+5;
        $browser_version = substr($ua, $pos, 3);
    }
    else
        $browser = "Unknown";

    return array($browser, $browser_version, $os, $os_version, $ip_address);
}

/**
 * returns the bio.txt with html encoding or not
 *
 * @param boolean $html
 * @return string
 */
function get_bio($html=true) {
    $filename = 'bio.xml';
    $file = file_get_contents($filename);
    $dom = new DomDocument();
    $dom->loadXML($file);
    $content = $dom->firstChild->getElementsByTagName('content')->item(0)->nodeValue;
    $content = trim($content);
    /*if($html)
        return html_entity_decode($file);
    else
        return $file;
     */
    return $content;
}

/**
 * If the browser is Chrome or Safari, this function will return the footer with <footer> tags
 * otherwise, it returns a <div> with an ID of footer because other browsers have not fully
 * implemented html5 tags.
 *
 * @return String $str
 */
function footer() {
    global $browser, $browser_version, $os, $os_version, $ip_address;
    $str = '';
    if($browser != "Internet Explorer") {
        $str = <<<END
        <footer>
            <div id="footer_center">
                <p>You're browsing using $browser $browser_version on $os $os_version. Your ip address is $ip_address</p>
            </div>
        </footer>
END;
        return $str;
    }
    else {
      $str = <<<END
        <div id="footer">
            <div id="footer_center">
                <p>You're browsing using $browser $browser_version on $os $os_version. Your ip address is $ip_address</p>
            </div>
        </div>
END;
      return $str;
    }
}

/**
 * Reads in the posts from blog.txt. Explodes on triple underscore to separate posts
 * then on pipes (|) for title, content and date. Saves that to an array,
 * reverses the array to get the newest post first, and then limits the number of
 * posts from the $start and $end variables, puts them in an object, and returns that object.
 *
 * @param int $start
 * @param int $end
 * @param boolean $count
 * @return stdClass $posts
 */
function getPosts($start=0, $end=3, $count=false) {
    $filename = "blog.xml";
    $dom = new DomDocument();
    $dom->load($filename);
	
    //Break into posts
    $blog_posts = $dom->getElementsByTagName('post');
    $all_posts = array();
    $posts = new stdClass(); //Object
    
    //Save info
    foreach($blog_posts as $key => $post) {
        $title = $post->getAttribute('title');
        $timestamp = $post->getAttribute('date');
        $content_node = $post->getElementsByTagName('content')->item(0);
        $content = $dom->saveXML($content_node); //Save html tags
        $content = substr($content, 9, -10);
		
        $all_posts[$key]['post_title'] = trim($title);
        $all_posts[$key]['post_content'] = trim(nl2br($content));
        $all_posts[$key]['post_date'] = trim($timestamp);
        $all_posts[$key]['permalink'] = $key;
    }
    //Newest first
    $latest_posts = array_reverse($all_posts);

    //If we just want the count
    if($count)
        return count($latest_posts);

    //If an end given is more than our total posts, make it our total posts
    if($end > count($latest_posts))
        $end = count($latest_posts);

    //Start with $start and end with $end
    for($i = $start; $i < $end; $i++) {
        $posts->$i->post_title = $latest_posts[$i]['post_title'];
        $posts->$i->post_content = $latest_posts[$i]['post_content'];
        $posts->$i->post_date = $latest_posts[$i]['post_date'];
        $posts->$i->permalink = $latest_posts[$i]['permalink'];
    }

    return $posts;
}

/**
 * Returns a clean string.
 *
 * @param string $str
 * @return string
 */
function sanitizeString($str) {
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlentities($str);
    $str = strip_tags($str);
    return $str;
}

/**
 * Checks to see if passwords are a match
 * if bio is set, it writes to bio.txt with the new bio
 * if title, content, and date are set, it writes a new post
 *
 * depending on which form is submitted, either 'bio' or 'post' are returned to display success
 *
 * @return string
 */
function adminBlogPost() {
    if (isset($_POST['submit']) && isset($_POST['title'])) {
        $password = sanitizeString($_POST['password']);
        if (PWORD == $password) {
            if (isset($_POST['title']) && strlen($_POST['title']) > 0
                && isset($_POST['content']) && strlen($_POST['content']) > 0
                && isset($_POST['date']) && strlen($_POST['date']) > 0)
            {
                //All good
                $sanitized = array();
                foreach ($_POST as $key => $input) {
                    $sanitized[$key] = sanitizeString($input);
                }
               
                $post_success = addPost($sanitized['title'], $sanitized['content'], $sanitized['date']);
                
                if($post_success !== false)
                    return "post";
                else
                    return false;
            }
            else {
                echo 'post title, date, or content not set<br>';
            }
        }
        else {
            return array($_POST['title'], $_POST['content']);
        }
    }
    else if(isset($_POST['updateRss'])) {
        $password = sanitizeString($_POST['password']);
        if (PWORD == $password) {
            RSSFeed::buildRss();
        }
        else
            return 'wrongPass';
    }
}

function adminBio() {
    if (isset($_POST['submit']) && isset($_POST['bio'])) {
        $password = sanitizeString($_POST['password']);
        if (PWORD == $password) {
            if (isset($_POST['bio']) && strlen($_POST['bio']) > 0) {
                $filename = 'bio.xml';
                $file = file_get_contents($filename);
                $dom = new DomDocument();
                $dom->loadXML($file);
                $content_node = $dom->firstChild->getElementsByTagName('content')->item(0);
                $content_node->nodeValue = $_POST['bio'];
                $content_node->setAttribute('lastModified', date('r'));

                $bio_success = $dom->save($filename);

                if ($bio_success !== false)
                    return "bio";
                else
                    return false;
            }
        }
        else {
            //Wrong password
            return "wrongPass";
        }
    }
}

function addPost($title, $content, $date) {
    $filename = "blog.xml";
    $dom = new DomDocument();
    $dom->load($filename);

    $root = $dom->documentElement;
    $post = $dom->createElement('post');
    $post->setAttribute('title', $title);
    $post->setAttribute('date', $date);
    $content_node = $dom->createElement('content', $content);
    $post->appendChild($content_node);
    $root->appendChild($post);
	
    //Save to file
    $success = $dom->save($filename);

    //Update RSS feed
    RSSFeed::buildRss();
	
    return $success;
}

function hi() {
	return 'hi';
}


?>