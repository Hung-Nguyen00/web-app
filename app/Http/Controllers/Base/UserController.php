<?php

namespace App\Http\Controllers\Base;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\User;
use App\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends BaseController
{
    protected $module = 'users';

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

    public function export(){
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import(Request $request){
        $this->validate($request, [
           'file' => 'required|file'
        ]);
        try
        {
            Excel::import(new UsersImport, \request()->file('file'));

        }
        catch (\Exception $ex){
            return back()->with('success', 'Some thing is wrong');
        }

        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function update(Request $request, User $user){

        $data = $request->except('_token','_method');
        $user->update($data);
        return redirect()->back()->with('success', 'updated successfully');
    }
}
