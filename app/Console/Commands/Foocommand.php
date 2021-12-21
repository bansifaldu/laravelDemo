<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class Foocommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update_user_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Foocommand';

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
     * @return int
     */
    public function handle()
    {
         User::where("id",23)->update(['status' => '1']);
    }
}
