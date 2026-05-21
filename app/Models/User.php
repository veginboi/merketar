<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['username', 'email', 'password_hash', 'role', 'status', 'picture'];

    protected $hidden = ['password_hash', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function merketarAccount()
    {
        return $this->hasOne(MerketarAccount::class);
    }

    public function store()
    {
        return $this->hasOne(Store::class, 'seller_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }
}
