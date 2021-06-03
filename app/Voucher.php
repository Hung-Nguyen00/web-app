<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';

    protected $fillable = [
      'user_id',
      'post_id',
      'voucher_code',
    ];
}
