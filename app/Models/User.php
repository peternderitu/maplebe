<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{   
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'studentEmail',
        'password',
        'first_name',
        'last_name',
        'profile_picture',
    ];
    
    public function micro_blogs()
    {
        return $this->hasMany(MicroBlog::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function transactions()
    {
        return $this->hasMany(UserTransaction::class);
    }
}
