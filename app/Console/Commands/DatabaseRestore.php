<?php

namespace App\Console\Commands;

use App\Database;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Exception;

class DatabaseRestore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:restore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run restore on database';

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
        try{
            //set filename with date and time of backup
            $storage = Database::orderBy('created_at', 'desc')->first();
            //mysqldump command with account credentials from .env file. storage_path() adds default local storage path
            $command = "mysql --user=" . env('DB_USERNAME_MASTER') . " --password=" . env('DB_PASSWORD_MASTER') . " --host=" . env('DB_HOST_MASTER') . " " . env('DB_DATABASE_MASTER') . "  < " . $storage->path;

            //exec command allows you to run terminal commands from php
            exec($command);
            //if nothing (error) is returned
        } catch(Exception $e) {
            // if there is an error send an email
            Log::error('There has been an error restore up the database:' . $e->getMessage());
        }
    }
}
