<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'deal_owner_id',
        'admin_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'original_price',
        'discount',
        'discounted_price',
        'image_url',
        'logo_url',
        'brand_name',
        'discount_code',
        'discount_url',
        'unique_deal_identifier'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function dealOwner()
    {
        return $this->belongsTo(DealOwner::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function transactions()
    {
        return $this->hasMany(UserTransaction::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}