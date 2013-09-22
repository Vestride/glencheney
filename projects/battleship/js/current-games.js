var done = false;

function getCurrentGames() {
    ajaxCall("GET", {method: "currentGames", service: "game" , data: ""}, callBackGetCurrentGames);
}

function callBackGetCurrentGames(data) {
    var html = '<h3>Games in Progress</h3>';
    if(data !== false) {
        if(data.length > 2) {
            //Original plus each additional * 275
            var newHeight = 615 + ((data.length - 2) * 275);
            $('#container').css('height', newHeight + 'px');
        }
        for(var i in data) {
            html += '<div class="current_game">';
            var count = 0;
            var name1 = '';
            var name2 = '';
            var ptags = '';
            $.each(data[i], function(index, value){
                if(index == 'gameId') {
                    return 'continue';
                }
                ptags += '<p><strong>'+index+'\'s</strong> status: <br />'
                    + ' Aircraft Carrier ' + health(value.AircraftCarrier, "AircraftCarrier")
                    + '<br />Battleship ' + health(value.Battleship, "Battleship")
                    + '<br />Cruiser ' + health(value.Cruiser, "Cruiser")
                    + '<br />Submarine ' + health(value.Submarine, "Submarine")
                    + '<br />Destroyer ' + health(value.Destroyer, "Destroyer")
                    + '</p>';
                if (count == 0) {
                    name1 = index;
                } else if (count == 1) {
                    name2 = index;
                }
                count++;
            });
            html += '<h4>'+name1 + ' vs. ' + name2 + '</h4>';
            html += ptags;
            html += '</div>';
        }
    }
    else {
        //No games in progress
        html += "<p>No current games</p>";
    }
    
    //Animate the ajax if it's our first time here
    $('#current_games').html(html);
    if (!done) {
        $('#current_games').slideDown('', function(){
            $('#current_games').show();
        });
    }

    done = true;

    //Get an update every 15 seconds
    setTimeout('getCurrentGames()', 15000);
}

function health(currentHealth, ship) {
    currentHealth = parseInt(currentHealth);
    var totalHealth;
    var low;
    var high;
    switch(ship) {
        case "AircraftCarrier":
            totalHealth = 5;
            low = 2;
            high = 4;
            break;
        case "Battleship":
            totalHealth = 4;
            low = 2;
            high = 3;
            break;
        case "Cruiser":
        case "Submarine":
            totalHealth = 3;
            low = 2;
            high = 2;
            break;
        case "Destroyer":
            totalHealth = 2;
            low = 2;
            high = 2;
            break;
    }
    var html = '<meter value="'+currentHealth+'" min="0" max="'+totalHealth+'" low="'+low+'" high="'+high+'" optimum="'+totalHealth+'">'+currentHealth+'</meter>';
    //<meter value="3" min="0" max="5" low="2" high="4" optimum="5">3</meter>
    return html;

}