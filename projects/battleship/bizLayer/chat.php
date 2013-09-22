<?php

define('DBHOST', 'glencheneycom.ipagemysql.com');
define('DBUSERNAME', 'gec5190');
define('DBPASSWORD', 'FourOhNine');
define('DB', 'gec5190');
$mysqli = new mysqli(DBHOST, DBUSERNAME, DBPASSWORD, DBUSERNAME);

/* check connection */
if (mysqli_connect_errno ()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/**
 * gets the last 15 chat entries from the database
 * @global mysqli $mysqli
 * @return json last 15 chat entries
 */
function retrieveChat() {
    //Hook into db
    global $mysqli;
    if ($result = $mysqli->query("SELECT * FROM b_lobbychat ORDER BY timestamp DESC LIMIT 15")) {
        $chat = array();
        while ($line = $result->fetch_object()) {
            $line->timestamp = date('g:i:s', strtotime($line->timestamp));
            $line->message = stripslashes($line->message);
            $chat[] = $line;
        }
        $result->close();
    } else {
        $chat = null;
    }
    $mysqli->close();
    //return json object to getChat function
    return json_encode($chat);
}

/**
 * inserts a line of chat into the database
 * @global mysqli $mysqli
 * @param string $username person who sent the message
 * @param string $message message
 * @return int affected rows from insert
 */
function postChat($username, $message) {
    global $mysqli;
    if($stmt = $mysqli->prepare("INSERT INTO b_lobbychat VALUES('', ?, ?, CURRENT_TIMESTAMP)")) {
        $stmt->bind_param('ss', $username, $message);
        $stmt->execute();
        $affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $affected_rows;
    }
}

function getCurrentUsers() {
    global $mysqli;
    $query = "SELECT `id`, `username`, `email`, `room` FROM b_users";
    if($result = $mysqli->query($query)) {
        $users = array();
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return json_encode($users);
    } else {
        return false;
    }
}


/**
 * gets the last 15 chat entries from the database
 * @global mysqli $mysqli
 * @return json last 15 chat entries
 */
function retrievePrivateChat($challengerId, $challengedId) {
    global $mysqli;

    $table = "b_privatechat".$challengerId."_".$challengedId;

    if ($result = $mysqli->query("SELECT * FROM $table ORDER BY timestamp DESC LIMIT 15")) {
        $chat = array();
        while ($line = $result->fetch_object()) {
            $line->timestamp = date('g:i:s', strtotime($line->timestamp));
            $line->message = stripslashes($line->message);
            $chat[] = $line;
        }
        $result->close();
    } else {
        $chat = null;
    }
    $mysqli->close();
    //return json object to getChat function
    return json_encode($chat);
}

/**
 * inserts a line of chat into the database
 * @global mysqli $mysqli
 * @param string $username person who sent the message
 * @param string $message message
 * @return int affected rows from insert
 */
function postPrivateChat($challengerId, $challengedId, $username, $message) {
    global $mysqli;

    $table = "b_privatechat".$challengerId."_".$challengedId;

    if($stmt = $mysqli->prepare("INSERT INTO $table VALUES('', ?, ?, CURRENT_TIMESTAMP)")) {
        $stmt->bind_param('ss', $username, $message);
        $stmt->execute();
        $affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $affected_rows;
    }
}

?>
