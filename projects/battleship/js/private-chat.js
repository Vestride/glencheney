function getPrivateChat() {
    ajaxCall("GET", {
        method: "getPrivateChat",
        service: "chat",
        data: challengerId + "|" + challengedId
    }, callBackGetPrivateChat);
}

function sendPrivateChat() {
    var message = $("#send input[name=message]").val();
    message = jQuery.trim(message);
    if(message != '') {
        ajaxCall("GET", {
            method: "sendPrivateChat",
            service: "chat",
            data: challengerId + "|" + challengedId + "|" + player1 + "|" + message
        }, null);
        $("#send input[name=message]").val('');
    }
}

function callBackGetPrivateChat(data) {
    var h = '';
    for(var i = data.length-1; i >= 0; i--) {
        h += '<span class="chat_username">' + data[i].username + '</span> <span class="chat_timestamp">(' + data[i].timestamp + ')</span>: ' + data[i].message + ' <br />';
    }
    $('#chat').html(h);
    setTimeout('getPrivateChat()', 2000);
}