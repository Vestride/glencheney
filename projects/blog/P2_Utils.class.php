<?php

function __autoload($class_name) {
    require_once $class_name . '.class.php';
}

class P2_Utils {

    static function getStudents() {
            $url = "rss_class.xml";
            $file = file_get_contents($url);
            $dom = new DomDocument();
            $dom->loadXML($file);

            $student_list = $dom->getElementsByTagName('student');

            $students = new stdClass();
            foreach($student_list as $key => $student) {
                $first = $student->getElementsByTagName('first')->item(0)->nodeValue;
                $last = $student->getElementsByTagName('last')->item(0)->nodeValue;
                $url = $student->getElementsByTagName('url')->item(0)->nodeValue;
                $following = $student->getAttribute("following");
                if($following != 'true')
                    $following = 'false';

                $students->$key->first = $first;
                $students->$key->last = $last;
                $students->$key->url = $url;
                $students->$key->following = $following;
            }

            return $students;
    }

    static function rssCheckboxes() {
        $students = self::getStudents();

        $html = '';
        foreach ($students as $student) {
            $fname = explode(" ", $student->first);
            $fname = implode("_", $fname);
            $lname = explode(" ", $student->last);
            $lname = implode("_", $lname);
            $concat = $fname.'_'.$lname;

            $html .= '<input type="checkbox" id="' . $concat . '" name="' . $concat . '" value="' . $student->url . '"';
            if ($student->following == 'true')
                $html .= ' checked="checked"';
            $html .= '/><label for="' . $concat . '">' . $student->first . ' ' . $student->last . '</label>';
            $html .= "<br />\n";
        }

        return $html;
    }

    static function adminFeeds() 
    {
        if (isset($_POST['submit']) && isset($_POST['feeds'])) 
        {
            $password = sanitizeString($_POST['password']);
            if (PWORD == $password) {
                $url = "rss_class.xml";
                $file = file_get_contents($url);
                $dom = new DomDocument();
                $dom->loadXML($file);

                $count = 0;
                foreach ($dom->getElementsByTagName('student') as $key => $student) {
                    $fname = explode(" ", $student->getElementsByTagName('first')->item(0)->nodeValue);
                    $fname = implode("_", $fname);
                    $lname = explode(" ", $student->getElementsByTagName('last')->item(0)->nodeValue);
                    $lname = implode("_", $lname);
                    $concat = $fname.'_'.$lname;
                    if (array_key_exists($concat, $_POST) && $count < 10) {
                        $student->setAttribute('following', 'true');
                        $count++;
                    } else {
                        $student->setAttribute('following', 'false');
                    }
                }
                
                if($count < 10)
                    $msg = 'Your feeds have been added';
                else 
                    $msg = 'Only the first 10 feeds you chose have been selected';

                $success = $dom->save($url);

                if ($success)
                    return $msg;
                else
                    return false;
            }
            else {
                //Wrong password
                return "wrongPass";
            }
        }
    }

    static function getReachGames($page=0) {
        $url = "http://www.bungie.net/stats/reach/rssgamehistory.ashx?vc=0&player=Vestride&page=".$page;
        $xmlns = "http://www.bungie.net/";
        $contents = file_get_contents($url);
        $dom = new DomDocument();
        $dom->loadXML($contents);

        $items = $dom->getElementsByTagName('item');

        $games = new stdClass();

        foreach($items as $key => $item) {
            $games->$key->title = $item->getElementsByTagName('title')->item(0)->nodeValue;
            $games->$key->link = htmlentities($item->getElementsByTagName('link')->item(0)->nodeValue);
            $games->$key->pubDate = $item->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $games->$key->description = $item->getElementsByTagName('description')->item(0)->nodeValue;
            
            if($item->getElementsByTagNameNS($xmlns, 'place')->length > 0)
               $games->$key->place = $item->getElementsByTagNameNS($xmlns, 'place')->item(0)->nodeValue;
            if($item->getElementsByTagNameNS($xmlns, 'difficulty')->length > 0)
               $games->$key->difficulty = $item->getElementsByTagNameNS($xmlns, 'difficulty')->item(0)->nodeValue;
            $games->$key->score = $item->getElementsByTagNameNS($xmlns, 'score')->item(0)->nodeValue;
            $games->$key->spread = $item->getElementsByTagNameNS($xmlns, 'spread')->item(0)->nodeValue;
            $games->$key->map = $item->getElementsByTagNameNS($xmlns, 'map')->item(0)->nodeValue;
            $games->$key->playlist = $item->getElementsByTagNameNS($xmlns, 'playlist')->item(0)->nodeValue;
        }
        
        return $games;
    }
    
