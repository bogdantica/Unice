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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {

    $unice = \App\Models\Unice\Unice::with([
        'type',
        'type.unices',
        'devices',
        'devices.unice',
        'devices.type',
        'devices.type.devices',
        'devices.state',
        'devices.state.device',
    ])
        ->first();

    dd($unice->toArray());

});
