<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermissionRole extends Model
{
    protected $table = 'permissions_roles';

    protected $fillable = [
      'role_id',
      'permission_id',
        'user_id',
        'read_able',
        'remove_able',
        'write_able',
        'adjust_able',
        'cancel_able',
        'export_able',

    ];

    public static function getPermissions($role_id){
        $permissions = [];

        $items = DB::table('permissions_roles as pr')
            ->select('pr.*', 'p.name' )
            ->join('permissions as p', 'p.id', '=', 'pr.permission_id')
            ->where('pr.role_id', $role_id)
            ->get();
        foreach ($items as $item){
            if($item->read_able){
                $permissions[] = $item->name.'.'.'read_able';
            }
            if($item->write_able){
                $permissions[] = $item->name.'.'.'write_able';
            }
            if($item->adjust_able){
                $permissions[] = $item->name.'.'.'adjust_able';
            }
            if($item->remove_able){
                $permissions[] = $item->name.'.'.'remove_able';
            }
            if($item->cancel_able){
                $permissions[] = $item->name.'.'.'cancel_able';
            }
            if($item->cancel_able){
                $permissions[] = $item->name.'.'.'export_able';
            }
        }
        return $permissions;
    }
}
