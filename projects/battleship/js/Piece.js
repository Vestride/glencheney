/**
 * @constructor
 * @param {string} board
 * @param {int} player
 * @param {int} cellRow
 * @param {int} cellCol
 * @param {string} type
 * @param {int} num
 * @param {boolean} isVertical
 * @this {Piece}
 */
function Piece(board, player, cellRow, cellCol, type, num, isVertical) {
    this.board      = board;        //ship/guess
    this.player     = player;       //which player (id)
    this.type       = type;         //piece needs to know what kind it is (checker)
    this.number     = num;          //0-11
    this.cellRow    = cellRow;
    this.cellCol    = cellCol;
    this.currentCell= new Array();
    this.isVertical = isVertical
	
    this.id = 'piece_' + this.board + '|' + this.number; //piece_ship|4 is the fifth ship.

    
    this.object  = eval('new ' + this.type + '(this);');
    this.piece = this.object.piece;
    this.piece.setAttributeNS(null, 'id', this.id);

    if(this.type != 'Pin') {
        this.piece.addEventListener('mousedown', function(){
            setMove(this.id);
        }, false);
    }

    document.getElementsByTagName('svg')[0].appendChild(this.piece);
}

/**
 * Re-assigns the current row and column of
 * the piece and occupies the correct cells again
 * @this {Piece}
 * @param {int} row
 * @param {int} col
 */
Piece.prototype.changeCell = function(row, col) {
    this.cellRow = row;
    this.cellCol = col;
    this.reattachToCells();
}

Piece.prototype.putOnTop = function() {
    document.getElementsByTagName('svg')[0].removeChild(this.piece);
    document.getElementsByTagName('svg')[0].appendChild(this.piece);
}

/**
 * Rotates a ship from horizontal to vertical and visa versa
 * @this {Piece}
 */
Piece.prototype.toggleOrientation = function() {
    this.detachFromCells();

    //Change orientation
    this.object.vertical = (this.object.vertical) ? false : true;

    //Can I toggle?
    var isValidToggle = this.isValidToggle(this.cellRow, this.cellCol);
    if(isValidToggle === true) {
        //Good to go
        this.rotateShip();
    }
    else {
        //Something in the way or off the board, switch back orientation
        this.object.vertical = (this.object.vertical) ? false : true;
    }

    this.reattachToCells();
}

//Could use isValidMove, but it does not return true because it would break out
// of the for loop in CheckHit in gameFunctions.js
/**
 * Asks if the ship can be toggled (rotated) and still be on the board and not
 * interfere with other ships.
 * @this {Piece}
 * @return {boolean}
 */
Piece.prototype.isValidToggle = function(originRow, originCol) {
    if(this.isValidMove(originRow, originCol) === false) {
        return false;
    }
    return true;
}

/**
 * Takes the cells the ship currently occupies and sets them to unoccupied and
 * zeros out the currentCell array
 * @this {Piece}
 */
Piece.prototype.detachFromCells = function() {
    for(var i = 0; i < this.object.spaces; i++) {
        this.currentCell[i].notOccupied();
    }
    this.currentCell.length = 0;
}

/**
 * Based on the rotation and orginal cell the ship is in, this function
 * populates the currentCell array and tells each cell that it is occupied
 * by the ship
 * @this {Piece}
 */
Piece.prototype.reattachToCells = function() {
    for(var i = 0; i < this.object.spaces; i++) {
        if(this.object.vertical) {
            this.currentCell.push(boardArr[this.cellRow + i][this.cellCol]);
        }
        else {
            this.currentCell.push(boardArr[this.cellRow][this.cellCol + i]);
        }
        this.currentCell[i].isOccupied(this.id);
    }
}

/**
 * Based on the current rotation of the ship, changes the width and height
 * attributes to show the ship has been rotated
 * @this {Piece}
 */
Piece.prototype.rotateShip = function() {
   if(this.object.vertical) {
        this.piece.firstChild.setAttributeNS(null, 'width', CELLSIZE  + 'px');
        this.piece.firstChild.setAttributeNS(null, 'height', CELLSIZE * this.object.spaces + 'px');
    }
    else {
        this.piece.firstChild.setAttributeNS(null, 'width', CELLSIZE * this.object.spaces + 'px');
        this.piece.firstChild.setAttributeNS(null, 'height', CELLSIZE + 'px');
    }
}

/**
 * Loops through the amount of spaces in the current ship and checks to see
 * if the new position will have parts of the ship hanging off the board
 * or if one of the cells is already occupied by another ship
 * @this {Piece}
 * @return {boolean} if an invalid move
 */
Piece.prototype.isValidMove = function(row, col) {
    for(var k = 0; k < this.object.spaces; k++) {
        if(this.object.vertical == true) {
            //Check to see that the piece will fit on the board
            if(boardArr[row+k] === undefined) {
                return false;
            }
            //Check to see that those other pieces are not occupied
            if(boardArr[row+k][col].occupied != '') {
                return false;
            }
        }
        else {
            //Check to see if the piece will fit on the board
            if(boardArr[row][col+k] === undefined) {
                return false;
            }
            //Check to see that those other pieces are not occupied
            if(boardArr[row][col+k].occupied != '') {
                return false;
            }
        }
    }
}

/**
 * Creates a new Aircraft Carrier
 * @constructor
 * @param {Piece} parent
 * @this {AircraftCarrier}
 * @return {AircraftCarrier} Aircraft Carrier
 */
