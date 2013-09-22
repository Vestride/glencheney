var xhtmlns = "http://www.w3.org/1999/xhtml";
var svgns = "http://www.w3.org/2000/svg";
var BOARDX = 100;			//starting pos of board
var BOARDY = 100;			//look above
var BOARD2X = BOARDX + 450;
var boardArr = new Array();		//2d array [row][col]
var pieceArr = new Array();		//2d array [player][piece]
var board2Arr = new Array();
var piece2Arr = new Array();
var BOARDWIDTH = 10;			//how many squares across
var BOARDHEIGHT = 10;			//how many squares down
var CELLSIZE = 35;

var letters = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J"];
var numbers = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"];
var pieceCount = 0;
var pinCount = 0;
var shipsLeft = 5;
var opponentShipsLeft = 5;
var availableGuesses = 5;

var getTurnTimeout;
var setShipsButton;

//Dragging
var myX;				//hold my last pos.
var myY;				//hold my last pos.
var mover='';				//hold the id of the thing I'm moving

/**
 *  @futurefeatures
 *  Change cell size based on screen dimensions
 *  Mouse hover things showing what cell you're about to guess
 *  scroll down the chat scrollbar on update
 *  @todo randomize ship placement
 */

function init(){
    //create a parent to stick board in
    var gEle = document.createElementNS(svgns, 'g');
    gEle.setAttributeNS(null,'transform','translate('+BOARDX+','+BOARDY+')');
    gEle.setAttributeNS(null,'id', gameId);
    //stick g on board
    document.getElementsByTagName('svg')[0].appendChild(gEle);


    //Might have to create a second svg tag due to dragging
    var gEl = document.createElementNS(svgns, 'g');
    gEl.setAttributeNS(null, 'transform', 'translate('+BOARD2X+', '+BOARDY+')');
    gEl.setAttributeNS(null, 'id', gameId+"_guesses");
    document.getElementsByTagName('svg')[0].appendChild(gEl);

    

    //Instead of looping 400 times, do it 100
    //Make the ships board and Show letters and numbers on ships board
    //Make the guesses board Show letters and numbers on guesses board
    var textEl;
    var text;
    var x;
    var y;
    var textEl2;
    var text2;
    var x2;
    var y2;
    for(var i = 0; i < BOARDWIDTH; i++){
        boardArr[i] = new Array();
        board2Arr[i] = new Array();
        for(var j = 0; j < BOARDHEIGHT; j++){
            //Ships
            boardArr[i][j] = new Cell(document.getElementById(gameId), 'cell_' + i + j, CELLSIZE, i, j, false);
            
            //Guesses
            board2Arr[i][j] = new Cell(document.getElementById(gameId+"_guesses"), 'cellguess_' + i + j, CELLSIZE, i, j, true);

            if(j == 0) {
                //Ships - Letters
                textEl = document.createElementNS(svgns, 'text');
                text = letters[i];
                x = (CELLSIZE * i) + (CELLSIZE/2) - 5;
                y = (CELLSIZE * j) - CELLSIZE/2;
                textEl.setAttributeNS(null, 'class', 'indicator_col');
                textEl.appendChild(document.createTextNode(text));
                textEl.setAttributeNS(null, 'x', x + 'px');
                textEl.setAttributeNS(null, 'y', y + 'px');
                document.getElementById(gameId).appendChild(textEl);

                //Guesses - Letters
                textEl2 = document.createElementNS(svgns, 'text');
                text2 = letters[i];
                x2 = (CELLSIZE * i) + (CELLSIZE/2) - 5;
                y2 = (CELLSIZE * j) - CELLSIZE/2;
                textEl2.setAttributeNS(null, 'class', 'indicator_col');
                textEl2.appendChild(document.createTextNode(text2));
                textEl2.setAttributeNS(null, 'x', x2 + 'px');
                textEl2.setAttributeNS(null, 'y', y2 + 'px');
                document.getElementById(gameId).appendChild(textEl2);
                document.getElementById(gameId+"_guesses").appendChild(textEl2);
            }
            if(i == 0) {
                //Ships - Numbers
                textEl = document.createElementNS(svgns, 'text');
                text = numbers[j];
                x = (CELLSIZE * i) - (CELLSIZE/2) - 5;
                y = (CELLSIZE * (j+1)) - CELLSIZE/2;
                textEl.setAttributeNS(null, 'class', 'indicator_row');
                textEl.appendChild(document.createTextNode(text));
                textEl.setAttributeNS(null, 'x', x + 'px');
                textEl.setAttributeNS(null, 'y', y + 'px');
                document.getElementById(gameId).appendChild(textEl);

                //Guesses - Numbers
                textEl2 = document.createElementNS(svgns, 'text');
                text2 = numbers[j];
                x2 = (CELLSIZE * i) - (CELLSIZE/2) - 5;
                y2 = (CELLSIZE * (j+1)) - CELLSIZE/2;
                textEl2.setAttributeNS(null, 'class', 'indicator_row');
                textEl2.appendChild(document.createTextNode(text2));
                textEl2.setAttributeNS(null, 'x', x2 + 'px');
                textEl2.setAttributeNS(null, 'y', y2 + 'px');
                document.getElementById(gameId).appendChild(textEl2);
                document.getElementById(gameId+"_guesses").appendChild(textEl2);
            }
        }
    }

    makeShips();

    //Register events
    if(window.addEventListener) {
        document.getElementsByTagName('svg')[0].addEventListener('mouseup', releaseMove, false);
        document.getElementsByTagName('svg')[0].addEventListener('mousemove', go, false);
        window.addEventListener('keypress', handleKeyPress, false);
    } else {
        //IE
        document.getElementsByTagName('svg')[0].attachEvent('onmouseup', releaseMove);
        document.getElementsByTagName('svg')[0].attachEvent('onmousemove', go);
        window.attachEvent('onkeypress', handleKeyPress);
    }
    
    
    //Add the players name to their respective text elements
    document.getElementById('youPlayer').firstChild.data = "You: " + player1;
    document.getElementById('opponentPlayer').firstChild.data = "Opponent: " + player2;
}

