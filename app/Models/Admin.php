<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    // Hash otomatis setiap kali set password
    public function setPasswordAttribute($value)
    {
        // hindari double-hash jika sudah bcrypt
        $this->attributes['password'] =
            str_starts_with((string)$value, '$2y$') ? $value : Hash::make($value);
    }
}
