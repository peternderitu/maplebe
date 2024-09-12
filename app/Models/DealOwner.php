<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DealOwner extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'profile_picture',
        'payment_customer_id',
        'payment_saved_status'
    ];

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
