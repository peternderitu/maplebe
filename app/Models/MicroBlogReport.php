<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class MicroBlogReport extends Model
{
    use HasFactory;

    protected $fillable = ['micro_blogs_id', 'reporting_reasons_id', 'reason'];

    public function micro_blog() {
        return $this->belongsTo(MicroBlog::class);
    }

    public function reporting_reason() {
        return $this->belongsTo(ReportingReason::class);
    }
}
