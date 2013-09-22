<?php

session_start();

if (!isset($_SESSION['auth_user']))
    header("Location:login.php");
else
    if($_SESSION['auth_user'] == true)
        header("Location:admin.php");
?>
