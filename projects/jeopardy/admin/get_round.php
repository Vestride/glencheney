<?php
if(isset($_GET['round']) && is_numeric($_GET['round']))
    $round = $_GET['round'];
else
    $round = 1;

main();

function main() {
    global $round;
    //$f_round = trim($_REQUEST['round']);

    $db = new Database();

    $content = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $content .= "<data>\n";
    $db->doQuery("SELECT * FROM j_category_set WHERE active = 'yes' AND id='$round'");
    $topics = $db->fetch_all_array();
    foreach($topics as $topic) {
        $content .= "<category_set title=\"{$topic['title']}\" id=\"{$topic['id']}\">\n";
        $db->doQuery("SELECT * FROM j_category WHERE category_set_id='".$topic['id']."'");
        $categories = $db->fetch_all_array();
        foreach($categories as $category) {
            $content .= "\t<category title=\"{$category['title']}\">\n";
            $db->doQuery("SELECT * FROM j_question WHERE category_id = '{$category['id']}'");
            $questions = $db->fetch_all_array();
            foreach($questions as $question) {
                $content .= "\t\t<question value=\"{$question['value']}\">\n";
                $content .= "\t\t\t<q>".stripslashes(trim($question['question']))."</q>\n";
                $content .= "\t\t\t<a>".$question['answer']."</a>\n";
                $content .= "\t\t</question>\n";
            }
            $content .= "\t</category>\n";
        }
        $db->doQuery("SELECT question, answer FROM j_final_question WHERE category_set_id = '{$topic['id']}'");
        $finalQuestion = $db->fetch_array();
        $content .= "\t<final_question>\n";
        $content .= "\t\t<q>".stripslashes($finalQuestion['question'])."</q>\n";
        $content .= "\t\t<a>".$finalQuestion['answer']."</a>\n";
        $content .= "\t</final_question>\n";
        $content .= "</category_set>\n";
    }
    $content .= "</data>";
    header('Content-type: text/xml');
    echo $content;
}

function __autoload($className) {
    require_once $className . '.class.php';
}

?>