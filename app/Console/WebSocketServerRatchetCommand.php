<?php

namespace App\Console;

use App\Control\WebSocket\Server\Ratchet\RatchetServer;
use Illuminate\Console\Command;
use Ratchet\Server\IoServer;

/**
 * Class WebSocketServerStartCommand
 * @package Tik\WebSocket\Server
 */
class WebSocketServerRatchetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ws:ratchet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start WebSocket Server Ratchet ';

    /**
     * Execute the console command.
     *
     *
     */
    public function handle()
    {

        $server = IoServer::factory(
            new RatchetServer(),
            9876,
            '127.0.0.1'
        );

        $server->run();
    }
}
