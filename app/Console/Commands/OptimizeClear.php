<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OptimizeClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimize:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all cache in the application';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->call('view:clear');
        $this->call('route:clear');
        $this->call('config:clear');
        $this->call('cache:clear');
        $this->info('All cache cleared successfully!');
        
        return 0;
    }
}