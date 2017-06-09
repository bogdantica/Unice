<?php


function clientTes()
{

//    echo json_encode((object)[
//        'code' => \App\Control\WebSocket\Message\Message::UID_CHECK,
//        'sender' => 'app',
//        'payload' => (object)[
//            'uniceId' => 'unice'
//        ]
//    ]);

    $client = new App\Control\WebSocket\Client\Client();

    $message = new \App\Control\WebSocket\Message\Message([
        'code' => \App\Control\WebSocket\Message\Message::APP_TO_UNICE,
        'sender' => 'app',
        'payload' => 'payload din aplicatie'
    ]);

//    $client->newConnection();
    $client->send($message, 'unice123');

}