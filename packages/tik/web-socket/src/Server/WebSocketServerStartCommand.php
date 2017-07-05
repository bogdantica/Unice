<?php

namespace Tik\WebSocket\Server;

use Illuminate\Console\Command;

/**
 * Class WebSocketServerStartCommand
 * @package Tik\WebSocket\Server
 */
class WebSocketServerStartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ws:start {class=ControlWs} {--default=true}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start a WebSockets Server';

    /**
     * @var WebSocketServerAbstract
     */
    protected $serverInstance;

    /**
     * Create a new command instance.
     *
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     *
     */
    public function handle()
    {
        $class = $this->argument('class');
        $default = $this->option('default');
        $default = ($default == 'false' || $default == '0') ? false: true;

        if (!is_subclass_of($class, WebSocketServerAbstract::class)) {
            throw new \Exception('Class should extend: ' . WebSocketServerAbstract::class);
        }

        $protocol = config('control.uniceCommunication.connection.protocol', 'ws');
        $host = config('control.uniceCommunication.connection.host', '127.0.0.1');
        $port = config('control.uniceCommunication.connection.port', '9876');

        if (!$default) {
            $protocol = $this->ask('Protocol:', $protocol);
            $host = $this->ask('Host:', $host);
            $port = $this->ask('Port:', $port);
        }

        $this->serverInstance = new $class($protocol, $host, $port);

        $this->alert('WebSockets Server Started on: ' . $this->serverInstance->getURI());

        $this->serverInstance->run();
    }
}
