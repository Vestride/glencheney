<?php
session_start();

if(isset($_POST['login'])) {
    $expire = time() + 60 * 60 * 24; //24 hours from now
    $path = "/~gec5190/";
    $domain = "nova.it.rit.edu";
    $username = $_POST['username'];
    setcookie("username", $username, $expire, $path, $domain);

    $_SESSION['username'] = $username;
    
    $db = new Database();
    $sql = "SELECT password FROM j_user WHERE username = ?";
    $db->doQuery($sql, array($username), array('s'));
    $results = $db->fetch_array();
    if ($db->getError() == '' && sha1($_POST['password']) == $results['password']) {
        $_SESSION['auth_user'] = true;
        header("Location:admin.php");
    }
    else {
        $msg = '<span style="color: red;">Incorrect login</span>';
        echo login($username, $msg);
    }
}
else if(isset($_POST['logout']))
    header("Location:logout.php");
else {
    if(isset($_COOKIE['username']))
        $username = $_COOKIE['username'];
    else
        $username = '';
    echo login($username);
}


function login($username='', $msg='') {
    $content = "<div id='container'>\n";
    $content .= "<div id=\"login\">\n";
    $content .= $msg;
    $content .= "<form action='".$_SERVER['PHP_SELF']."' method='post'>\n";
    $content .= "\tUserID: <input type='text' placeholder='User name' name='username' value='$username' /><br />";
    $content .= "\n\tPassword: <input type='password' placeholder='Password' name='password' /><br />";
    $content .= "\n\t<input type='submit' name='login' value='Login' />&nbsp;&nbsp;";
    $content .= "<input type='submit' name='logout' value='Log out' />\n";
    $content .= "\n</form>\n";
    $content .= "</div>\n";
    $content .= "</div>\n";
    $login = new Page("Login", "../styles.css", $content);
    return $login->toString();
}

function __autoload($class) {
    require_once $class.'.class.php';
}
?>
