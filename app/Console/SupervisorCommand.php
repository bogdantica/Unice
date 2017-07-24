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
    protected $user = 'serverpilot';

    /**
     * @var Collection
     */
    protected $workers = [];

    STATIC $supervisorConfPath = '/etc/supervisor/conf.d/';

    /**
     *
     */
    protected function workers()
    {
        $this->workers = collect([
            (object)[
                'program' => 'unice-worker',
                'threads' => 3,
                'options' => collect([
                    '--daemon' => '',
                    '--tries' => 1,
                    '--sleep' => 5,
                    '--timeout' => 60
                ])
            ]
        ]);

        return $this;
    }

    /**
     *
     */
    protected function rebuildFiles()
    {
        $this->workers->each(function ($worker) {
            $command = $this->php;
            $command .= ' ' . base_path();
            $command .= '/artisan queue:work';

            $worker->options->each(function ($value, $option) use (&$command) {
                $command .= ' ' . $option;

                if ($value != '') {
                    $command .= '=' . $value;
                }

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

            echo $fileContent;

            $this->rebuildFile($worker->program, $fileContent);

        });

        return $this;
    }

    protected function rebuildFile($fileName, $content)
    {
        $path = static::$supervisorConfPath . "$fileName.conf";

        $file = fopen($path, 'w+');
        fwrite($file, $content);
        fclose($file);

    }

    protected function reloadProcesses()
    {
        system("sudo supervisorctl reread");
        system("sudo supervisorctl update");

        $this->workers->each(function ($worker) {
            $programName = $worker->program . ':*';
            system("sudo supervisorctl start $programName");
        });

        \Artisan::call('queue:restart');

        $this->info('Queues restarted.');
    }

    /**
     * Execute the console command.
     *
     *
     */
    public function handle()
    {
        $this->workers()
            ->rebuildFiles()
            ->reloadProcesses();
    }
}
