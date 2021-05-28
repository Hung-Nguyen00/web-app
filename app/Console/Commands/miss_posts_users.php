<?php

namespace App\Console\Commands;

use App\Notifications\NotifyMissPostUser;
use App\Post;
use App\PostUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class miss_posts_users extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:miss_post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Some posts was missed';

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
        $users = DB::table('users') ->pluck('id')->toArray();

        foreach ($users as $user){
            $postUsers = PostUser::whereUserId($user)->pluck('post_id');
            $posts = Post::whereNotIn('id', $postUsers)->pluck('id');
            if($posts->count() > 0){
                $notfiUser = User::find($user);
                $notfiUser->Notify( new NotifyMissPostUser());
            }
        }
    }
}
