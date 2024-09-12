<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Reply extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'parent_comment_id', 'content'];

    // belongs to user and to parent comment
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parentComment()
    {
        return $this->belongsTo(ParentComment::class);
    }
}
