<?php

/**
 * @author Glen Cheney
 */
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
 * Creates a challenge in the database
 * @global mysqli $mysqli
 * @param int $challenger challenger's id
 * @param int $challenged challened person's id
 * @return int number of updated rows
 */
function makeChallenge($challenger, $challenged) {
    global $mysqli;

    if ($stmt = $mysqli->prepare("INSERT INTO b_challenges VALUES('', ?, ?, 'created')")) {
        $stmt->bind_param('ii', $challenger, $challenged);
        $stmt->execute();
        $updatedRows = $stmt->affected_rows;
        $stmt->close();
        return $updatedRows;
    } else {
        return 'Unable to prepare statment';
    }
}

/**
 * Gets all the challenges from the database and returns json
 * @global mysqli $mysqli
 * @return json json object of all the challenges
 */
function retrieveChallenges() {
    global $mysqli;

    $query = "SELECT challengeId, challenger, challenged, status, b_users.username as challenger_name FROM b_challenges JOIN b_users ON b_challenges.challenger = b_users.id";
    if ($result = $mysqli->query($query)) {
        $challenges = array();
        while ($row = $result->fetch_assoc()) {
            $challenges[] = $row;
        }
        $result->free();
        return json_encode($challenges);
    } else {
        return 'No result';
    }
}

/**
 * Changes the status of a challenge in the database
 * @global mysqli $mysqli
 * @param int $challengeId unique id of challenge in db
 * @param string $status new challenge status
 * @return int number of updated rows
 */
function updateChallenge($challengeId, $status) {
    global $mysqli;

    $sql = "UPDATE `b_challenges` SET `status` = ? WHERE `challengeId` = ?;";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("si", $status, $challengeId);
        $stmt->execute();
        $updatedRows = $stmt->affected_rows;
        $stmt->close();
        return $updatedRows;
    } else {
        return 'Unable to prepare statment';
    }
}

/**
 * Creates a table in my databas with 104 fields. They look like cell0_0, cell0_1
 * @global mysqli $mysqli
 */
function createGameTable() {
    global $mysqli;

    $sql = "CREATE TABLE b_gameInfo\n
(\n
   id SMALLINT NOT NULL,\n
   gameId VARCHAR (10) NOT NULL,\n
   ships INT(11) NOT NULL,\n
   guesses INT(11) NOT NULL,\n";

    for ($i = 0; $i < 10; $i++) {
        for ($j = 0; $j < 10; $j++) {
            $sql .= " cell" . $i . "_" . $j . " VARCHAR(40) NOT NULL DEFAULT '0_0'";
            if ($i == 9 && $j == 9)
                $sql .= "\n";
            else {
                $sql .= ",\n";
            }
        }
    }

    $sql .= ")";

    $mysqli->query($sql);
}

/**
 * Creates a new table in the database for messages back and forth
 * @global mysqli $mysqli
 * @param string $gameId ex. "1|2"
 */
function createMessagesTable($player1Id, $player2Id) {
    global $mysqli;

    $sql = "CREATE TABLE IF NOT EXISTS b_messages".$player1Id."_".$player2Id."
        (
            `messageId` int NOT NULL auto_increment,
            PRIMARY KEY(`messageId`),
            `createdBy` varchar(20) NOT NULL,
            `message` varchar(100) NOT NULL,
            `status` varchar(20) NOT NULL
        )";
    
    $mysqli->query($sql);
}

/**
 * Inserts a row into the messages table
 * @global mysqli $mysqli
 * @param int $challengerId
 * @param int $challengedId
 * @param string $createdBy username
 * @param string $message
 * @param string $status
 * @return int inserted rows
 */
function createMessage($challengerId, $challengedId, $createdBy, $message, $status) {
    global $mysqli;

    $table = "b_messages".$challengerId."_".$challengedId;

    $sql = "INSERT INTO $table VALUES('', ?, ?, ?)";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('sss', $createdBy, $message, $status);
        $stmt->execute();
        $insertedRows = $stmt->affected_rows;
        $stmt->close();
        return $insertedRows;
    }
    else {
        return -1;
    }
}

/**
 * Gets all messages from messages table that are not "read"
 * @global mysqli $mysqli
 * @param int $challengerId
 * @param int $challengedId
 * @return json object
 */
