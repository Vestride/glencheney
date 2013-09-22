<?php

/**
 *  Gets the desired user from the database
 * @global mysqli $mysqli
 * @param string $username user to get info about
 * @return stdClass $user. Has properties username, id, and email
 */
function getUser($username) {
    global $mysqli;

    $sql = "SELECT id, username, email FROM b_users WHERE username = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($id, $username, $email);
        $stmt->fetch();
        $stmt->close();

        $user = new stdClass();
        $user->username = $username;
        $user->id = $id;
        $user->email = $email;

        return $user;
    }
    else
        return 'Unable to prepare statement';
}

/**
 *  Gets the desired user from the database by their id
 * @global mysqli $mysqli
 * @param int $id user to get info about
 * @return stdClass $user. Has properties username, id, and email
 */
function getUserById($user_id) {
    global $mysqli;

    $sql = "SELECT id, username, email FROM b_users WHERE id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->bind_result($id, $username, $email);
        $stmt->fetch();
        $stmt->close();

        $user = new stdClass();
        $user->username = $username;
        $user->id = $id;
        $user->email = $email;

        return $user;
    }
    else
        return 'Unable to prepare statement';
}

/**
 * Changes the room that the current user is in
 * @global mysqli $mysqli connection
 * @param string $username username to log out
 * @param string $room null = logged out, 0 = lobby, anything else is the game room they are in
 * @return int affected rows from update
 */
function updateRoom($username, $room) {
    global $mysqli;

    $response = new stdClass();
    $response->username = $username;
    $response->newRoom = $room;
    if(strpos($room, "|") !== false) {
        list($challengerId, $challengedId) = explode("|", $room);
        $response->challengerId = $challengerId;
        $response->challengedId = $challengedId;
    }
    
    $sql = "UPDATE b_users SET room = ? WHERE username = ?";
    if($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('ss', $room, $username);
        $stmt->execute();
        $response->affected_rows = $stmt->affected_rows;
        $stmt->close();
    }
    else {
        $response->affected_rows = "Unable to prepare statement";
    }
    return json_encode($response);
}

function userClosedWindow($username) {
    $int = updateRoom($username, NULL);
    session_unset();
    session_destroy();
    $_SESSION['username'] = null;
    $_SESSION['auth_user'] = null;
    return $_SESSION['auth_user'];
}

/**
 * sets a cookie that looks like: ip|time
 */
function setCookieToken() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $time = time();
    $token = $ip."|".$time;
    $expire = time() + 60 * 60 * 24; //24 hours from now
    $path = "/~gec5190/";
    $domain = "nova.it.rit.edu";
    setcookie("token", $token, $expire, $path, $domain);
}

function deleteOldChallenges() {
    global $mysqli;

    $sql = "DELETE FROM b_challenges WHERE status = 'delete' OR status = 'ingame'";
    $mysqli->query($sql);
    return $mysqli->affected_rows;
}

/**
 * Parses the client's browser's user agent string.
 * returns an array of the user's browser, browser version, os, os version and ip
 *
 * @return object
 */
