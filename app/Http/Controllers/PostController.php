<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use App\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    protected $module = 'posts';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::id())
        {
        $this->validate($request,  [
            'caption' => ['required', 'max:50'],
            'title' => ['required'],
            'image' => ['required', 'image'],
            'category' => 'required'
        ]);

        // save image to  storage/public/uploads.
        $imagePath = $request->image->store('uploads','public');
            // Intervention\Image\Facades\Image;
            // save to storage
        $image = Image::make(storage_path('app/public/'.$imagePath))->fit(1000, 1000);
        $image->save();
        // auth before save request->all to database.
        Auth::user()->posts()->create([
                'caption' => $request->caption,
                'image' => $imagePath,
                'title' => $request->title,
                'category_id' => $request->category,
            ]
        );

        // be like $request->user()->id
        return redirect()->route('posts.index')
            ->with('success', 'A new post posted successfully');
        }else
        {
            return view('auth.login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // user collect First to relate eloquent relationship
        $post = Post::where('id',$id)->first();
        $user = User::where('id',auth()->id())->first();
        // check user has voucher ?
        if(\auth()->user())
        {
            $vouchers = Voucher::where('user_id', $user->id)->where('post_id', $id);
            $existVoucher = (new Post())->existVoucher([$post->id]);

            // if existVoucher is still enable.
            if($existVoucher->count() > 0){
                //if user has voucher, then return voucher_code has been in db
                if($vouchers->count() > 0){
                    $voucher_code = $vouchers->first()->voucher_code;
                    return view('posts.detail')
                        ->with([
                            'voucher' => $voucher_code,
                            'post' => $post,
                        ]);
                }else{
                    // else User get voucher
                    return view('posts.detail')
                        ->with([
                            'voucher' => null,
                            'post' => $post,
                        ]);
                }
            }else{
                // if voucher is unable will return message.
                return view('posts.detail')
                    ->with([
                        'voucher' => 'There is no more available voucher.',
                        'post' => $post,
                    ]);
            }
        }else
        {
            dd($post);
            return view('posts.detail')
                ->with([
                    'post' => $post,
                ]);
        }
        // check Voucher with voucher_enable and voucher_quantity field

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function search(Request $request){
        $posts = Post::where('title', 'LIKE', '%'.$request->search_post.'%')->paginate(20);
        return view('posts.search', compact('posts'));
    }
}
