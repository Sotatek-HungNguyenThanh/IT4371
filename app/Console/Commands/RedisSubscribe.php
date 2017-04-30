<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use LRedis;

class RedisSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to a Redis channel';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        LRedis::subscribe(['XXX'], function ($message) {
            echo $message;
        });
        return;
    }
}