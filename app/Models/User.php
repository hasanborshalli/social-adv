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

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
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
