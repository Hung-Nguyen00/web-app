<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailer extends Model
{
    protected $fillable = [
      'recipient_id',
      'pending',
        'sending',
        'done',
        'error',
    ];
}
