<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;

/**
 * Class WebSocketServerStartCommand
 * @package Tik\WebSocket\Server
 */
class SupervisorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spv:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuild Supervisor Files ';

    /**
     * @var string
     */
    protected $php = 'php';

    /**
     * @var string
     */
    protected $queue = '';

    /**
     * @var string
     */
    protected $user = 'supervisor';

    /**
     * @var Collection
     */
    protected $workers = [];

    /**
     *
     */
    protected function workers()
    {
        $this->workers = collect([
            (object)[
                'program' => 'default-worker',
                'threads' => 3,
                'options' => collect([
                    '--tries' => 1,
                    '--daemon' => true,
                    '--sleep' => 5,
                    '--timeout' => 60
                ])
            ]
        ]);

        $this->rebuildFiles();
    }

    /**
     *
     */
    protected function rebuildFiles()
    {
        $this->workers->each(function ($worker) {
            $command = $this->php . ' artisan queue:work';

            $worker->options->each(function ($value, $option) use (&$command) {
                $command .= ' ' . $option . '=' . $value;
            });

            $output = storage_path('logs/' . $worker->program . '.log');

            $fileContent = '' .
                "[program:$worker->program]" . "\n" .
                "process_name=%(program_name)s_%(process_num)02d " . "\n" .
                "command=$command" . "\n" .
                "autostart=true" . "\n" .
                "autorestart=true" . "\n" .
                "user=$this->user" . "\n" .
                "numprocs=$worker->threads" . "\n" .
                "redirect_stderr=true" . "\n" .
                "stdout_logfile=$output" . "\n";

            $this->rebuildFile($worker->program, $fileContent);

        });
    }

    protected function rebuildFile($fileName, $content)
    {
        $path = "/etc/supervisor/conf.d/$fileName.conf";

        $file = fopen($path, 'w+');
        fwrite($file, $content);
        fclose($file);

    }

    protected function reloadProcesses()
    {

    }


    /**
     * Execute the console command.
     *
     *
     */
    public function handle()
    {
        $this->workers();


    }
}
