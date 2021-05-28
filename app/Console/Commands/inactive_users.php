<?php

namespace App\Console\Commands;

use App\Notifications\NotifyInactiveUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class inactive_users extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactive_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email inactive users';

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
        $limit = Carbon::now()->subDay(1);
        $inactive_user = User::where('last_login_at', '<', $limit)->get();
        foreach ($inactive_user as $user) {
            $user->notify(new NotifyInactiveUser());
        }
    }
}