function makeShips() {
    if(!shipsSet) {
        //Put pieces on the board
        pieceArr[pieceCount] = new Piece("ship", player1Id, 2, 3, 'AircraftCarrier', pieceCount, true);
        pieceCount++;
        pieceArr[pieceCount] = new Piece("ship", player1Id, 2, 7, 'Battleship', pieceCount, true);
        pieceCount++;
        pieceArr[pieceCount] = new Piece("ship", player1Id, 8, 4, 'Cruiser', pieceCount, false);
        pieceCount++;
        pieceArr[pieceCount] = new Piece("ship", player1Id, 0, 1, 'Submarine', pieceCount, true);
        pieceCount++;
        pieceArr[pieceCount] = new Piece("ship", player1Id, 0, 7, 'Destroyer', pieceCount, false);
        pieceCount++;
    } else {
        //Page has been refreshed and the ships are already set
        getShipLocations();

        //Take off the button
        setShipsButton = $('#setShips').detach();

        //Loop through opponents board and call callBackMakeGuess (first 5 are ship life)
        for(var i = 5; i < opponentsBoard.length; i++) {
            // data[i] looks like: 0_1|0|0 aka ship_guess|row|col
            var arr     = opponentsBoard[i].split("_");
            var ship    = parseInt(arr[0]);
            var arr2    = arr[1].split("|");
            var guess   = parseInt(arr2[0]);
            var row     = parseInt(arr2[1]);
            var col     = parseInt(arr2[2]);

            //If there is no guess, we don't need to do anything
            if (guess == 0) {
                continue;
            }
            //Player guessed
            else if (guess == 1) {
                var hit;
                var cell = row + "_" + col;
                //Player hit ship
                if (ship == 1) {
                    hit = true;
                }
                //Player missed ship
                else if (ship == 0) {
                    hit = false;
                }

                var obj = {
                    "cell" : cell,
                    "hit" : hit
                };
                callBackMakeGuess(obj);
            }
        }
    }
}

