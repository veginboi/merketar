<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerketarAccount extends Model
{
    protected $fillable = [
        'user_id','account_number','account_fullname','balance','currency','account_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
