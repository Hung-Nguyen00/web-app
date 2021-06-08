<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PostUser extends Model
{
    use Notifiable;
    protected $table = 'post_user';

    protected $fillable = [
        'user_id',
        'post_id'
    ];
}
