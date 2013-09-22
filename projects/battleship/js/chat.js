function getChat() {
    ajaxCall("POST", {
        method: "getChat",
        service: "chat",
        data: ""
    }, callBackChat);
}

function sendChat() {
    var message = $("#send input[name=message]").val();
    message = jQuery.trim(message);
    if(message != '') {
        ajaxCall("POST", {
            method: "sendChat",
            service: "chat",
            data: username+"|"+message
        }, null);
        $("#send input[name=message]").val('');
    }
}

function callBackChat(data) {
    var h = '';
    for(var i = data.length-1; i >= 0; i--) {
        h += '<span class="chat_username">' + data[i].username + '</span> <span class="chat_timestamp">(' + data[i].timestamp + ')</span>: ' + data[i].message + ' <br />';
    }
    $('#chat').html(h);
    setTimeout('getChat()', 2000);
}