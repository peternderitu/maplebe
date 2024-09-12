<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'deal_owner_id',
        'quantity',
        'deal_id',
        'amount',
    ];

    public function dealOwner()
    {
        return $this->belongsTo(DealOwner::class);
    }
    
    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }
}
