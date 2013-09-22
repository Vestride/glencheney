<?php

main();

function main() {

    $db = new Database();

    $content = "<data>\n";
    $db->doQuery("SELECT id, name, title, active FROM j_category_set WHERE active='yes'");
    $rounds = $db->fetch_all_array();
    foreach($rounds as $round) {
        $content .= "<category_set id='{$round['id']}' title='{$round['title']}' />\n";
    }
    $content .= "</data>\n";
    header('Content-type: text/xml');
    echo $content;
}

// end main

function __autoload($className) {
    require_once $className . '.class.php';
}

?>