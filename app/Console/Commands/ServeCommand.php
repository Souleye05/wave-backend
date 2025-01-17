<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ServeCommand extends Command
{
    protected $signature = 'serve';
    protected $description = 'Serve the application on the PHP development server';

    public function handle()
    {
        $port = config('server.port', 9002);
        $host = config('server.host', '192.168.1.15');

        $this->info("Laravel development server started on http://{$host}:{$port}");

        $process = new Process(['php', '-S', "{$host}:{$port}", '-t', 'public']);
        $process->setTimeout(null);
        $process->run(function ($type, $buffer) {
            $this->output->write($buffer);
        });
    }
}