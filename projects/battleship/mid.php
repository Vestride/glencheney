<?php

session_name("GBattleship");
session_start();

if (isset($_REQUEST['method']) && isset($_REQUEST['service'])) {
    foreach (glob('./svcLayer/' . $_REQUEST['service'] . '/*.php') as $filename) {
        require_once($filename);
    }
}

$serviceMethod = $_REQUEST['method'];
$data = $_REQUEST['data'];

$result = @call_user_func($serviceMethod, $data, $_SERVER['REMOTE_ADDR'], $_COOKIE['token']);

if ($result) {
    //need to set mime type (text/plain)
    header("Content-Type: text/plain");
    echo $result;
}
?>