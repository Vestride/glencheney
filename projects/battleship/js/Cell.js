/**
 * Creates a new cell object (board square) that you can reference from the game
 * @constructor
 * @param {DOMElement} parent DOM element to be appended to
 * @param {string} id unique id for the cell
 * @param {integer} size size of the cell
 * @param {integer} row row to be placed in
 * @param {integer} col column to be placed
 * @param {boolean} isGuesses is the guesses board?
 */
function Cell(parent, id, size, row, col, isGuesses) {
    this.parent = parent;
    this.id = id;
    this.size = size;
    this.row = row;
    this.col = col;
    this.isGuesses = isGuesses;

    //now initialize other instance vars
    this.occupied = '';
    this.pin = '';
    this.x = this.col * this.size;
    this.y = this.row * this.size;
    this.color = 'blue'; 

    this.object = this.create();
    this.parent.appendChild(this.object);
    this.myBBox = this.getMyBBox();
	
}

Cell.prototype.create = function() {
    var rect = document.createElementNS(svgns,'rect');
    rect.setAttributeNS(null, 'x', this.x + 'px');
    rect.setAttributeNS(null, 'y', this.y + 'px');
    rect.setAttributeNS(null, 'width', this.size + 'px');
    rect.setAttributeNS(null, 'height', this.size + 'px');
    rect.setAttributeNS(null, 'id', this.id);
    rect.setAttributeNS(null, 'class', 'cell_' + this.color);
    var row = this.row;
    var col = this.col;
    if(this.isGuesses) {
        rect.setAttributeNS(null, 'style', 'cursor:pointer');
        rect.onclick = function() {
            makeGuess(row, col);
        };
        //rect.onmouseover
        //rect.onmouseout little thing telling them the row/col
    }
    return rect;
}

//get my Bbox
Cell.prototype.getMyBBox = function() {
    return this.object.getBBox();
}

//get my center x (abs)
Cell.prototype.getCenterX = function(board) {
    if(board == 'ships') {
        return (BOARDX + this.x + (this.size/2));
    } else if (board == 'guess') {
        return (BOARD2X + this.x + (this.size/2));
    } else {
        return (BOARDX + this.x + (this.size/2));
    }
}

//get my center y (abs)
Cell.prototype.getCenterY = function(board){
    return (BOARDY+this.y+(this.size/2));
}

Cell.prototype.getTopLeftX = function() {
    return (BOARDX + this.x);
}

Cell.prototype.getTopLeftY = function() {
    return (BOARDY + this.y);
}

//set cell to occupied
Cell.prototype.isOccupied = function(pieceID){
    this.occupied = pieceID;
}

//empty cell
Cell.prototype.notOccupied = function(){
    this.occupied = '';
}

Cell.prototype.givePin = function(pinID) {
    this.pin = pinID;
}