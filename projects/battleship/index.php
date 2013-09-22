<?php

session_name('GBattleship');
session_start();

if (!isset($_SESSION['auth_user']) || $_SESSION['auth_user'] == null)
    header("Location:login.php");
else {
    if ($_SESSION['auth_user'] == true) {
        require_once('../../db.php');
        require_once('./bizLayer/utils.php');

        if(isBrowserTooOld()) {
            header("Location:redirect.php");
        }

        $user = getUser($_SESSION['username']);
        $_SESSION['userId'] = $user->id;

        //echo getCurrentGames();

        echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
        <html>
            <head>
                <title>Battleship Lobby!</title>
                <link rel="icon" type="image/png" href="favicon.png" />
                <link type="text/css" href="css/dark-hive/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
                <link rel="stylesheet" href="css/style.css" type="text/css" />
                <script type="text/javascript" src="js/jquery-1.5.min.js"></script>
                <script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
                <script type="text/javascript" src="js/utils.js"></script>
                <script type="text/javascript" src="js/chat.js"></script>
                <script type="text/javascript" src="js/challenges.js"></script>
                <script type="text/javascript" src="js/current-games.js"></script>
                <script type="text/javascript">
                    var username = "<?php echo $user->username; ?>";
                    var userId = <?php echo $user->id; ?>;

                    $(document).ready(function(){
                        $('#current_games').hide();

                        $('#dialog_challenged, #dialog_made_challenge, #dialog_responded, #dialog_received_response').dialog({
                            autoOpen: false,
                            width: 400,
                            modal: true
                        });

                        $('#dialog_made_challenge').dialog({
                            buttons: {
                                Ok: function() {
                                    $(this).dialog( "close" );
                                }
                            }
                        });

                        getChat();
                        getOnlineUsers();
                        getChallenges();
                        getCurrentGames();
                        
                        $('#user span').html(username);
                    });
                </script>
            </head>
            <body id="lobby">
                <div id="container">
                    <div id="right">
                        <div id="user">
                            You are: <span></span> <a href="login.php?logout=1">Logout</a>
                        </div>
                        <br />
                        <div id="users">
                            <h3>Online</h3>
                            <div class="online">

                            </div>
                            <h3>Offline</h3>
                            <div class="offline">

                            </div>
                        </div>
                    </div>

                    <div id="current_games">
                        
                    </div>

                    <div id="lobby_chat">
                        <div id="chat">

                        </div>
                        <div id="send">
                            <form action="index.php" onsubmit="sendChat(); return false;">
                                <input type="text" name="message" placeholder="Your message" /> <input type="submit" value="Send" />
                            </form>
                        </div>
                    </div>

                    <div id="dialog_challenged" title="You have been challenged!">
                        <p></p>
                    </div>
                    <div id="dialog_responded" title="">
                        <p></p>
                    </div>
                    <div id="dialog_made_challenge" title="Challenge Sent!">
                        <p>Your opponent has been challenged.</p>
                    </div>
                    <div id="dialog_received_response" title="">
                        <p></p>
                    </div>
                </div>
            </body>
        </html>
<?php
    }
}
?>