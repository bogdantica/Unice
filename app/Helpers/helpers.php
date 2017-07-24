<?php


function routeUses($class, $method, $extra = '')
{
    return $class . '@' . $method . $extra;
}


function isActiveRoute($route)
{
    return Route::getCurrentRoute() == $route;
}

function clientTes()
{


    $client = new App\Control\WebSocket\Client\UniceBase();




    $unice = \App\Control\Unice\SDK\Unice\Unice::getByUid('rin_unice_1234');


    $payload = new \App\Control\Unice\SDK\Message\Payload\Payload($unice);

    $message = new \App\Control\Unice\SDK\Message\UniceMessage([
        'receiver' => 'rin_unice_1234',
        'code' => \App\Control\Unice\SDK\Message\UniceMessage::BASE_TO_UNICE,
        'payload' => $payload
    ]);


//    $client->newConnection();
    $client->send($message);

}