function getNewMessages($challengerId, $challengedId) {
    global $mysqli;

    $obj = new stdClass();

    $table = "b_messages".$challengerId."_".$challengedId;
    $sql = "SELECT * FROM $table WHERE status != 'read'";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($messageId, $createdBy, $message, $status);
        $count = 0;
        while($stmt->fetch()) {
            $obj->$count->messageId = $messageId;
            $obj->$count->createdBy = $createdBy;
            $obj->$count->message = stripslashes($message);
            $obj->$count->status = $status;
            $count++;
        }
        $stmt->close();
        return json_encode($obj);
    }
    else {
        return -1;
    }

}

/**
 * Updates the status of a message in the messages table
 * @global mysqli $mysqli
 * @param int $challengerId
 * @param int $challengedId
 * @param int $messageId
 * @param string $status
 * @return int affected rows from query
 */
function updateMessageStatus($challengerId, $challengedId, $messageId, $status) {
    global $mysqli;

    $table = "b_messages".$challengerId."_".$challengedId;
    $sql = "UPDATE $table SET status = ? WHERE messageId = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('si', $status, $messageId);
        $stmt->execute();
        $updatedRows = $stmt->affected_rows;
        $stmt->close();
        return $updatedRows;
    }
    else {
        return -1;
    }
}

/**
 * Deletes the dynamically created messages table
 * @global mysqli $mysqli
 * @param int $challengerId
 * @param int $challengedId
 */
function dropMessagesTable($challengerId, $challengedId) {
    global $mysqli;

    $table = "b_messages".$challengerId."_".$challengedId;

    $sql = "DROP TABLE `$table`";
    $mysqli->query($sql);
}

/**
 * Deletes the player's row in the b_gameInfo table
 * @global mysqli $mysqli
 * @param int $challengerId
 * @param int $challengedId
 * @param int $player
 * @return int affected rows from query
 */
function deleteMyGameInfo($challengerId, $challengedId, $player) {
    global $mysqli;

    $gameId = $challengerId."|".$challengedId;

    $sql = "DELETE FROM b_gameInfo WHERE gameId = ? AND ships = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('si', $gameId, $player);
        $stmt->execute();
        $updatedRows = $stmt->affected_rows;
        $stmt->close();
        return $updatedRows;
    }
    else {
        return -1;
    }
}

/**
 * Deletes a game from the b_games table based on gameId
 * @global mysqli $mysqli
 * @param int $challengerId
 * @param int $challengedId
 * @return int affected rows from query
 */
function deleteGame($challengerId, $challengedId) {
    global $mysqli;

    $gameId = $challengerId."|".$challengedId;

    $sql = "DELETE FROM b_games WHERE gameId = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('s', $gameId);
        $stmt->execute();
        $updatedRows = $stmt->affected_rows;
        $stmt->close();
        return $updatedRows;
    }
    else {
        return -1;
    }
}
/**
 * Creates a new row in the database for this game
 * @global mysqli $mysqli
 * @param int $oneId player 1's id
 * @param int $twoId player 2's id
 * @param int $t whose turn to start the game off as
 * @return int number of updated rows in the database
 */
function createGame($oneId, $twoId, $t) {
    global $mysqli;

    $oneId = (int) $oneId;
    $twoId = (int) $twoId;
    $t = (int) $t;

    if ($stmt = $mysqli->prepare("INSERT INTO b_games VALUES('', ?, ?, ?, ?)")) {
        $stmt->bind_param('siii', $gameId, $oneId, $twoId, $t);
        $gameId = $oneId . "|" . $twoId;
        $stmt->execute();
        $updatedRows = $stmt->affected_rows;
        $stmt->close();
        return $updatedRows;
    } else {
        return "Unable to prepare statement";
    }
}

/**
 * Looks for the $gameId in the db and returns true if it finds it, false otherwise
 * @global mysqli $mysqli
 * @param string $gameId
 * @return boolean game exists or not
 */
function gameExists($gameId) {
    global $mysqli;

    if ($stmt = $mysqli->prepare("SELECT gameId FROM b_games WHERE gameId = ?")) {
        $stmt->bind_param('s', $gameId);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows();
        $stmt->close();
        if ($num_rows > 0)
            return true;
        else
            return false;
    }
}