    static function buildReachGamesTable($page=0) {
        $games = self::getReachGames($page);
        $str = <<<END
        <h2>Vestride's recent Halo: Reach games</h2>
            <table id="games_table">
                <tr>
                    <th>Game Title</th>
                    <th>Place/Difficulty</th>
                    <th>Date</th>
                    <th>Score</th>
                    <th>Kill/Death Spread</th>
                    <th>Map</th>
                    <th>Playlist</th>
                </tr>
END;
                foreach($games as $game) {
                    if($game->spread > 5)
                        $color = 'green';
                    else if ($game->spread < 0)
                        $color = 'red';
                    else
                        $color = 'black';
                    $str .= "<tr>\n
                    <td><a href='".$game->link."'>".ucwords($game->title)."</a></td>
                    <td>";
                    if(isset($game->place))
                        $str .= $game->place;
                    else
                        $str .= $game->difficulty;
                    $str .= "</td>
                    <td>".date('n.j.y g:i a', strtotime($game->pubDate))."</td>
                    <td>$game->score</td>
                    <td style='color: $color'>$game->spread</td>
                    <td>$game->map</td>
                    <td>$game->playlist</td>
                    </tr>\n";
                }
                $str .= "</table>\n";
        
        return $str;
    }

    static function getStudentPosts() {
        $limitPerStudent=2;
        $filename = 'rss_class.xml';
        $posts = new stdClass();
        $classDom = new DOMDocument();
        $classDom->load($filename);
        
        $studentUrls = array();
        foreach($classDom->getElementsByTagName('student') as $student) {
            if($student->getAttribute('following') == 'true') {
                $first = $student->getElementsByTagName('first')->item(0)->nodeValue;
                $last = $student->getElementsByTagName('last')->item(0)->nodeValue;
                $index = $first.'_'.$last;
                $studentUrls[$index] = $student->getElementsByTagName('url')->item(0)->nodeValue;
            }
        }
        
        foreach($studentUrls as $key => $url) {
            $studentDom = new DOMDocument();
            $studentDom->load($url);
            
            for($i = 0; $i < $limitPerStudent; $i++) {
                $posts->$key->$i->postTitle = $studentDom->getElementsByTagName('item')->item($i)->getElementsByTagName('title')->item(0)->nodeValue;
                $posts->$key->$i->postDate = $studentDom->getElementsByTagName('item')->item($i)->getElementsByTagName('pubDate')->item(0)->nodeValue;
                $posts->$key->$i->postContent = $studentDom->getElementsByTagName('item')->item($i)->getElementsByTagName('description')->item(0)->nodeValue;
            }

            $posts->$key->url = $url;
        }
        
        return $posts;
    }

    static function getPost($permalink) {
        $filename = "blog.xml";
        $dom = new DomDocument();
        $dom->load($filename);

        $thePost = new stdClass();
        foreach($dom->getElementsByTagName('post') as $key => $post) {
            if($permalink == $key) {
                $thePost->postTitle = $post->getAttribute('title');
                $thePost->postDate = $post->getAttribute('date');
                $content_node = $post->getElementsByTagName('content')->item(0);
                $content = $dom->saveXML($content_node); //Save html tags
                $thePost->postContent = substr($content, 9, -10);
            }
        }

        return $thePost;
    }
}

?>