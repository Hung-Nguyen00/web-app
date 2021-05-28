<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'user_id',
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
}