/**
 * Inserts a row into the b_gameInfo table to display ship and guess locations
 * @global mysqli $mysqli
 * @param string $gameId gameId (ex. "8|6")
 * @param int $ships player id of whose ships we're using
 * @param int $guesses player id of whose guesses we're using
 * @param array $locations locations of the ships (ex. "0_5", "0_6", etc)
 * @return boolean query succeeded
 */
function sendShips($gameId, $ships, $guesses, $locations) {
    global $mysqli;
    
    //Build a string that looks like: INSERT INTO b_gameInfo (id, gameId, ships, guesses, cell0_0, cell0_1) VALUES('', $gameId, $ships, $guesses, '1_0', '1_0')
    $sql = "INSERT INTO b_gameInfo (id, gameId, ships, guesses, ";
    foreach ($locations as $location) {
        $sql .= "cell$location, ";
    }
    $sql = substr($sql, 0, -2);
    $sql .= ") VALUES('', '$gameId', $ships, $guesses, ";

    foreach ($locations as $location) {
        $sql .= "'1_0', ";
    }

    $sql = substr($sql, 0, -2);
    $sql .= ")";

    if ($mysqli->query($sql) === true)
        return 1;
    else
        return 0;
}

/**
 *
 * @global mysqli $mysqli
 * @param string $gameId ex. "2|1"
 * @return json with gameId and turn
 */
function grabTurn($gameId, $json = true) {
    global $mysqli;

    $obj = new stdClass();
    $obj->gameId = $gameId;

    //For some reason, doing a prepared statement here completely broke...
    $sql = "SELECT turn FROM b_games WHERE gameId = '$gameId'";
    if($result = $mysqli->query($sql)) {
        $row = $result->fetch_object();
        $obj->turn = $row->turn;
        if($json) {
            return json_encode($obj);
        } else {
            return $obj->turn;
        }
    }
    else {
        return "Unable to prepare statment";
    }
}

/**
 * Changes the turn field in b_games to $turn
 * @global mysqli $mysqli
 * @param string $gameId gameId (ex. "8|6")
 * @param int $turn id of the person whose turn it should be
 * @return int number of affected rows from update
 */
function updateTurn($gameId, $turn) {
    global $mysqli;

    $turn = (int)$turn;
    $sql = "UPDATE b_games SET turn = ? WHERE gameId = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('is', $turn, $gameId);
        $stmt->execute();
        $updatedRows = $stmt->affected_rows;
        $stmt->close();
        return $updatedRows;
    }
    else
        return "Unable to prepare statment";
}

/**
 * updates the table to reflect the player's guess
 * @global mysqli $mysqli
 * @param string $gameId e.g. "8|6"
 * @param int $guesses person's id who is guessing
 * @param string $square cell they're guessing
 * @return json object with properties: cell, oldValue, newValue, affectedRows, hit
 */
function updateGameInfoWithGuess($gameId, $guesses, $square) {
    global $mysqli;

    $obj = new stdClass();
    $obj->cell = $square;
    $square = "cell$square";

    //Grab the current value from the database
    $query = "SELECT $square FROM b_gameInfo WHERE gameId = ? AND guesses = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('si', $gameId, $guesses);
        $stmt->execute();
        $stmt->bind_result($square_value);
        $stmt->fetch();
        $stmt->close();

        //Split apart the current value and concat our guess. $square_value looks like "1_0" or "0_0"
        $pieces = explode("_", $square_value);
        $new_value = $pieces[0] . "_1";

        //Save these values to return them
        if ($pieces[0] != "0") {
            //if it's not zero, there was a ship there
            $obj->hit = true;
        } else {
            $obj->hit = false;
        }
        $obj->oldValue = $square_value;
        $obj->newValue = $new_value;

        //Update table with new value
        if ($stmt2 = $mysqli->prepare("UPDATE b_gameInfo SET $square = ? WHERE gameId = ? AND guesses = ?")) {
            $stmt2->bind_param('ssi', $new_value, $gameId, $guesses);
            $stmt2->execute();
            $obj->affected_rows = $stmt2->affected_rows;
            $stmt2->close();
            return json_encode($obj);
        } else {
            return "Unable to prepare statment 2";
        }
    } else {
        return "Unable to prepare statment";
    }
}

