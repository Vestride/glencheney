<?php
session_start();
session_unset();
session_destroy();
$logout = new Page("Logged out", '../styles.css', "<div id='container'>You have been logged out. <a href=\"login.php\">Log back in?</a></div>");
echo $logout->toString();
function __autoload($class) {
    require_once $class.'.class.php';
}
?>