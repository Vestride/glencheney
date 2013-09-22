<?php
/**
 * @author Glen Cheney
 *
 */
require_once('utils.php');

/**
 *
 * @global mysqli $mysqli
 * @param int $minutes entries more than ($minutes) minutes ago will be deleted
 * @return int number of deleted rows from query
 */
function deleteOldChat($minutes=20) {
    global $mysqli;
    $seconds = $minutes * 60;
    $cutoff = time() - $seconds;
    $cutoff = date("Y-m-d H:i:s", $cutoff);
    
    $sql = "DELETE FROM b_lobbychat WHERE timestamp < '$cutoff'";
    if($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $affected_rows = $stmt->affected_rows;
        $stmt->close();
    }
    return $affected_rows;
}

/**
 * Gets the password of specified (unique) user from the database
 * @global mysqli $mysqli
 * @param string $username
 * @return string sha1'd password from database
 */
function getPasswordFromUser($username) {
    global $mysqli;
    $sql = "SELECT password FROM b_users WHERE username = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($dbPassword);
        $stmt->fetch();
        $stmt->close();
    }
    return $dbPassword;
}

/**
 * Builds an html page with a login form
 * @param string $username fill the text box with the username
 * @param string $msg optional message to be displayed.
 * @return string html page with a login form
 */
function loginForm($username='', $msg='') {
    $content .= "<div id=\"login\">\n";
    $content .= $msg;
    $content .= "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>\n";
    $content .= "\tUsername: <br /><input type='text' placeholder='User name' name='username' value='$username' autofocus /><br />";
    $content .= "\n\tPassword: <br /><input type='password' placeholder='Password' name='password' /><br />";
    $content .= "\n\t<input type='submit' name='login' value='Login' />&nbsp;&nbsp;";
    $content .= "<!--<input type='submit' name='logout' value='Log out' />-->\n";
    $content .= "\n</form>\n";
    $content .= "\n<a href='login.php?type=new'>Register</a>";
    $content .= "</div>\n";
    return page($content);
}

/**
 * Displays a message and a log out button for the user
 * @param string $username optionally tell the user who they are logged in as.
 * @return string html page with a logout button
 */
function logoutForm($username='') {
    if($username == '')
        $msg = "You are currently logged in. Would you like to log out?";
    else
        $msg = "You are currently logged in as <strong>$username</strong>. Would you like to log out?";
    $action = $_SERVER['PHP_SELF'];
    $form = <<<END
<div id="logout">
    $msg
    <br />
    <form action="$action" method="post">
        <input type="submit" name="logout" value="Log out" />
    </form>
    <a href="../battleship/">Back to lobby</a>
</div>
END;
    return page($form);
}

/**
 * Destroys the current session and gives the user the login form again
 * @return string html page with a login form
 */
function logout($username) {
    session_unset();
    session_destroy();
    updateRoom($username, NULL);
    deleteOldChallenges();
    return loginForm('', "You have been logged out");
}

/**
 *
 * @param string $msg optional give the user feedback
 * @param string $username optional populate username textbox's value
 * @param string $email optional populate email textbox's value
 * @return string html page with a add user form
 */
function addUserForm($msg='', $username='', $email='') {
    $action = $_SERVER['PHP_SELF'];
    $form = <<<END
    <div id="newUser">
        $msg
        <form action="$action" method="post">
            Username: <br /><input type="text" placeholder="Username" name="username" value="$username" /><br />
            Password: <br /><input type="password" placeholder="Password" name="password" /><br />
            Repeat Password: <br /><input type="password" placeholder="Password" name="passwordCheck" /><br />
            Email: <br /><input type="email" placeholder="email address" name="email" value="$email" /><br />
            <input type="submit" value="Add User" name="addUser" />
        </form>
    </div>
END;
    return page($form);
}

/**
 *
 * @global mysqli $mysqli
 * @param string $username desired username
 * @param string $password desired password
 * @param string $passwordCheck should be a duplicate of $password
 * @param string $email email address of user
 * @return string html page with a login form or add user form if they screwed up
 */
function addUser($username, $password, $passwordCheck, $email) {
    global $mysqli;
    //Check to make sure nothing is blank
    if ($username == '' || $password == '' || $passwordCheck == '' || $email == '') {
        return addUserForm("All fields are required", $username, $email);
    }
    //Check passwords match
    if ($password != $passwordCheck) {
        return addUserForm("Your passwords don't match", $username, $email);
    }
    //Check if there is not a current same user
    if ($stmt = $mysqli->prepare("SELECT username FROM b_users WHERE username = ?")) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->bind_result($dbUsername);
        $stmt->fetch();
        $stmt->close();
        //Add to db
        if ($dbUsername != $username) {
            //username is unique
            if ($stmt2 = $mysqli->prepare("INSERT INTO b_users VALUES('', ?, ?, ?, '')")) {
                $stmt2->bind_param('sss', $username, $hashword, $email);
                $hashword = sha1($password);
                $stmt2->execute();
                if ($stmt2->affected_rows > 0) {
                    $stmt2->close();
                    return loginForm($username, "You ($username) have been added!");
                } else {
                    $stmt2->close();
                    return "Oops, issa broken.";
                }
            }
        } else {
            //username already in db
            $msg = 'Sorry, ' . $username . ' already exists. Please choose another user name.';
            return addUserForm($msg, '', $email);
        }
    }
}

/**
 * Makes an html page from $content passed by putting it in the body tag
 * @param string $content contents of the html body
 * @return string $content wrapped in an html page
 */
function page($content) {
    return <<<END
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Battleship</title>
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
    <div id="shell">
        <div id="container">
            <h2>Battleship</h2>
            $content
        </div>
    </div>
</body>
</html>
END;
}

?>
