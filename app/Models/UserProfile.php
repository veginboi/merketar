<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id','first_name','last_name','middle_name','phone_code',
        'phone_number','gender','date_of_birth','address_line','state',
        'city','postal_code','country','nationality',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
