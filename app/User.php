<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'last_login_at',
        'last_login_ip'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class, 'user_id');
    }

    public  function role(){
        return $this->belongsTo(Role::class);
    }

    public  function isOnline(){
        return Cache::has('user-is-online-'. $this->id);
    }


    public function getVouchers(){
        return $this->belongsToMany(Post::class, 'vouchers',
            'user_id','post_id')->withTimestamps();
    }

    public  function readPosts(){
        return $this->belongsToMany(Post::class, 'post_user', 'user_id', 'post_id');
    }
}