/**
 * Updates table with the amount of life left in each ship
 * @global mysqli $mysqli
 * @param string $gameId
 * @param int $ships
 * @param int $acc
 * @param int $battleship
 * @param int $cruiser
 * @param int $sub
 * @param int $destroyer
 * @return json
 */
function updateGameInfoWithLife($gameId, $ships, $acc, $battleship, $cruiser, $sub, $destroyer) {
    global $mysqli;

    $obj = new stdClass();
    $ships = (int)$ships;
    $acc = (int)$acc;
    $battleship = (int)$battleship;
    $cruiser = (int)$cruiser;
    $sub = (int)$sub;
    $destroyer = (int)$destroyer;

    $obj->aircraftCarrier = $acc;
    $obj->battleship = $battleship;
    $obj->cruiser = $cruiser;
    $obj->submarine = $sub;
    $obj->destroyer = $destroyer;

    $sql = "UPDATE b_gameInfo SET aircraft_carrier_life = ?, battleship_life = ?, cruiser_life = ?, submarine_life = ?, destroyer_life = ? WHERE gameId = '$gameId' AND ships = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('iiiiii', $acc, $battleship, $cruiser, $sub, $destroyer, $ships);
        $stmt->execute();
        $obj->affected_rows = $stmt->affected_rows;
        $stmt->close();
        return json_encode($obj);
    } else {
        return "Unable to prepare statment ";
    }
}

/**
 * Gets all 100 cells in the battleship game and the amount of life left in each ship
 * Cells have a value of ship_guess where ship = 0 or 1 and guess = 0 or 1
 * @global mysqli $mysqli
 * @param string $gameId
 * @param int $ships userId that the board will be taken from
 * @return json encoded array
 */
function getBoard($gameId, $ships) {
    global $mysqli;

    $sql = "SELECT * FROM b_gameInfo WHERE gameId = '$gameId' AND ships = $ships";
    //Binding results for 104 rows would be a pain in the ass. So no prepared statement.
    if ($result = $mysqli->query($sql)) {
        $row = $result->fetch_assoc();
        $cells = array();
        $count = 0;
        foreach($row as $cell => $value) {
            if ($cell == 'id' || $cell == 'gameId' || $cell == 'ships' || $cell == 'guesses') {
                continue;
            }
            elseif ($cell == 'aircraft_carrier_life' || $cell == 'battleship_life'
                    || $cell == 'cruiser_life'
                    || $cell == 'submarine_life'
                    || $cell == 'destroyer_life'
            ) {
                $cells[$count] = $value;
                $count++;
            }
            else {
                // cell = cell0_0
                $cell = substr($cell, 4);
                // cell = 0_0
                list($i, $j) = explode("_", $cell);
                // i = 0 and j = 0
                // value = 0_1
                $value = $value."|".$i."|".$j;
                // value = 0_1|0|0
                $cells[$count] = $value;
                $count++;
            }
        }
        return json_encode($cells);
    }
}

/**
 * Finds out if there is already a row in the table. AKA the ships are set.
 * @global mysqli $mysqli
 * @param int $challengerId
 * @param int $challengedId
 * @param int $player
 * @return boolean
 */
function gameInfoRowExists($challengerId, $challengedId, $player) {
    global $mysqli;

    $gameId = $challengerId . "|" . $challengedId;

    if ($stmt = $mysqli->prepare("SELECT gameId FROM b_gameInfo WHERE gameId = ? AND ships = ?")) {
        $stmt->bind_param('si', $gameId, $player);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows();
        $stmt->close();
        if ($num_rows > 0)
            return true;
        else
            return false;
    }
    else {
        return -1;
    }
}

