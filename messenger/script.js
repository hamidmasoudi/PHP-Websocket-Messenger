var xsocket = 'ws://localhost:8080/messenger/server.php';
xwebsocket = new WebSocket(xsocket);

xwebsocket.onopen = function () {
    document.getElementById('xboxmessages').innerHTML += '<div class="xmessege" style="color: darkgreen;">connection open</div>';
};

xwebsocket.onclose = function () {
    document.getElementById('xboxmessages').innerHTML += '<div class="xmessege" style="color: darkred;">connection error</div>';
};

xwebsocket.onclose = function () {
    document.getElementById('xboxmessages').innerHTML += '<div class="xmessege" style="color: darkred;">connection close</div>';
};

xwebsocket.onmessage = function (event) {
    var response = JSON.parse(event.data);
    if (response.message) {
        if (response.name === 'system' && response.message.includes('new user connected')) {
            document.getElementById('xboxmessages').innerHTML += '<div class="xmessege" style="color: darkgreen;">' + response.message + '</div>';
        } else if (response.name === 'system' && response.message.includes('a user disconnected')) {
            document.getElementById('xboxmessages').innerHTML += '<div class="xmessege" style="color: darkred;">' + response.message + '</div>';
        } else {
            document.getElementById('xboxmessages').innerHTML += '<div class="xmessege" style="color: darkblue;">' + response.name + ' : ' + response.message + '</div>';
        }
    }
    document.getElementById('xboxmessages').scrollTop = document.getElementById('xboxmessages').scrollHeight;
};

function xmessagesend() {
    var data = {name: document.getElementById('xboxname').value, message: document.getElementById('xboxmessege').value};
    xwebsocket.send(JSON.stringify(data));
}
document.getElementById('xboxmessege').addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
        xmessagesend();
    }
});
