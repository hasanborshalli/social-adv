<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\FriendRequestAudience;
use App\Enums\PrivacyStatus;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

#[Fillable(['name', 'username', 'email', 'phone', 'password', 'bio', 'work', 'education', 'city', 'website', 'birthday', 'profile_pic', 'cover_photo', 'privacy_status', 'friend_request_audience'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthday' => 'date',
            'privacy_status' => PrivacyStatus::class,
            'friend_request_audience' => FriendRequestAudience::class,
        ];
    }

    // Relationships
    public function friendRequestsRecieved(): HasMany
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id');
    }

    public function friendRequestsSent(): HasMany
    {
        return $this->hasMany(FriendRequest::class, 'sender_id');
    }

    public function friends()
    {
        $friendsIds = $this->friendRequestsSent()->where('status', 'accepted')->pluck('receiver_id')
            ->merge($this->friendRequestsRecieved()->where('status', 'accepted')->pluck('sender_id'));

        return User::whereIn('id', $friendsIds);
    }

    public function isFriendWith(User $user): bool
    {
        return $this->friends()->where('id', $user->id)->exists();
    }

    public function hasMutual(User $user): bool
    {
        return $this->friends()->whereIn('id', $user->friends()->select('id'))->exists();
    }

    public function peopleYouMayKnow()
    {
        $friendsIds = $this->friends()->pluck('id');
        $pendingIds = $this->friendRequestsSent()->where('status', 'pending')->pluck('receiver_id')
            ->merge($this->friendRequestsRecieved()->where('status', 'pending')->pluck('sender_id'));
        $untriedFriendIds = $friendsIds->shuffle();
        $friends = collect();
        $tries = 0;
        while ($friends->count() < 3 && $tries < 3 && $untriedFriendIds->isNotEmpty()) {
            $tries++;
            $randomFriend = User::find($untriedFriendIds->shift());
            $friends = $randomFriend->friends()->where('id', '!=', $this->id)->whereNotIn('id', $friendsIds)->whereNotIn('id', $pendingIds)->limit(3)->get();
        }

        return $friends;
    }

    public function isRequestSentTo(User $user): bool
    {
        return $this->friendRequestsSent()->where('receiver_id', $user->id)->where('status', 'pending')->exists();
    }

    public function isRequestReceivedFrom(User $user): bool
    {
        return $this->friendRequestsRecieved()->where('sender_id', $user->id)->where('status', 'pending')->exists();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'likes')->withTimestamps();
    }

    public function hasLiked(Post $post): bool
    {
        return $this->likedPosts()->whereKey($post->id)->exists();
    }

    public function like(Post $post): void
    {
        $this->likedPosts()->syncWithoutDetaching([$post->id]);
    }

    public function unlike(Post $post): void
    {
        $this->likedPosts()->detach($post->id);
    }

    protected function profilePictureUrl(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->profile_pic
                ? Storage::disk('public')->url($this->profile_pic)
                : asset('assets/img/avatar-1.svg'),
        );
    }

    protected function coverPhotoUrl(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->cover_photo
                ? Storage::disk('public')->url($this->cover_photo)
                : asset('assets/img/cover.svg'),
        );
    }
}
