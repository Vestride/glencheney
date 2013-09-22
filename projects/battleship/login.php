<?php

require_once('../../db.php');
require_once('./bizLayer/loginFunctions.php');
require_once('./bizLayer/utils.php');

if(isBrowserTooOld()) {
    header("Location:redirect.php");
}

session_name('GBattleship');
session_start();

foreach($_POST as &$post) {
    $post = sanitizeString($post);
}

//Check log in credentials
if (isset($_POST['login'])) {
    //User clicked login button
    if (sha1($_POST['password']) == getPasswordFromUser($_POST['username'])) {
        //Passwords match. Log them in and redirect them.
        $_SESSION['auth_user'] = true;
        $_SESSION['username'] = $_POST['username'];
        deleteOldChat();
        updateRoom($_SESSION['username'], 0);
        setCookieToken();
        header("Location:index.php");
    } else {
        //Password mismatch. Try again.
        echo loginForm($_POST['username'], '<span style="color: red;">Incorrect login</span>');
    }
} else if (isset($_GET['type']) && $_GET['type'] == 'new') {
    //User clicked register
    echo addUserForm();
} else if (isset($_POST['addUser'])) {
    //New user form has been submitted
    echo addUser($_POST['username'], $_POST['password'], $_POST['passwordCheck'], $_POST['email']);
}
else if(isset($_POST['logout']) || isset($_GET['logout'])) {
    //Logout form has been submitted
    echo logout($_SESSION['username']);
}
else if(isset($_SESSION['auth_user'])) {
    //User has come back to login page while logged in
    echo logoutForm($_SESSION['username']);
}
else {
    //User's first time
    echo loginForm();
}

$mysqli->close();



?>