function createPrivateChatTable($challengerId, $challengedId) {
    global $mysqli;

    $sql = "CREATE TABLE IF NOT EXISTS `b_privatechat".$challengerId."_".$challengedId."`
        (
            `msgId` int(11) NOT NULL auto_increment,
            `username` varchar(20) NOT NULL,
            `message` varchar(250) NOT NULL,
            `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
            PRIMARY KEY  (`msgId`)
        )";

    $mysqli->query($sql);
}

function dropPrivateChatTable($challengerId, $challengedId) {
    global $mysqli;

    $table = "b_privatechat".$challengerId."_".$challengedId;

    $sql = "DROP TABLE `$table`";
    $mysqli->query($sql);
}

function createShipsTable($challengerId, $challengedId) {
    global $mysqli;

    //@todo drop table if exists $table

    $sql = "CREATE TABLE IF NOT EXISTS `b_ships".$challengerId."_".$challengedId."`
        (
            `entryId` int(11) NOT NULL auto_increment,
            `playerId` int(11) NOT NULL,
            `aircraft_carrier` varchar(10) NOT NULL,
            `battleship` varchar(10) NOT NULL,
            `cruiser` varchar(10) NOT NULL,
            `submarine` varchar(10) NOT NULL,
            `destroyer` varchar(10) NOT NULL,
            PRIMARY KEY  (`entryId`)
        )";

    $mysqli->query($sql);
}

/**
 * Fields contain startRow_startCol|vertical
 * @global mysqli $mysqli
 * @param <type> $challengerId
 * @param <type> $challengedId
 * @param <type> $playerId
 * @param <type> $acc
 * @param <type> $battleship
 * @param <type> $cruiser
 * @param <type> $submarine
 * @param <type> $destroyer
 * @return <type>
 */
function populateShipsTable($challengerId, $challengedId, $playerId, $acc, $battleship, $cruiser, $submarine, $destroyer) {
    global $mysqli;

    $table = "b_ships".$challengerId."_".$challengedId;

    $sql = "INSERT INTO $table VALUES('', ?, ?, ?, ?, ?, ?)";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('isssss', $playerId, $acc, $battleship, $cruiser, $submarine, $destroyer);
        $stmt->execute();
        $updatedRows = $stmt->affected_rows;
        $stmt->close();
        return $updatedRows;
    }
    else {
        return -2;
    }
}

function getShipsTable($challengerId, $challengedId, $playerId) {
    global $mysqli;

    $table = "b_ships".$challengerId."_".$challengedId;

    $response = new stdClass();

    $sql = "SELECT * FROM $table WHERE playerId = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('i', $playerId);
        $stmt->execute();
        $stmt->bind_result($id, $playerId, $acc, $battleship, $cruiser, $submarine, $destroyer);
        $stmt->fetch();
        $stmt->close();

        list($a_cell, $a_vertical) = explode("|", $acc);
        list($b_cell, $b_vertical) = explode("|", $battleship);
        list($c_cell, $c_vertical) = explode("|", $cruiser);
        list($s_cell, $s_vertical) = explode("|", $submarine);
        list($d_cell, $d_vertical) = explode("|", $destroyer);

        $response->AircraftCarrier->cell = $a_cell;
        $response->AircraftCarrier->vertical = $a_vertical;
        $response->AircraftCarrier->type = "AircraftCarrier";
        $response->Battleship->cell = $b_cell;
        $response->Battleship->vertical = $b_vertical;
        $response->Battleship->type = "Battleship";
        $response->Cruiser->cell = $c_cell;
        $response->Cruiser->vertical = $c_vertical;
        $response->Cruiser->type = "Cruiser";
        $response->Submarine->cell = $s_cell;
        $response->Submarine->vertical = $s_vertical;
        $response->Submarine->type = "Submarine";
        $response->Destroyer->cell = $d_cell;
        $response->Destroyer->vertical = $d_vertical;
        $response->Destroyer->type = "Destroyer";

        return json_encode($response);
    }
}

function clearShipsTable($challengerId, $challengedId, $playerId) {
    global $mysqli;

    $table = "b_ships".$challengerId."_".$challengedId;

    $sql = "DELETE FROM $table WHERE playerId = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('i', $playerId);
        $stmt->execute();
        $deletedRows = $stmt->affected_rows;
        $stmt->close();
        return $deletedRows;
    }
    else {
        return -2;
    }
}

function dropShipsTable($challengerId, $challengedId) {
    global $mysqli;

    $table = "b_ships".$challengerId."_".$challengedId;

    $sql = "DROP TABLE `$table`";
    $mysqli->query($sql);
}

?>