function getShipLocations() {
    var data = challengerId + "|" + challengedId + "|" + player1Id;
    ajaxCall("GET", {method: "getShipLocations", service: "game", data: data}, callBackGetShipLocations);
}

function callBackGetShipLocations(data) {
    for(var key in data) {
        var arr = data[key].cell.split("_");
        var row = parseInt(arr[0]);
        var col = parseInt(arr[1]);
        var vertical = (data[key].vertical === 'true') ? true : false;
        pieceArr[pieceCount] = new Piece("ship", player1Id, row, col, data[key].type, pieceCount, vertical);
        pieceCount++;
    }
    //Draw pins after ships to make sure they go on top
    drawBoard(myBoard, false);
}

/**
 * Sends the toggleOrientation to the correct ship based on key press
 * @param evt
 */
function handleKeyPress(evt) {
    var code = evt.charCode || evt.keyCode;
    switch(code) {
        case 97:
            //A = aircraft carrier
            pieceArr[0].toggleOrientation();
            break;
        case 98:
            //B = Battleship
            pieceArr[1].toggleOrientation();
            break;
        case 99:
            //C = Cruiser
            pieceArr[2].toggleOrientation();
            break;
        case 100:
            //D = destroyer
            pieceArr[4].toggleOrientation();
            break;
        case 115:
            //S = Submarine
            pieceArr[3].toggleOrientation();
            break;
    }
}

///////////////////////Dragging code/////////////////////////


////setMove/////
//set the id of the thing I'm moving...
////////////////
function setMove(which){		
    mover = which;
    //get the last position of the thing... (NOW through the transform=translate(x,y))
    var xy = getTransform(which);
    myX = xy[0];
    myY = xy[1];
    //getPiece(mover).putOnTop();
}
			
			
////releaseMove/////
//clear the id of the thing I'm moving...
////////////////
function releaseMove(evt){
    if(mover != '') {
        var hit = checkHit(evt.clientX, evt.clientY, mover);
        if(hit === false) {
            //snap back
            setTransform(mover, myX, myY);
        }
        mover = '';
    }
}
			
			
////go/////
//move the thing I'm moving...
////////////////
function go(evt){
    if(mover != ''){
        setTransform(mover, evt.clientX, evt.clientY);
    }
}
			
/**
 * Checks to see if we can drop the piece on a cell
 * @param {int} x evt.clientX
 * @param {int} y evt.clientY
 * @param {string} which id of piece we are currently moving
 * @return boolean
 */
function checkHit(x, y, which){
    //change the x and y coords (mouse) to match the transform
    x = x - BOARDX;
    y = y - BOARDY;
    var currentPiece = getPiece(which);
    //detach this piece from the board
    currentPiece.detachFromCells();
    //go through ALL of the board
    for(var i = 0; i < BOARDWIDTH; i++){
        for(var j = 0; j < BOARDHEIGHT; j++){
            var drop = boardArr[i][j].myBBox;
            if((x > drop.x)
                && (x < (drop.x+drop.width))
                && (y > drop.y)
                && (y < (drop.y + drop.height))
                && (boardArr[i][j].occupied == '')
            ){
                if(currentPiece.isValidMove(i, j) === false) {
                    currentPiece.reattachToCells();
                    return false;
                }

                setTransform(which, boardArr[i][j].getTopLeftX(), boardArr[i][j].getTopLeftY());
				
                currentPiece.changeCell(i, j);
                return true;
            }
        }
    }
    currentPiece.reattachToCells();
    return false;
}
///////////////////////////////Utilities////////////////////////////////////////


////get Piece/////
//get the piece (object) from the id and return it...
//id looks like "piece_ship|3" or "piece_guess|2"
////////////////
function getPiece(which){
    /*var userID = which.search(/\_/)+1;
    userID = which.substr(userID, 1);
    userID = parseInt(userID);*/

    var pieceNumber = which.search(/\|/)+1;
    pieceNumber = which.substr(pieceNumber, 1);
    pieceNumber = parseInt(pieceNumber);

    return pieceArr[pieceNumber];
}

