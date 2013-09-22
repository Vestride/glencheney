<?php

require_once './bizLayer/utils.php';
require_once './bizLayer/game.php';

function getTurn($d, $ip, $token) {
    //$d looks like: game_2|1
    $gameId = explode("_", $d);
    $gameId = $gameId[1];
    return grabTurn($gameId);
}

function changeTurn($d, $ip, $token) {
    //$d looks like: game_2|1!2
    list($gameId, $newTurn) = explode("!", $d);
    $gameIdPieces = explode("_", $gameId);
    $gameId = $gameIdPieces[1];
    return updateTurn($gameId, $newTurn);
}

function createChallenge($d, $ip, $token) {
    //$d looks like:
    list($challenger, $challenged) = explode("|", $d);
    return makeChallenge($challenger, $challenged);
}

function getChallenges($d, $ip, $token) {
    //$d looks like:
    return retrieveChallenges();
}

function changeChallenge($d, $ip, $token) {
    //$d looks like:
    list($challengeId, $status) = explode("|", $d);
    $challengeId = (int)$challengeId;
    return updateChallenge($challengeId, $status);
}

function changeRoom($d, $ip, $token) {
    //$d looks like:
    list($username, $room) = explode("_", $d);
    return updateRoom($username, $room);
}

function submitShips($d, $ip, $token) {
    //$d looks like: game_1|2|2|1|["0_1","0_7","0_8","1_1","2_1","2_3","2_7","3_3","3_7","4_3","4_7","5_3","5_7","6_3","8_4","8_5","8_6"] but with the quotes escaped
    list($gameId, $gameIdPart2, $ships, $guesses, $locations) = explode("|", $d);
    $locations = stripslashes($locations);
    $gameId = explode("_", $gameId);
    $gameId = $gameId[1]."|".$gameIdPart2;
    $locations = json_decode($locations);
    return sendShips($gameId, $ships, $guesses, $locations);
}

function makeGuess($d, $ip, $token) {
    //$d looks like: game_2|1|1|0_0
    list($gameId, $gameIdPart2, $guesses, $square) = explode("|", $d);
    $gameId = explode("_", $gameId);
    $gameId = $gameId[1]."|".$gameIdPart2;
    return updateGameInfoWithGuess($gameId, $guesses, $square);
}

function getTheBoard($d, $ip, $token) {
    //$d looks like: game_2|1!2
    list($gameId, $ships) = explode("!", $d);
    $gameIdPieces = explode("_", $gameId);
    $gameId = $gameIdPieces[1];
    return getBoard($gameId, $ships);
}

function updateLife($d, $ip, $token) {
    //$d looks like: game_2|1!5!4!3!3!2
    list($gameId, $ships, $acc, $battleship, $cruiser, $sub, $destroyer) = explode("!", $d);
    $gameIdPieces = explode("_", $gameId);
    $gameId = $gameIdPieces[1];
    return updateGameInfoWithLife($gameId, $ships, $acc, $battleship, $cruiser, $sub, $destroyer);
}

function sendMessage($d, $ip, $token) {
    //$d looks like: 9|7|heather|You sunk heathers Destroyer|created
    list($challengerId, $challengedId, $createdBy, $message, $status) = explode("|", $d);
    return createMessage($challengerId, $challengedId, $createdBy, $message, $status);
}

function getMessages($d, $ip, $token) {
    //$d looks like: 9|7
    list($challengerId, $challengedId) = explode('|', $d);
    return getNewMessages($challengerId, $challengedId);
}

function changeMessageStatus($d, $ip, $token) {
    //$d looks like: 1|6|3|read
    list($challengerId, $challengedId, $messageId, $status) = explode("|", $d);
    return updateMessageStatus($challengerId, $challengedId, $messageId, $status);
}

function endGame($d, $ip, $token) {
    // $d looks like: 9|7|7
    list($challengerId, $challengedId, $player) = explode("|", $d);
    dropMessagesTable($challengerId, $challengedId);
    dropPrivateChatTable($challengerId, $challengedId);
    dropShipsTable($challengerId, $challengedId);
    deleteMyGameInfo($challengerId, $challengedId, $player);
    deleteGame($challengerId, $challengedId);
}

function quitGame($d, $ip, $token) {
    // $d looks like: 9|7|7
    list($challengerId, $challengedId, $player) = explode("|", $d);
    deleteMyGameInfo($challengerId, $challengedId, $player);
    clearShipsTable($challengerId, $challengedId, $player);
}

function areShipsSet($d, $ip, $token) {
    // $d looks like: 9|7|7
    list($challengerId, $challengedId, $player2) = explode("|", $d);
    return gameInfoRowExists($challengerId, $challengedId, $player2);
}

function shipLocations($d, $ip, $token) {
    //$d looks like: 6!8!8!2_3|true!2_7|true!8_4|false!0_1|true!0_7|false
    list($challengerId, $challengedId, $playerId, $acc, $battleship, $cruiser, $submarine, $destroyer) = explode("!", $d);
    return populateShipsTable($challengerId, $challengedId, $playerId, $acc, $battleship, $cruiser, $submarine, $destroyer);
}

function getShipLocations($d, $ip, $token) {
    //$d looks like
    list($challengerId, $challengedId, $playerId) = explode("|", $d);
    return getShipsTable($challengerId, $challengedId, $playerId);
}

function currentGames($d, $ip, $token) {
    return getCurrentGames();
}
?>