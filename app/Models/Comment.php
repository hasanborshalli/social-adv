<?php

namespace App\Models;

use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * A comment on a post. When comment_id is set, the comment is a reply to
 * that comment, so replies can nest to any depth within the same table.
 */
#[Fillable(['body', 'post_id', 'comment_id'])]
class Comment extends Model
{
    /** @use HasFactory<CommentFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * The comment this comment replies to, if any.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    /**
     * The direct replies to this comment.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }

    public function isReply(): bool
    {
        return $this->comment_id !== null;
    }
}
