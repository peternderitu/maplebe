<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends Model
{
    use HasFactory;

    protected $fillable = [ 'category_name', 'image_url' ];

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function micro_blogs()
    {
        return $this->hasMany(MicroBlog::class);
    }
}