function AircraftCarrier(parent) {
    this.parent = parent;
    this.name = "Aircraft Carrier";
    this.life = 5;
    this.spaces = 5;
    this.vertical = this.parent.isVertical;
    this.cssClass = "piece_AircraftCarrier";

    Ship(this);

    return this;
}

/**
 * Creates a new Battleship
 * @constructor
 * @param {Piece} parent
 * @this {Battleship}
 * @return {Battleship} Battleship
 */
function Battleship(parent) {
    this.parent = parent;
    this.name = "Battleship";
    this.life = 4;
    this.spaces = 4;
    this.vertical = this.parent.isVertical;
    this.cssClass = "piece_Battleship";

    Ship(this);

    return this;
}

/**
 * Creates a new Cruiser
 * @constructor
 * @param {Piece} parent
 * @this {Cruiser}
 * @return {Cruiser} Cruiser
 */
function Cruiser(parent) {
    this.parent = parent;
    this.name = "Cruiser";
    this.life = 3;
    this.spaces = 3;
    this.vertical = this.parent.isVertical;
    this.cssClass = "piece_Cruiser";

    Ship(this);

    return this;
}

/**
 * Creates a new Submarine
 * @constructor
 * @param {Piece} parent
 * @this {Submarine}
 * @return {Submarine} Submarine
 */
function Submarine(parent) {
    this.parent = parent;
    this.name = "Submarine";
    this.life = 3;
    this.spaces = 3;
    this.vertical = this.parent.isVertical;
    this.cssClass = "piece_Submarine";

    Ship(this);

    return this;
}

/**
 * Creates a new Destroyer
 * @constructor
 * @param {Piece} parent
 * @this {Destroyer}
 * @return {Destroyer} Destroyer
 */
function Destroyer(parent) {
    this.parent = parent;
    this.name = "Destroyer";
    this.life = 2;
    this.spaces = 2;
    this.vertical = this.parent.isVertical;
    this.cssClass = "piece_Destroyer";

    Ship(this);

    return this;
}

/**
 * Creates a g tag with a rect tag inside of it which is the ship. Populates the
 * currentCell array. Positions the ship on the board
 * @param {AircraftCarrier, Battleship, Cruiser, Submarine, Destroyer} which
 */
function Ship(which) {

    which.piece = document.createElementNS(svgns, 'g');
    which.piece.setAttributeNS(null, 'style', 'cursor:pointer');
    which.piece.setAttributeNS(null, 'class', which.cssClass);
    var rect = document.createElementNS(svgns, 'rect');

    //Make rectangle on the board depending on the ships spaces
    if(which.vertical) {
        rect.setAttributeNS(null, 'width', CELLSIZE  + 'px');
        rect.setAttributeNS(null, 'height', CELLSIZE * which.spaces + 'px');
    }
    else {
        rect.setAttributeNS(null, 'width', CELLSIZE * which.spaces + 'px');
        rect.setAttributeNS(null, 'height', CELLSIZE + 'px');
    }

    //Add the new rectangle to the group
    which.piece.appendChild(rect);

    //Tell all the cells that they are occupied
    for(var i = 0; i < which.spaces; i++) {
        if(which.vertical) {
            which.parent.currentCell.push(boardArr[which.parent.cellRow + i][which.parent.cellCol]);
        }
        else {
            which.parent.currentCell.push(boardArr[which.parent.cellRow][which.parent.cellCol + i]);
        }

        which.parent.currentCell[i].isOccupied(which.parent.id);
    }

    which.parent.x = which.parent.currentCell[0].getTopLeftX();
    which.parent.y = which.parent.currentCell[0].getTopLeftY();

    which.piece.setAttributeNS(null, 'transform', 'translate(' + which.parent.x +', ' + which.parent.y + ')');
}

/**
 * Creates a new pin. Assigns currentCell. Tells the cell that it has a pin.
 * Creates the circles inside the g tag. Places it on the board.
 * @constructor
 * @param {Piece} parent
 * @this {Pin}
 * @return {Pin} Pin
 */
function Pin(parent) {
    this.parent = parent;
    this.piece = document.createElementNS(svgns, 'g');
    this.piece.setAttributeNS(null, 'class', 'piece_pin');
    var circle = document.createElementNS(svgns, 'circle');
    var darkerCircle = document.createElementNS(svgns, 'circle');

    //Override currentCell to a single cell (not an array)
    if (this.parent.board == "ship") {
        this.parent.currentCell = boardArr[this.parent.cellRow][this.parent.cellCol];
    }
    else if (this.parent.board == "guess") {
        this.parent.currentCell = board2Arr[this.parent.cellRow][this.parent.cellCol];
        
    }

    //Tell the cell it has a pin
    this.parent.currentCell.givePin(this.parent.id);

    //Get the middle the cell
    this.parent.x = this.parent.currentCell.getCenterX(this.parent.board);
    this.parent.y = this.parent.currentCell.getCenterY(this.parent.board);

    //Set the circle's radius and append to g tag
    var darkerCircleRadius = (CELLSIZE-5)/2;
    var circleRadius = (CELLSIZE-15)/2;
    circle.setAttributeNS(null, 'r', circleRadius + 'px');
    darkerCircle.setAttributeNS(null, 'r', darkerCircleRadius + 'px');
    this.piece.appendChild(darkerCircle);
    this.piece.appendChild(circle);

    //Move it to the right spot
    this.piece.setAttributeNS(null, 'transform', 'translate(' + this.parent.x +', ' + this.parent.y + ')');

    return this;
}