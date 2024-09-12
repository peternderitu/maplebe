<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class ReportingReason extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function micro_blog_reports()
    {
        return $this->hasMany(MicroBlogReport::class);
    }
}
