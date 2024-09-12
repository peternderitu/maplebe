<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParentComment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'micro_blog_id', 'content'];

    // belongs to users, microblogs
    // has many replies, parent comment likes, parent coment
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function microBlog()
    {
        return $this->belongsTo(MicroBlog::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function parentCommentLike()
    {
        return $this->hasMany(ParentCommentLike::class);
    }

    public function parentCommentDislike()
    {
        return $this->hasMany(ParentCommentDislike::class);
    }
}
