function sendMessage(createdBy, message, status) {
    var data = challengerId + "|" + challengedId + "|" + createdBy + "|" + message + "|" + status;
    ajaxCall("GET", {
        method: "sendMessage",
        service: "game",
        data: data
    }, callBackSendMessage);
}

function callBackSendMessage(data) {
//alert("callBackSendMessage: " + data);
}

function getMessages() {
    ajaxCall("GET", {
        method: "getMessages",
        service: "game",
        data: challengerId + "|" + challengedId
    }, callBackGetMessages);
}

function callBackGetMessages(data) {
    //alert(JSON.stringify(data));
    for(var index in data) {
        if(data[index].createdBy != player1) {
            //Message was not created by me

            switch(data[index].status) {
                case "sunk":
                    var shipNameStart = data[index].message.lastIndexOf(" ") + 1;
                    var shipName = data[index].message.substr(shipNameStart);
                    var id;
                    //Multiple dialogs in case multiple ships are sunk in the same turn
                    switch(shipName) {
                        case "Carrier":
                            id = "#dialog-1";
                            break;
                        case "Battleship":
                            id = "#dialog-2";
                            break;
                        case "Cruiser":
                            id = "#dialog-3";
                            break;
                        case "Submarine":
                            id = "#dialog-4";
                            break;
                        case "Destroyer":
                            id = "#dialog-5";
                            break;
                        default:
                            id = "#dialog";
                            break;
                    }
                    $(id + ' p').html(data[index].message)
                    .parent()
                    .dialog({
                        title : "Battleship",
                        buttons : {
                            Ok: function() {
                                $(this).dialog("close");
                            }
                        }
                    })
                    .dialog('open');

                    //if(data[index].message.indexOf("sunk") != -1) {
                    opponentShipsLeft--;
                    //Make sure i have the correct amount of guesses
                    availableGuesses = opponentShipsLeft;
                    //document.getElementById('shotsLeft').firstChild.data = "Shots Left: " + availableGuesses;\

                    updateMessageStatus(data[index].messageId, 'read');
                    break;
                case "won":
                case "quit":
                    $('#dialog-gameover p').html(data[index].message)
                    .parent()
                    .dialog({
                        modal : true,
                        title : "You won!",
                        buttons : {
                            "Back to Lobby": function() {
                                $(this).dialog("close");
                            }
                        },
                        close : function(event, ui) {
                            endGame();
                        }
                    })
                    .dialog('open');
                    
                    break;
                case "reset":
                    $('#dialog-reset p').html(data[index].message)
                    .parent()
                    .dialog({
                        modal : true,
                        width: 400,
                        title : "Start Over?",
                        buttons : {
                            "Yes, start over" : function() {
                                //update message
                                $(this).dialog("close");
                                updateMessageStatus(data[index].messageId, 'acceptedReset');
                                resetGame();
                            },
                            "No, do not start over" : function() {
                                $(this).dialog("close");
                                 updateMessageStatus(data[index].messageId, 'declinedReset');
                            }
                        }
                    })
                    .dialog('open');
                    break;
            }
        }
        else {
            //Message originated from me
            switch(data[index].status) {
                case "acceptedReset":
                    //Start everything over
                    $('#dialog-reset p').html(player2 + ' accepted your request to start over')
                    .parent()
                    .dialog({
                        modal : true,
                        width : 300,
                        title : "Request Accepted",
                        buttons : {
                            Ok : function() {
                                $(this).dialog("close");
                            }
                        },
                        close : function(event, ui) {
                            //update message
                            resetGame();
                            updateMessageStatus(data[index].messageId, 'read');
                        }
                    })
                    .dialog('open');
                    break;
                case "declinedReset":
                    //Tell requester that the other player does not want to start over
                    updateMessageStatus(data[index].messageId, 'read');
                    $('#dialog-reset p').html(player2 + ' declined your request to start over')
                    .parent()
                    .dialog({
                        modal : true,
                        width : 300,
                        title : "Request Declined",
                        buttons : {
                            Ok : function() {
                                $(this).dialog("close");
                            } 
                        },
                        close : function(event, ui) {
                            //update message
                            updateMessageStatus(data[index].messageId, 'read');
                        }
                    })
                    .dialog('open');
                    break;
            }
        }
    }
    setTimeout("getMessages()", 5000);
}

function updateMessageStatus(messageId, status) {
    var data = challengerId + "|" + challengedId + "|" + messageId + "|" + status;
    ajaxCall("GET", {
        method: "changeMessageStatus",
        service: "game",
        data: data
    }, callBackUpdateMessageStatus);
}

function callBackUpdateMessageStatus(data) {
//alert("callBackUpdateMessageStatus: " + data);
}