function getPin(which){
    var pieceNumber = which.search(/\|/)+1;
    pieceNumber = which.substr(pieceNumber, 1);
    pieceNumber = parseInt(pieceNumber);

    return piece2Arr[pieceNumber];
}
			
////get Transform/////
//look at the id of the piece sent in and work on it's transform
//return an array of [0]=x, [1]=y
////////////////
function getTransform(which){
    var hold = document.getElementById(which).getAttributeNS(null, 'transform');
    var retVal = new Array();
    retVal[0] = hold.substring((hold.search(/\(/) + 1), hold.search(/,/));  //x value
    retVal[1] = hold.substring((hold.search(/,/) + 1), hold.search(/\)/));  //y value
    return retVal;
}
			
////set Transform/////
//look at the id, x, y of the piece sent in and set it's translate
////////////////
function setTransform(which,x,y){
    document.getElementById(which).setAttributeNS(null,'transform','translate('+x+','+y+')');
}

//Changes the turn variable to the other user and updates the database
function changeTurn(){
    turn = player2;
    ajaxCall("GET", {method:"changeTurn", service: "game", data: gameId + "!" + player2Id}, callBackChangeTurn);
}

function callBackChangeTurn(data) {
    document.getElementById('turn').firstChild.data = "Turn: " + player2;
    document.getElementById('shotsLeft').firstChild.data = "Opponent's shots: " + shipsLeft;
    getTurn();
}

function getTurn() {
    ajaxCall("GET", {
        method: "getTurn",
        service: "game",
        data: gameId
    }, callBackTurn);
}

function callBackTurn(data) {
    turn = data.turn;
    if(data.turn == player1Id) {
        //It is currently my turn
        document.getElementById('turn').firstChild.data = "Turn: " + player1;
        //Get the other guy's new guesses
        getMyBoard();
        //Make sure i have the correct amount of guesses
        availableGuesses = opponentShipsLeft;
        document.getElementById('shotsLeft').firstChild.data = "Shots Left: " + availableGuesses;
    }
    else {
        //Not my turn. Keep asking.
        getTurnTimeout = setTimeout('getTurn()', 5000);
    }
}

function getMyBoard() {
    ajaxCall("GET", {method: "getTheBoard", service: "game", data: gameId + "!" + player1Id}, callBackGetMyBoard);
}

function getBoards() {
    $.ajax({
        type:"GET",
        data: {
            method: "getTheBoard",
            service: "game",
            data: gameId + "!" + player1Id
            },
        url:"mid.php",
        dataType:'json',
        success: function(data){
            callBackGetBoards(data, 'ships');
        }
    });

    $.ajax({
        type:"GET",
        data: {
            method: "getTheBoard",
            service: "game",
            data: gameId + "!" + player2Id
            },
        url:"mid.php",
        dataType:'json',
        success: function(data){
            callBackGetBoards(data, 'guesses');
        }
    });
}

