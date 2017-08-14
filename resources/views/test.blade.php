<script>

    var tries = 0;

    function startWsConnection() {

        var url = 'ws://unice1.tk/ws';

        var startedAt = new Date();

        var timestamp = startedAt.getTime();

        ws = new WebSocket(url);

        ws.onopen = function () {

            console.log('Started at: ' + getTime());

            tries = 0;

        };

        ws.onclose = function (event) {
            console.log('Closed at:' + getTime());

            console.log('Closed after: ' + timeDiff(timestamp) + ' seconds');

            console.log(event);
            restart();
        };

        ws.onerror = function () {
            console.log('Error at:' + getTime());

            var closedAt = new Date();

            console.log('Error after: ' + timeDiff(timestamp) + ' seconds');

            console.log(event);

            restart();
        };
    }


    function timeDiff(startedAt) {

        var now = new Date();

        return (now.getTime() - startedAt) / 1000;

    }

    function getTime() {
        var time = new Date();

        return time.getHours() + ':' + time.getMinutes() + ':' + time.getSeconds() + "\n" +

            time.getDay() + '-' + time.getMonth() + '-' + time.getFullYear()
            ;

    }

    var timer;


    function restart() {

        timer = setTimeout(function () {

            clearTimeout(timer);
            tries ++;

            if (tries >= 15) {
                return;
            }

            startWsConnection();

        }, 100);

    }

    startWsConnection();

</script>