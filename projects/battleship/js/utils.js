//Still gets called on page refresh!
/*if(window.addEventListener) {
    //Not IE
    window.addEventListener("beforeunload", logoutUser, false);
}
else {
    //IE
    window.attachEvent("onbeforeunload", logoutUser);
}*/
//ajaxCall("GET", {service:"s", method:"m", data:"d"}, funcName);

function ajaxCall(GETPOST, d, callback) {
    $.ajax({
        type:GETPOST,
        data: d,
        url:"mid.php",
        dataType:'json',
        success:callback
    });
}

function ajaxCallWithOptions(GETPOST, d, callback, options) {
    $.ajax({
        type: GETPOST,
        data: d,
        url:"mid.php",
        dataType:'json',
        success: function(data){
            //not working here
            callback(data, options);
        }
    });
}

function logoutUser() {
    ajaxCall("GET", {
        method: "logoutUser",
        service: "chat",
        data: username
    }, logoutCallBack);
}

function logoutCallBack(data) {
    alert(data);
}

function getOnlineUsers() {
    ajaxCall("GET", {
        method: "getOnlineUsers", 
        service: "chat", 
        data:""
    }, callBackUsers);
}


function callBackUsers(data) {
    // have id, username, email, and room #
    var html = '';
    $('#users .online').html('');
    $('#users .offline').html('');
    for(var i = 0; i < data.length; i++) {
        if(data[i].username == username)
            continue;
        if(data[i].room == 0) {
            //User is logged in and in lobby
            html = '<p><span>' + data[i].username + '</span> - <button onclick="sendChallenge('+data[i].id+')">Challenge</button></p>';
            $('#users .online').append(html);
        }
        else if (data[i].room == null) {
            //User if offline
            html = '<p><span>' + data[i].username + '</span>';
            $('#users .offline').append(html);
        }
        else {
            html = '<p><span>' + data[i].username + ' - [Unavailable]</span>';
            $('#users .online').append(html);
        }
    }
    setTimeout('getOnlineUsers()', 15000);
}

function updateRoom(player, room) {
    ajaxCall("GET", {method: "changeRoom", service: "game", data: player + "_" + room}, callBackUpdateRoom);
}

function callBackUpdateRoom(data) {
    switch(data.newRoom) {
        case "0":
            window.location = "index.php";
    }
}

function updateToGameRoom(challengerId, challengedId) {
    var room = challengerId + "|" + challengedId;
    //ajaxCallWithOptions("GET", {method: "changeRoom", service: "game", data: username + "_" + room}, callBackUpdateToGameRoom, {challengerId: challengerId, challengedId: challengedId});
    $.ajax({
        type:"GET",
        data: {method: "changeRoom", service: "game", data: username + "_" + room},
        url:"mid.php",
        dataType:'json',
        success: function(data){
            callBackUpdateToGameRoom(data, challengerId, challengedId);
        }
    });
}

function callBackUpdateToGameRoom(data, challengerId, challengedId) {
    //data is updatedRows in the db
    redirectToGame(challengerId, challengedId);
}