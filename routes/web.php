<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group([], function () {

    Route::get('/unices', [
        'as' => 'unice.all',
        'uses' => 'Unice\UniceController@all'
    ]);

    Route::get('/unice/{unice}', [
        'as' => 'unice.unice',
        'uses' => 'Unice\UniceController@unice'
    ]);

    Route::post('/unice/device/update-state', [
        'as' => 'unice.device.update-state',
        'uses' => 'Unice\UniceController@updateState'
    ]);

});


Route::get('/dummyUnice', function () {
    return view('dummyUnice');
});

Route::get('/', function () {
    return view('welcome');
});



Route::get('/test', function () {





    $payload = '{"devices":{"room_light_1234":{"uid":"room_light_1234","device_name":"room_light","state":{"state":3,"target":2}}},"commands":[]}';

    $payload = new \App\Control\Unice\SDK\Message\Payload\Payload($payload);

    $unice = \App\Control\Unice\SDK\Unice\Unice::getByUid('rin_unice_1234');


    $unice->handlePayload($payload);






//    $socket = new \Hoa\Socket\Server('ws://127.0.0.1');
//    $serve = new \Hoa\Websocket\Server($socket);
//
//
//    $node = new \App\Control\WebSocket\Server\UniceNode('', $serve, $socket);
//
//    $message = new \App\Control\Unice\SDK\Message\UniceMessage('{"code":100,"sender":"base_client_12349876","receiver" : "rin_unice_1234"}');
//
//    $node->join($serve, $message, collect());


});


//Route::get('/home', 'HomeController@index')->name('home');
