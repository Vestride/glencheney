<?php

class functions {

    static function nav() {
        //Score and links
        $content = '';
        $content .= "<div id='topbar'>\n";
        $content .= "<p style='float:right'><a href='index.php'>Jeopardy!</a>&nbsp;&nbsp;<a href='help.php'>Help</a></p>\n";
        if(isset($_SESSION['points']))
            $content .= "<p>Score: <span id='currentPoints'>{$_SESSION['points']}</span></p>\n";
        else
            $content .= "<p>&nbsp;</p>\n";
        $content .= "</div>\n";
        return $content;
    }

    static function newRoundButton($action) {
        //New round
        $content = '';
        $content .= "<form style='margin-top: 50px;' action='$action' method='post'>\n";
        $content .= "<input type='submit' name='gameover' value='Choose New Round' />\n";
        $content .= "</form>\n";
        return $content;
    }

    /**
     *
     */
    static function cleanUpQuotes($str) {
        return htmlentities(stripslashes($str), ENT_QUOTES);
    }

    //From phpro.org http://www.phpro.org/examples/Convert-Object-To-Array-With-PHP.html
    static function objectToArray($object) {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map('self::objectToArray', $object);
    }

    //Arrays
    static function compareValue($a, $b) {
        if ($a['value'] == $b['value']) {
            return 0;
        }
        return ($a['value'] < $b['value']) ? -1 : 1;
    }

    //PHP >= 5.3
    //Gibson = 5.2.14
    /*static function osort(&$array, $prop) {
        usort($array, function($a, $b) use ($prop) {
            return $a->$prop > $b->$prop ? 1 : -1;
        });
    }*/

}

?>
