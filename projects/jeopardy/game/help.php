<?php
session_start();
$content = '';

//$action = "http://people.rit.edu/gec5190/pfw/project3/B/index.php";
$action = 'index.php';

$content .= "<div id='container'>\n";

$content .= Functions::nav();
$content .= Functions::newRoundButton($action);

//About jeopardy
$content .= "<h2 style='color: #00B2C2'>About Jeopardy!</h2>\n";
$content .= "<p>Six categories are announced, each with a column of five trivia clues (phrased in answer form), each one incrementally valued more than the previous, ostensibly by difficulty. The subjects range from standard topics including history and current events, the sciences, the arts, popular culture, literature and languages, to pun-laden titles (many of which refer to the standard subjects) and wordplay categories.</p>\n";
$content .= "<h3>Final Jeopardy! Round</h3>\n";
$content .= "<p>A category is announced by the host followed by a commercial break (during which the staff comes on stage and advises the contestants while barriers are placed between the contestants). During this period, the contestants write down a wager, based on the category, of as little as $0 or up to as much money as they have accumulated.</p>\n";

//Sources
$content .= "<br /><h2 style='color: #00B2C2'>Sources</h2>\n";
$content .= "<a href='http://en.wikipedia.org/wiki/Jeopardy!'>http://en.wikipedia.org/wiki/Jeopardy!</a><br />\n";
$content .= "<a href='http://www.edochan.com/teaching/jeopardyqus.htm'>http://www.edochan.com/teaching/jeopardyqus.htm</a><br />\n";
$content .= "<a href='http://jeopardylabs.com/play/enter-title5911'>http://jeopardylabs.com/play/enter-title5911</a><br />\n";
$content .= "<a href='http://www.triviaplaying.com/14_Sports_Q_.htm'>http://www.triviaplaying.com/14_Sports_Q_.htm</a><br />\n";


$content .= "</div>\n";
$page = new Page("Jeopardy Help", "styles.css", $content);
echo $page->toString();

function __autoload($className) {
    require_once $className . '.class.php';
}
?>
