<?php
main();

function main() {
    $db = new Database();
    $content = "<h1>Database.class.php Test</h1>";
    $db->doQuery("SELECT * FROM people");
    $peopleArray = $db->fetch_all_array();
    foreach($peopleArray as $person) {
        $firstName = $person['FirstName'];
        $content .= "<p>$firstName</p>";
    }
    

    $page_test = new Page($title = 'Test Page', $stylesheet = '', $content = $content);
    echo $page_test->toString();
}

function __autoload($class) {
    require_once $class.'.class.php';
}

?>
