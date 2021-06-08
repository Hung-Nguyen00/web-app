<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class VoucherController extends Controller
{

    public function index()
    {
        $posts = Post::all();

        return view('Admin.voucher.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find(auth()->id());
        $post = Post::find($request->post_id);
        // create random voucher_code
        $voucher_code = Str::random(10);
        $user->getVouchers()->attach($request->post_id, ['voucher_code' => $voucher_code]);
        if($post){
            $voucher_quantity = $post->voucher_quantity -1;
            $post->voucher_quantity = $voucher_quantity;
            $post->save();
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Post $voucher)
    {
         $vouchers = Voucher::wherePostId($voucher->id)->get();
         $users = User::with('getVouchers')->get();

        return view('Admin.voucher.detail', compact('vouchers', 'users'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $voucher)
    {
        $post = $voucher;
        return view('Admin.voucher.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $voucher)
    {

        $this->validate($request, [
            'caption' => 'required',
            'voucher_quantity' => 'required|min:0|numeric',
            'voucher_enable' => 'required|date|after:today',
        ]);
        $voucher->title = $request->title;
        $voucher->voucher_quantity = $request->voucher_quantity;
        $voucher->voucher_enable = $request->voucher_enable;
        $voucher->caption = $request->caption;
        $voucher->save();
        return redirect()->route('vouchers.edit', compact('voucher'))
            ->with('success', 'Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->back();
    }
}