function getBrowserInfo() {
    //IP
    $ip_address = $_SERVER['REMOTE_ADDR'];
    //User agent
    $ua = $_SERVER['HTTP_USER_AGENT'];

    $browser = new stdClass();
    $browser->ip = $ip_address;

    //OS
    $os = '';
    $os_version = '';
    if (stripos($ua, "windows")) {
        $os = "Windows";
        if (stripos($ua, "Windows NT 6.1"))
            $os_version = "7";
        else if (stripos($ua, "Windows NT 6.0"))
            $os_version = "Vista";
        else if (stripos($ua, "Windows NT 5.1"))
            $os_version = "XP";
        else
            $os_version = "Unknown";
    }
    else if (stripos($ua, "mac"))
        $os = "Mac";
    else if (stripos($ua, "linux"))
        $os = "Linux";
    else
        $os = "Unknown";

    $browser->os = $os;
    $browser->os_version = $os_version;

    //Browser
    $browserName = '';
    $browser_version = '';
    if (stripos($ua, "firefox")) {
        $browserName = "Firefox";
        $pos = strripos($ua, "Firefox/");
        $pos = $pos + 8;
        $browser_version = substr($ua, $pos);
    } else if (stripos($ua, "chrome")) {
        $browserName = "Chrome";
        $pos = strripos($ua, "Chrome/");
        $pos = $pos + 7;
        $browser_version = substr($ua, $pos, 10);
    } else if (stripos($ua, "safari")) {
        $browserName = "Safari";
        $pos = strripos($ua, "Version/");
        $pos = $pos + 8;
        $browser_version = substr($ua, $pos, 3);
    } else if (stripos($ua, "Presto")) {
        $browserName = "Opera";
        $pos = strripos($ua, "Version/");
        $pos = $pos + 8;
        $browser_version = substr($ua, $pos, 5);
    } else if (stripos($ua, "MSIE")) {
        $browserName = "Internet Explorer";
        $pos = strripos($ua, "MSIE ");
        $pos = $pos + 5;
        $browser_version = substr($ua, $pos, 3);
    }
    else
        $browserName = "Unknown";

    $browser->name = $browserName;
    $browser->version = $browser_version;

    return $browser;
}

function isBrowserTooOld() {
    $browser = getBrowserInfo();
    switch($browser->name) {
        case "Firefox":
            if($browser->version < 3.6) {
                return true;
            }
            else {
                return false;
            }
        case "Chrome":
            if($browser->version < 9) {
                return true;
            }
            else {
                return false;
            }
        case "Internet Explorer":
            if($browser->version <= 9.0) {
                return true;
            }
            else {
                return false;
            }
        case "Opera":
            if($browser->version < 11) {
                return true;
            }
            else {
                return false;
            }
        case "Safari":
            if($browser->version < 5) {
                return true;
            }
            else {
                return false;
            }
        default:
            return true;
            break;
    }
}

/**
 *  Cleans an input string
 * @param string $str
 * @return string sanitized
 */
function sanitizeString($str) {
    $blacklist = array("/`/", "/'/", "/</", "/>/", '/"/', "/%/", "/\(/", "/\)/", "/\\\/", "/\//", "/\_/", "/\|/");
    $str = htmlentities($str);
    $str = strip_tags($str);
    $str = stripslashes($str);
    $str = preg_replace($blacklist, "", $str);
    $str = trim($str);
    return $str;
}

function getCurrentGames() {
    global $mysqli;
    
    $response = new stdClass();

    $sql = "SELECT * FROM b_games";
    if ($result = $mysqli->query($sql)) {
        if ($result->num_rows > 0) {
            $games = array();
            while ($row = $result->fetch_object()) {
                $games[] = $row; //$row has gameId, player1, player2, turn
            }
            $count = 0;
            foreach ($games as $game) {
                $response->$count->gameId = $game->gameId;
                $query = "SELECT ships, aircraft_carrier_life, battleship_life, cruiser_life, submarine_life, destroyer_life, b_users.username
                        FROM b_gameInfo
                        JOIN b_users ON b_gameInfo.ships = b_users.id
                        WHERE (ships = ? OR ships = ?) AND gameId = '$game->gameId'";
                if ($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_param('ii', $game->player1, $game->player2);
                    $stmt->execute();
                    $stmt->bind_result($playerId, $acc, $battleship, $cruiser, $submarine, $destroyer, $username);
                    while ($stmt->fetch()) {
                        $response->$count->$username->AircraftCarrier = $acc;
                        $response->$count->$username->Battleship = $battleship;
                        $response->$count->$username->Cruiser = $cruiser;
                        $response->$count->$username->Submarine = $submarine;
                        $response->$count->$username->Destroyer = $destroyer;
                    }
                    $stmt->close();
                } else {
                    return "Unable to prepare statement for $game->gameId";
                }
                $count++;
            }
        } else {
            $response = false;
        }
        $result->close();
    }
    else {
        return "Unable to query";
    }

    return json_encode($response);
}
?>
