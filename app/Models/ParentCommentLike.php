<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ParentCommentLike extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'parent_comment_id'];

    public function parentComment()
    {
        return $this->belongsTo(ParentComment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
