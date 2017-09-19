<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Custom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom {class} {--method?}';

    protected $class;
    protected $method = 'handle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instance given class and call handle() or given method.';

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
        $this->class = $this->argument('class');
        $this->method = $this->hasOption('method') ? $this->option('method') : $this->method;

        try {
            $object = app($this->class);
            $object->{$this->method}();
        } catch (\Exception $e) {
            $this->line('There has ben an error:');
            $this->error($e->getMessage());
            $this->line($e->getTraceAsString());
        }

        $this->info($this->class . "->" . $this->method . '() ended');
    }
}
