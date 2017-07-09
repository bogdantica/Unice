function WsConnect() {

    var plugin = this;

    var url = 'ws://127.0.0.1:9876';

    var ws;

    plugin.connect = function () {

        ws = new WebSocket(url);

        ws.onopen = function (e) {
            console.log("Open", e);
        };

        ws.onclose = function (e) {
            console.log("Close", e);
        };

        ws.onmessage = function (e) {
            console.log("Message", JSON.parse(e.data));
        };

        ws.onerror = function (e) {
            console.log("Error", e);
        };
    };


    plugin.send = function (message) {
        ws.send(JSON.stringify(message));
    }


}


function DummyUnice(uid, ws) {

    var unice = this;

    unice.uid = uid;

    unice.devices = {
        "room_light_1234": {
            "uid": "room_light_1234",
            "device_name": "room_light",
            "state": {
                "state": 5,
                "target": 0
            }
        }
    };

    //join
    ws.send({
        "type": 100,
        "sender": unice.uid
    });

    //initial report
    ws.send({
        "type": 250,
        "sender": unice.uid,
        "payload": {
            "devices": unice.devices
        }
    });

}

var wsConn = new WsConnect();

$('#connect').click(function () {
    wsConn.connect();
});

$('#disconect').click(function () {
    wsConn.ws.close();
});


$('#start').click(function () {
    $dummyUnice = new DummyUnice('rin_unice_1234', wsConn);
});

