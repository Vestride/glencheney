function getChallenges() {
    ajaxCall("GET", {
        method: "getChallenges",
        service: "game",
        data: ''
    }, callBackGotChallenges)
}

function callBackGotChallenges(data) {
    //@note varaibles are redeclard each time because with jquery ui dialogs, the execution of scripts is not stopped
    // (like it would be for alerts or confirms) and the values are overwritten by the time we come back to them
    for(var i = 0; i < data.length; i++) {

        //I have been challenged
        if(data[i].challenged == userId && data[i].status == 'created') {
            //This user has been challenged to a game
            var createdId = data[i].challengeId;
            var createdChallengerId = data[i].challenger;
            var createdChallengedId = data[i].challenged;
            var createdChallengerName = data[i].challenger_name;

            $('#dialog_challenged p').html(createdChallengerName + " has challenged you to a game of Battleship!");
            $('#dialog_challenged').dialog("option", "buttons", {
                "Accept": function() {
                    updateChallenge(createdId, "accepted", createdChallengerId, createdChallengedId);
                    $(this).dialog("close");
                },
                "Decline": function() {
                    updateChallenge(createdId, "declined", createdChallengerId, createdChallengedId);
                    $(this).dialog("close");
                }
            }).dialog('open');
                
        }

        //My challenge has been accepted
        if(data[i].challenger == userId && data[i].status == 'accepted') {

            var acceptedId = data[i].challengeId;
            var acceptedChallengerId = data[i].challenger;
            var acceptedChallengedId = data[i].challenged;

            $('#dialog_received_response p').html('Redirecting you to the game')
            .parent()
            .dialog({
                title : "Your challenge has been accepted!",
                buttons : {
                    Ok: function() {
                        $(this).dialog("close");
                    }
                },
                close : function(event, ui) {
                    updateChallenge(acceptedId, 'ingame', acceptedChallengerId, acceptedChallengedId);
                    updateToGameRoom(acceptedChallengerId, acceptedChallengedId);
                }
            })
            .dialog('open');
        }
        
        //Received a response from the challenged player that they do NOT want to play
        if(data[i].challenger == userId && data[i].status == 'declined') {            
            var declinedId = data[i].challengeId;
            var declinedChallengerId = data[i].challenger;
            var declinedChallengedId = data[i].challenged;

            $('#dialog_received_response p').html('You\'re just too good!')
            .parent()
            .dialog({
                title: "Your challenge has been declined!",
                buttons: {
                    Ok: function() {
                        $(this).dialog("close");
                        updateChallenge(declinedId, 'delete', declinedChallengerId, declinedChallengedId);
                    }
                }
            })
            .dialog('open');
        }
    }

    //Check for new challenges every 10 seconds
    setTimeout('getChallenges()', 10000);
}

function updateChallenge(challengeId, status, challengerId, challengedId) {
    $('#dialog_responded').dialog("option", "title", 'You have ' + status + ' the challenge');
    $.ajax({
        type:"GET",
        data: {
            method: "changeChallenge",
            service: "game",
            data: challengeId + "|" + status
            },
        url:"mid.php",
        dataType:'json',
        success: function(data){
            callBackUpdateChallenge(data, status, challengerId, challengedId);
        }
    });
}

function callBackUpdateChallenge(data, status, challengerId, challengedId) {
    if(status == 'accepted') {
        $('#dialog_responded p').html("You will now be put in a game!");
        $('#dialog_responded').dialog("option", "buttons", {
            Ok: function() {
                $(this).dialog("close");
            }
        }).dialog({
            close: function(event, ui) {
                updateToGameRoom(challengerId, challengedId);
            }
        }).dialog('open');
    } 
    else if (status == 'declined') {
        $('#dialog_responded p').html("What, you don't want to play battleship!");
        $('#dialog_responded').dialog("option", "buttons", {
            Ok: function() {
                $(this).dialog("close");
            }
        }).dialog('open');
    }
}

function sendChallenge(idToChallenge) {
    //data = userId|idToChallenge
    ajaxCall("GET", {
        method: "createChallenge",
        service: "game",
        data:userId + "|" + idToChallenge
    }, callBackMadeChallenge);
}

function callBackMadeChallenge(data) {
    $('#dialog_made_challenge').dialog('open');
}

function redirectToGame(challengerId, challengedId) {
    window.location = "battleship.php?player1="+challengerId+"&player2="+challengedId;
}