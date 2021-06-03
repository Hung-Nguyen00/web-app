<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'user_id',
        'title',
        'caption',
        'image',
        'category_id'
    ];

    function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    function user(){
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public  function ownPost(){
        return $this->user_id === auth()->id();
    }
    public function readBy(){
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }
    public function hasVouchers(){
        return $this->belongsToMany(Post::class,
            'vouchers',
            'post_id',
            'user_id')->withTimestamps();
    }

    public function existVoucher($id){
        return  Post::where('id', [$id])
            ->where('voucher_enable', '>', Carbon::now())
            ->where('voucher_quantity', '>', 0)
            ->get();
    }

}
