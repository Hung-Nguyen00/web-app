<?php

namespace App\Http\Controllers\Base;

use App\Permission;
use App\PermissionRole;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionRoleController extends BaseController
{
    protected $module = 'role_permission';
    public function index()
    {
        $users = User::with('role')->orderBy('role_id', 'DESC')->paginate(10)->fragment('users');
        $roles = Role::all();
        return view('Admin.permission_role.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = DB::table('permissions_roles as pr')
            ->join('permissions as p', 'p.id', '=', 'pr.permission_id')
            ->select('*', 'p.name as permission_name', 'pr.id as permissions_role_id')
            ->where('pr.role_id', '=', $id)
            ->get();
        $role = Role::whereId($id)->first();
        $roles = Role::all();
        return view('Admin.permission_role.show', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission_role = PermissionRole::whereId($id);
        $permission_role->update(
         [
            'write_able' => $request->boolean('write_able'),
            'read_able' => $request->boolean('read_able'),
            'adjust_able' => $request->boolean('adjust_able'),
            'cancel_able' => $request->boolean('cancel_able'),
             'update_date' => Carbon::now(),
        ]);
        return redirect()->back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
