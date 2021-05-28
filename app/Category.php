<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
class Category extends Model
{
    use NodeTrait;

    protected $fillable = [
            'name'
    ];

    public function posts(){
        return $this->hasMany(Post::class, 'category_id');
    }

}
