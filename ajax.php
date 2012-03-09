<?php

// es/wordpress/wp-load.php
// es/wordpress/wp-content/themes/vestride/ajax.php
require_once('../../../wp-load.php');

function sendContactMessage($data, $ip) {
    $data = json_decode($data);
    //$data = urldecode($data);
    $errors = vestride_validate_contact_form($data);
    if (empty($errors)) {
        $success = vestride_send_contact_message($data);
        $return = new stdClass();
        $return->success = $success;
        return json_encode($return);
    } else {
        return json_encode($errors);
    }
}



$method = $_REQUEST['method'];
$data = $_REQUEST['data'];


$return = call_user_func($method, stripslashes($data), $_SERVER['REMOTE_ADDR']);
echo $return;

?>
