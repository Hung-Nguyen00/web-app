<?php

namespace App\Http\Controllers;

use App\User;
use App\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return view('users.showActiveUser',compact('users'));
    }

    public function edit(User $user){

        return view('users.edit', compact('user'));
    }

    public  function showVouchers(User $user){

        if (auth()->id() && $user->id == auth()->id()){
            $vouchers = DB::table('users as u')
                ->join('vouchers as v', 'u.id', '=', 'v.user_id')
                ->join('posts as p', 'p.id', '=', 'v.post_id')
                ->where('u.id', $user->id)
                ->select('p.voucher_enable as voucher_enable', 'v.voucher_code as code', 'p.voucher_quantity as voucher_quantity')
                ->get();
            return view('users.ownVouchers', compact('vouchers', 'user'));
        }
        return redirect()->back();
    }
}
