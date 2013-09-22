<?php

session_name('GBattleship');
session_start();

if (!isset($_SESSION['auth_user']) || $_SESSION['auth_user'] == null)
    header("Location:login.php");
else {
    if ($_SESSION['auth_user'] == true) {
        //@todo check to make sure the user is who they say they are
        require_once('../../db.php');
        require_once('./bizLayer/utils.php');
        require_once('./bizLayer/game.php');
        require_once('./svcLayer/game/gameUtil.php');

        //Redirect older browsers
        if(isBrowserTooOld()) {
            header("Location:redirect.php");
        }

        //You are always player 1. Your opponent is always player2
        if ($_SESSION['userId'] == $_GET['player1']) {
            $player1 = $_GET['player1'];
            $player2 = getUserById($_GET['player2']);
        } else if ($_SESSION['userId'] == $_GET['player2']) {
            $player1 = $_GET['player2'];
            $player2 = getUserById($_GET['player1']);
        } else {
            header("Location:index.php");
        }

        //Save these so we can always have an absolute reference to the players
        $challengerId = $_GET['player1'];
        $challengedId = $_GET['player2'];

        $gameId = $_GET['player1'] . "|" . $_GET['player2'];

        //Make new row in b_games table
        //Only want to call this once,
        //so we'll have the challenged person call it because they come to the game page first
        if (!gameExists($gameId)) {
            if ($_SESSION['userId'] == $challengedId) {
                createGame($challengerId, $challengedId, $challengedId);
                createMessagesTable($challengerId, $challengedId);
                createPrivateChatTable($challengerId, $challengedId);
                createShipsTable($challengerId, $challengedId);
            }
            $turn = $challengedId;
            $myShipsSet = 'false';
            $opponentShipsSet = 'false';
            $myBoard = 'null';
            $opponentBoard = 'null';
        }
        else {
            //Game exists already
            $turn = grabTurn($gameId, false);
            $myShipsSet = gameInfoRowExists($challengerId, $challengedId, $_SESSION['userId']);
            $opponentShipsSet = gameInfoRowExists($challengerId, $challengedId, $player2->id);
            if ($myShipsSet) {
                $myBoard = getBoard($gameId, $player1);
            } else {
                $myBoard = 'null';
            }
            if($opponentShipsSet) {
                $opponentBoard = getBoard($gameId, $player2->id);
            } else {
                $opponentBoard = 'null';
            }
            //Make them strings because we need to echo them to javascript
            $myShipsSet = $myShipsSet ? 'true' : 'false';
            $opponentShipsSet = $opponentShipsSet ? 'true' : 'false';

        }
        

        header("Content-type:application/xhtml+xml");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>You vs. <?php echo $player2->username; ?> (Battleship)</title>
        <link rel="icon" type="image/png" href="favicon.png" />
        <link type="text/css" href="css/dark-hive/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.5.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
        <script src="js/Cell.js" type="text/javascript"></script>
        <script src="js/Piece.js" type="text/javascript"></script>
        <script src="js/gameFunctions.js" type="text/javascript"></script>
        <script src="js/messages.js" type="text/javascript"></script>
        <script src="js/utils.js" type="text/javascript"></script>
        <script src="js/private-chat.js" type="text/javascript"></script>
        <script type="text/javascript">
            var player1 = '<?php echo $_SESSION['username']; ?>';
            var player2 = '<?php echo $player2->username; ?>';
            var player1Id = <?php echo $_SESSION['userId']; ?>;
            var player2Id = <?php echo $player2->id; ?>;
            var turn = <?php echo $turn; ?>;
            var gameId = 'game_<?php echo $gameId; ?>';
            var turnName = (turn == player1Id) ? player1 : player2;
            var challengerId = <?php echo $challengerId; ?>;
            var challengedId = <?php echo $challengedId; ?>;
            var shipsSet = <?php echo $myShipsSet; ?>;
            var opponentsShipsSet = <?php echo $opponentShipsSet; ?>;
            var myBoard = <?php echo $myBoard; ?>;
            var opponentsBoard = <?php echo $opponentBoard; ?>;

            $(document).ready(function() {
                document.getElementById('turn').firstChild.data = "Turn: " + turnName;
                document.getElementById('youPlayer').firstChild.data = "You: ";
                document.getElementById('opponentPlayer').firstChild.data = "Opponent: ";

                getMessages();
                areShipsSet();
                getPrivateChat();

                $('#dialog, #dialog-gameover, #dialog-1, #dialog-2, #dialog-3, #dialog-4, #dialog-5, #dialog-reset').dialog({
                    autoOpen: false,
                    width: 300
                });

            });
        </script>
    </head>
    <body id="battleship_game" onload="init()">

        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="1000px" height="500px">
            
            <rect x="0px" y="0px" width="100%" height="100%" id="background" />

            <text x="250px" y="20px" id="youPlayer" fill="#00B8FF">
                You:
            </text>
            
            <text x="450px" y="20px" id="turn" fill="red">
                Turn:
            </text>

            <text x="450px" y="50px" id="shotsLeft" fill="red">
                Shots Left: 
            </text>

            <text x="675px" y="20px" id="opponentPlayer" fill="lime">
                Opponent:
            </text>

        </svg>

        <!--<br />-->

        <div id="options">
            <!--<h3>Options</h3>-->
            <button id="setShips" onclick="submitShips();">Set ships</button>
            <button id="startOver" onclick="reset();">Start Over</button>
            <button id="quit" onclick="quit();">Quit</button>
            <h4>Controls</h4>
            <p>
                <strong>A</strong>: rotates Aircraft Carrier <br />
                <strong>B</strong>: rotates Battleship <br />
                <strong>C</strong>: rotates Cruiser <br />
                <strong>S</strong>: rotates Submarine <br />
                <strong>D</strong>: rotates Destroyer
            </p>
            <div id="rules">
                <h4>Rules</h4>
                <p>
                    <strong>Ships</strong>: Click &quot;Set Ships&quot; when you are confident in your ship placement<br />
                    <strong>Shots</strong>: You have as many shots as your opponent has ships each turn<br />
                    <strong>Shots</strong>: Click squares on the right board to shoot at your opponent&#39;s ships<br />
                    <strong>Chat</strong>: Feel free to chat with your opponent (over on the right)
                </p>
            </div>
        </div>

        <div id="private_chat">
            <div id="chat">

            </div>
            <div id="send">
                <form action="battleship.php" onsubmit="sendPrivateChat(); return false;">
                    <input type="text" name="message" placeholder="Your message" /> <input type="submit" value="Send" />
                </form>
            </div>
        </div>

        <!--Multiple dialogs in case multiple ships are sunk in the same turn -->
        
        <div id="dialog" title="Battleship">
            <p></p>
        </div>

        <div id="dialog-1" title="Battleship">
            <p></p>
        </div>
        
        <div id="dialog-2" title="Battleship">
            <p></p>
        </div>
        
        <div id="dialog-3" title="Battleship">
            <p></p>
        </div>
        
        <div id="dialog-4" title="Battleship">
            <p></p>
        </div>
        
        <div id="dialog-5" title="Battleship">
            <p></p>
        </div>
        
        <div id="dialog-gameover" title="Game Over!">
            <p></p>
        </div>

        <div id="dialog-reset" title="Game Over!">
            <p></p>
        </div>
        
    </body>
</html>
<?php
    }
}
?>