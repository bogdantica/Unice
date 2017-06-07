<?php

namespace Tik\WebSocket\Server;

use Control\WebSocket\DevicesServer;
use Illuminate\Console\Command;

class WebSocketServerStartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ws:start {class} {default?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start a WebSockets Server';

    protected $serverInstance;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $class = $this->argument('class');

        if(!is_subclass_of($class,WebSocketServerAbstract::class)){
            throw new \Exception('Class should extend: ' . WebSocketServerAbstract::class);
        }

        $protocol = 'ws';
        $ipDomain = '127.0.0.1';
        $port = '80';

        if(!$this->argument('default')){
            $protocol = $this->ask('Protocol:',$protocol);
            $ipDomain = $this->ask('Ip/Domain:',$ipDomain);
            $port = $this->ask('Port:',$port);
        }

        $this->serverInstance = new $class($protocol,$ipDomain,$port);

        $this->alert('WebSockets Server Started on: ' . $this->serverInstance->getURI());

        $this->serverInstance->run();
    }
}