function drawBoard(data, withMessages) {
    var acLife = parseInt(data[0]);
    var battleshipLife = parseInt(data[1]);
    var cruiserLife = parseInt(data[2]);
    var submarineLife = parseInt(data[3]);
    var destroyerLife = parseInt(data[4]);

    //Start at 5 because of the ship life columns
    for(var i = 5; i < data.length; i++) {
        // data[i] looks like: 0_1|0|0 aka ship_guess|row|col
        var arr     = data[i].split("_");
        var ship    = parseInt(arr[0]);
        var arr2    = arr[1].split("|");
        var guess   = parseInt(arr2[0]);
        var row     = parseInt(arr2[1]);
        var col     = parseInt(arr2[2]);

        if (guess == 0 || boardArr[row][col].pin != '') {
            //No guess or we have already made this pin
            continue;
        }
        else if (guess == 1) {
            //New pin we need to create
            pieceArr[pieceCount] = new Piece("ship", player1Id, row, col, 'Pin', pieceCount);
            if(ship == 0) {
                //Miss
                pieceArr[pieceCount].piece.setAttributeNS(null, 'class', 'piece_pin_miss');
            }
            else if (ship == 1) {
                //Hit
                pieceArr[pieceCount].piece.setAttributeNS(null, 'class', 'piece_pin_hit');
                //Find the ship that occupies this spot and subtract 1 from its life
                var pieceId = boardArr[row][col].occupied;
                var shipOnBoard = getPiece(pieceId);
                shipOnBoard.object.life--;
                //If its life is now zero, tell both users!
                if (shipOnBoard.object.life == 0) {
                    if(withMessages) {
                        sendMessage(player1, "You sunk " + player1 + "'s " + shipOnBoard.object.name, 'sunk');
                        var id;
                        //Multiple dialogs in case multiple ships are sunk in the same turn
                        switch(shipOnBoard.object.name) {
                            case "Aircraft Carrier":
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
                        $(id + ' p').html(player2 + " has sunk your " + shipOnBoard.object.name)
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
                    }
                    shipsLeft--;
                }
            }
            pieceCount++;
        }
    }
}

function callBackGetMyBoard(data) {
    drawBoard(data, true);
    var acLife = parseInt(data[0]);
    var battleshipLife = parseInt(data[1]);
    var cruiserLife = parseInt(data[2]);
    var submarineLife = parseInt(data[3]);
    var destroyerLife = parseInt(data[4]);

    //If the life we started with is different from the current life, we need to update the db
    if (pieceArr[0].object.life != acLife || pieceArr[1].object.life != battleshipLife
        || pieceArr[2].object.life != cruiserLife
        || pieceArr[3].object.life != submarineLife
        || pieceArr[4].object.life != destroyerLife
        ) {
        var ajaxData = gameId + "!" + player1Id + "!"
            + pieceArr[0].object.life + "!"
            + pieceArr[1].object.life + "!"
            + pieceArr[2].object.life + "!"
            + pieceArr[3].object.life + "!"
            + pieceArr[4].object.life;
        ajaxCall("GET", {
            method: "updateLife",
            service: "game",
            data: ajaxData
        }, callBackLifeUpdate);
    }

    //You just lost!
    if (shipsLeft == 0) {
        sendMessage(player1, "You have won!", 'won');
        $('#dialog-gameover p').html(player2 + ' sunk all your ships!')
        .parent()
        .dialog({
            modal: true,
            title : "You have lost!",
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
    }
}

function callBackLifeUpdate(data) {
    //Successful update of the ship's life in the db
}

//Only called on document.ready
function callBackGetBoards(data, which) {
    //Start at 5 because of the ship life columns
    for(var i = 5; i < data.length; i++) {
        // data[i] looks like: 0_1|0|0 aka ship_guess|row|col
        var arr     = data[i].split("_");
        var ship    = parseInt(arr[0]);
        var arr2    = arr[1].split("|");
        var guess   = parseInt(arr2[0]);
        var row     = parseInt(arr2[1]);
        var col     = parseInt(arr2[2]);

        if (guess == 0) {
            //No guess
            continue;
        }
        else if (guess == 1) {
            if (which == 'ships') {
                pieceArr[pieceCount] = new Piece("ship", player1Id, row, col, 'Pin', pieceCount);
                if(ship == 0) {
                    //Miss
                    pieceArr[pieceCount].piece.setAttributeNS(null, 'class', 'piece_pin_miss');
                }
                else if (ship == 1) {
                    //Hit
                    pieceArr[pieceCount].piece.setAttributeNS(null, 'class', 'piece_pin_hit');

                }
                pieceCount++;
            }
            else if (which == 'guesses') {
                piece2Arr[pinCount] = new Piece("guess", player1Id, row, col, 'Pin', pinCount);
                if(ship == 0) {
                    //Miss
                    piece2Arr[pinCount].piece.setAttributeNS(null, 'class', 'piece_pin_miss');
                }
                else if (ship == 1) {
                    //Hit
                    piece2Arr[pinCount].piece.setAttributeNS(null, 'class', 'piece_pin_hit');
                }
                pinCount++;
            }
            
        }
    }
}

function makeGuess(row, col) {
    if(turn == player1Id && shipsSet == true && opponentsShipsSet == true) {
        //My turn and my ships are set
        var data = gameId + "|" + player1Id + "|" + row + "_" + col;
        if(availableGuesses > 1) {
            //Still have more than 1 guess left
            ajaxCall("GET", {method: "makeGuess", service: "game", data: data}, callBackMakeGuess);
            availableGuesses--;
        }
        else {
            //One guess left, do it, change turns and reset availableGuesses
            ajaxCall("GET", {method: "makeGuess", service: "game", data: data}, callBackMakeGuess);
            changeTurn();
        }
    }
    else if (shipsSet == false) {
        //My ships are not set
        $('#dialog p').html('Set your ships first')
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
    }
    else if (opponentsShipsSet == false) {
        //My opponent's ships are not set
        $('#dialog p').html('Waiting for your opponent to set their ships')
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
    }
    else {
        $('#dialog p').html('Not your turn!')
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
    }
}

function callBackMakeGuess(data) {
    //You submitted your guess, show the pin
    var arr = data.cell.split("_");
    var i = arr[0];
    var j = arr[1];
    piece2Arr[pinCount] = new Piece("guess", player1Id, i, j, 'Pin', pinCount);

    
    if(data.hit == true) {
        piece2Arr[pinCount].piece.setAttributeNS(null, 'class', 'piece_pin_hit');
    }
    else {
        piece2Arr[pinCount].piece.setAttributeNS(null, 'class', 'piece_pin_miss');
    }
    pinCount++;

    document.getElementById('shotsLeft').firstChild.data = "Shots Left: " + availableGuesses;
    
}

function submitShips() {
    var pieces = new Array();
    for(var i = 0; i < BOARDWIDTH; i++){
        for(var j = 0; j < BOARDHEIGHT; j++){
            if(boardArr[i][j].occupied) {
                pieces.push(i+"_"+j);
            }
        }
    }
    var piecesString = JSON.stringify(pieces);
    var data = gameId+"|"+player1Id+"|"+player2Id+"|"+piecesString;

    ajaxCall("GET", {method: "submitShips", service: "game", data: data}, callBackSubmitShips);
    
    var shipData = challengerId + "!" + challengedId + "!" + player1Id + "!";
    for (var k = 0; k < 5; k++) {
        var startRow = pieceArr[k].currentCell[0].row;
        var startCol = pieceArr[k].currentCell[0].col;
        var isVertical = pieceArr[k].object.vertical;
        shipData += startRow+"_"+startCol+"|"+isVertical;
        if (k < 4)  { //not last one in the loop
            shipData += "!";
        }
    }
    
    ajaxCall("GET", {method: "shipLocations", service: "game", data: shipData}, null);


    setShipsButton = $('#setShips').detach();
}

function callBackSubmitShips(data) {
    if(data == '1') {
        $('#dialog p').html('Ships set')
        .parent()
        .dialog({
            title : "Battleship -- Ready",
            buttons : {
                Ok: function() {
                    $(this).dialog("close");
                }
            }
        })
        .dialog('open');

        shipsSet = true;

        //Remove listeners
        if(window.addEventListener) {
            document.getElementsByTagName('svg')[0].removeEventListener('mouseup', releaseMove, false);
            document.getElementsByTagName('svg')[0].removeEventListener('mousemove', go, false);
            window.removeEventListener('keypress', handleKeyPress, false);
        } else {
            //IE
            document.getElementsByTagName('svg')[0].detachEvent('onmouseup', releaseMove);
            document.getElementsByTagName('svg')[0].detachEvent('onmousemove', go);
            window.detachEvent('onkeypress', handleKeyPress);
        }

        if (turn != player1Id) {
            getTurn();
        }
    }
    
    
}

function areShipsSet() {
    var data = challengerId +"|" + challengedId + "|" + player2Id;
    ajaxCall("GET", {method: "areShipsSet", service: "game", data: data}, callBackAreShipsSet);
}

function callBackAreShipsSet(data) {
    if(data != 1) {
        setTimeout('areShipsSet()', 7000);
    }
    else {
        opponentsShipsSet = true;
        //Opponents ships are set
        $('#dialog p').html('Your opponent has set their ships')
        .parent()
        .dialog({
            modal : false,
            title : "Battleship",
            buttons : {
                Ok: function() {
                    $(this).dialog("close");
                }
            }
        })
        .dialog('open');
    }

}

function reset() {
    //confirm
    $('#dialog p').html('Are you sure you want to ask ' + player2 + ' if they want to start over?')
    .parent()
    .dialog({
        modal : true,
        width: 400,
        title : "Start Over?",
        buttons : {
            "Yes, ask to start over" : function() {
                //send message
                sendMessage(player1, player1 + " wants to start over. Do you want to start over?", 'reset');
                $(this).dialog("close");
            },
            "No, do nothing" : function() {
                $(this).dialog("close");
            }
        }
    })
    .dialog('open');
}

function resetGame() {
    //reset global variables
    turn = challengedId;
    turnName = (turn == player1Id) ? player1 : player2;
    document.getElementById('turn').firstChild.data = "Turn: " + turnName;
    shipsSet = false;
    opponentsShipsSet = false;
    boardArr.length = 0;
    pieceArr.length = 0;
    board2Arr.length = 0;
    piece2Arr.length = 0;
    pieceCount = 0;
    pinCount = 0;
    shipsLeft = 5;
    opponentShipsLeft = 5;
    availableGuesses = 5;


    //Stop timeouts
    clearTimeout(getTurnTimeout);
    
    //Add set ships button back
    $('#startOver').before(setShipsButton);
    setShipsButton = null;

    //Clear boards
    var save = $('#background, #youPlayer, #opponentPlayer, #turn, #shotsLeft').detach();
    $('svg').children().remove();
    $('svg').append(save);

    //Call init again
    init();

    //Clear board in db. Also calls areShipsSet()
    clearMyBoard();
}

function quit() {
    //confirm
    $('#dialog p').html('Are you sure you want to quit?')
    .parent()
    .dialog({
        modal : true,
        title : "Quit this game :(",
        buttons : {
            "Yes, forfeit" : function() {
                //send message
                sendMessage(player1, player1 + " quit. You win!", 'quit');
                quitGame();
                $(this).dialog("close");
            },
            "No, stay" : function() {
                $(this).dialog("close");
            }
        }
    })
    .dialog('open');
}

//delete b_gameInfo row
//delete b_shipsPlayer1_player2 row
function clearMyBoard() {
    var data = challengerId +"|" + challengedId + "|" + player1Id;
    ajaxCall("GET", {method: "quitGame", service: "game", data: data}, callBackClearMyBoard);
}

function callBackClearMyBoard() {
    //board successfully cleared
    //Start asking for ships again
    areShipsSet();
}

//delete b_gameInfo row
//We want to keep the messages and game for the other player
function quitGame() {
    var data = challengerId +"|" + challengedId + "|" + player1Id;
    ajaxCall("GET", {method: "quitGame", service: "game", data: data}, callBackEndGame);
}

//delete b_gameInfo row
//delete messages table
//delete row from b_games
//delete private chat table 
//delete ships table
function endGame() {
    var data = challengerId +"|" + challengedId + "|" + player1Id;
    ajaxCall("GET", {method: "endGame", service: "game", data: data}, callBackEndGame);
}

//alert("callBackEndGame: " + data);
//update rooms
//send both users back to index
function callBackEndGame() {
    updateRoom(player1, 0);
}