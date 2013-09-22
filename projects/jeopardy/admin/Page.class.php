<?php
class Page {

    var $title;
    var $stylesheet;
    var $content;

    function __construct($title='untitled', $stylesheet='', $content='Default Page class page') {
        $this->title = $title;
        $this->stylesheet = $stylesheet;
        $this->content = $content;
    }

    function toString() {
        return <<<END
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>$this->title</title>
	<link type="text/css" rel="stylesheet" href="$this->stylesheet" />
</head>
<body>
    
        $this->content
    
</body>
</html>
END;
    }

    static function get_navigation() {
        $nav = "<header>\n";
        $nav .= "<div id='header_center'>\n";
        $nav .= "<nav>\n";
        $nav .= "<ul>\n";
        $nav .= "<li><a href='public.php'>public</a></li>\n";
        $nav .= "<li><a href='admin.php'>admin</a></li>\n";
        $nav .= "<li><a href='login.php'>login</a></li>\n";
        $nav .= "<li><a href='get_round.php?round=1'>get_round.php</a></li>\n";
        $nav .= "<li><a href='get_available_rounds.php'>get_available_rounds.php</a></li>\n";
        $nav .= "<li><a href='../game/'>Go to Client App</a></li>\n";
        $nav .= "<li><a href='logout.php'>logout</a></li>\n";
        $nav .= "</ul>\n";
        $nav .= "</nav>\n";
        $nav .= "</div>\n";
        $nav .= "</header>\n";
        return $nav;
    }

}

// end class Page
?>