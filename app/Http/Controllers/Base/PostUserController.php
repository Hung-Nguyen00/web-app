<?php

namespace App\Http\Controllers\Base;

use App\Notifications\NotifyHasUserReadPost;
use App\Post;
use App\PostUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Global_;

class PostUserController extends BaseController
{
    public function store($id){
        $user = User::find(auth()->id());

        if($user->readPosts->contains($id)){
            return redirect()->route('posts.show', $id);
        }
        else{
            $user->readPosts()->attach($id);

            return redirect()->route('posts.show', $id);
        }
    }

    public function index(){

        $posts = Post::whereDoesntHave('readBy', function ($q){
            $q->where('user_id', auth()->id());
        })->whereNotIn('user_id', [auth()->id()])
            ->get();
        return view('posts.latest', compact('posts'));
    }

    public  function show($id){

        $user = User::find($id)->first();
        $posts = Post::where('user_id', [$id])->get();
        return view('users.ownposts',[
            'posts' => $posts,
            'user' => $user,
        ]);
    }

    public function destroy($id){
        $post = Post::find($id);

        $post->delete();
        return redirect()->back();
    }
}
