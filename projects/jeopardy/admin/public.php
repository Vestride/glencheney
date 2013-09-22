<?php

main();

function main() {
    $db = new Database();
    $content = "";
    $content .= Page::get_navigation();
    $content .= "<div id='container'>";

    $db->doQuery("SELECT * FROM j_category_set WHERE active = 'yes'");
    $content .= "<h1>".$db->getAffectedRows()." Category set(s) available</h1>";
    $topics = $db->fetch_all_array();
    foreach($topics as $topic) {
        $content .= "<h2><em>".$topic['title'] . '</em> - id='.$topic['id']."</h2>\n";
        $db->doQuery("SELECT * FROM j_category WHERE category_set_id='".$topic['id']."'");
        $content .= "<h3>".$db->getAffectedRows()." categories available for <em>{$topic['title']}</em></h3>\n";
        $categories = $db->fetch_all_array();
        foreach($categories as $category) {
            $db->doQuery("SELECT * FROM j_question WHERE category_id = '{$category['id']}'");
            $content .= "<h4>".$db->getAffectedRows()." questions available for <em>{$category['title']}</em></h4>\n";
            $questions = $db->fetch_all_array();
            $content .= "<ul>\n";
            foreach($questions as $question) {
                $content .= "\t<li>".stripslashes($question['question'])."</li>\n";
            }
            $content .= "</ul>\n";
        }
        $db->doQuery("SELECT question, answer FROM j_final_question WHERE category_set_id = '{$topic['id']}'");
        $finalQuestion = $db->fetch_array();
        $content .= "<h3>Final Question: {$finalQuestion['question']}</h3>\n";
        $content .= "<hr />\n";
    }
    $content .= "</div>\n";

    //Using joins...
    /*$query ="SELECT *
            FROM j_category_set
            JOIN j_category ON j_category_set.id = j_category.category_set_id
            JOIN j_question ON j_category.id = j_question.category_id
            WHERE active='yes'";
    $db->doQuery($query);
    $results = $db->fetch_all_array();
    print_r($results);*/

    // Make a new Page
    $page = new Page('Public Page', '../styles.css', $content);
    echo $page->toString();
}

function __autoload($className) {
    require_once $className . '.class.php';
}

?>