<?php

require_once './bizLayer/chat.php';
require_once './bizLayer/utils.php';

function getChat($d, $ip, $token) {
    $chat = retrieveChat();
    return $chat;
}

function sendChat($d, $ip, $token) {
    list($username, $message) = explode("|", $d);
    $message = sanitizeString($message);
    if($message != '') {
        postChat($username, $message);
    }
}

function getOnlineUsers($d, $ip, $token) {
    $users = getCurrentUsers();
    return $users;
}

function logoutUser($d, $ip, $token) {
    return userClosedWindow($d);
}

function getPrivateChat($d, $ip, $token) {
    //$d looks like 1|2
    list($challengerId, $challengedId) = explode("|", $d);
    return retrievePrivateChat($challengerId, $challengedId);
}

function sendPrivateChat($d, $ip, $token) {
    //$d looks like 1|2|1|blah
    list($challengerId, $challegedId, $username, $message) = explode("|", $d);
    $message = sanitizeString($message);
    if($message != '') {
        postPrivateChat($challengerId, $challegedId, $username, $message);
    }
}

?>