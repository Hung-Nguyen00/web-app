<?php

namespace App\Http\Controllers;

use App\Events\HasSomeOneReadPostEvent;
use App\Mail\HasSomeoneReadPost;
use App\Notifications\NotifyHasUserReadPost;
use App\Post;
use App\PostUser;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class PostUserController extends Controller
{
    public function store($id){
        $user = User::find(auth()->id());

        if($user->readPosts->contains($id)){
            return redirect()->route('posts.show', $id);
        }
        else{
            $getPost = Post::where('id', $id)->pluck('user_id');
            $user_post = User::whereId($getPost)->first();
            event(new HasSomeOneReadPostEvent($user_post, $user, $id));
            return redirect()->route('posts.show', $id);
        }
    }

    public function index(){

        $posts = Post::whereDoesntHave('readBy', function ($q){
            $q->where('user_id', auth()->id());
        })->whereNotIn('user_id', [auth()->id()])
            ->paginate(10);
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
