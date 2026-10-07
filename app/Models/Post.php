<?php

namespace App\Models;

use App\Enums\PrivacyStatus;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

#[Fillable(['shared_post_id', 'body', 'media_path', 'media_type', 'privacy_status'])]
class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'privacy_status' => PrivacyStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The original post this post is a share of, if any.
     */
    public function sharedPost(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'shared_post_id');
    }

    /**
     * The posts that share this post.
     */
    public function shares(): HasMany
    {
        return $this->hasMany(Post::class, 'shared_post_id');
    }

    public function isShare(): bool
    {
        return $this->shared_post_id !== null;
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    /**
     * Every comment on the post, including replies at any depth.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Only the comments made directly on the post, not replies.
     */
    public function topLevelComments(): HasMany
    {
        return $this->comments()->whereNull('comment_id');
    }

    /**
     * The number of likes, read from an eager-loaded `withCount('likes')` when available.
     */
    protected function numOfLikes(): Attribute
    {
        return Attribute::make(
            get: fn (): int => array_key_exists('likes_count', $this->attributes)
                ? (int) $this->attributes['likes_count']
                : $this->likes()->count(),
        );
    }

    /**
     * The number of shares, read from an eager-loaded `withCount('shares')` when available.
     */
    protected function numOfShares(): Attribute
    {
        return Attribute::make(
            get: fn (): int => array_key_exists('shares_count', $this->attributes)
                ? (int) $this->attributes['shares_count']
                : $this->shares()->count(),
        );
    }

    protected function mediaUrl(): Attribute
    {
        return Attribute::make(
            get: fn (): ?string => $this->media_path
                ? Storage::disk('local')->temporaryUrl($this->media_path, now()->addHour())
                : null,
        );
    }
}
