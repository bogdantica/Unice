<?php

namespace Tik\WebSocket\Server;

use Illuminate\Support\ServiceProvider;

class WebSocketServerServiceProvider extends ServiceProvider
{
    protected $commands = [
        WebSocketServerStartCommand::class
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
