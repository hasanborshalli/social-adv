<?php

namespace Database\Factories;

use App\Enums\PrivacyStatus;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'body' => fake()->paragraph(),
            'media_path' => null,
            'media_type' => null,
            'privacy_status' => PrivacyStatus::Public,
        ];
    }

    /**
     * Indicate that the post has an attached image.
     */
    public function withImage(): static
    {
        return $this->state(fn (array $attributes) => [
            'media_path' => 'posts/images/'.fake()->uuid().'.jpg',
            'media_type' => 'image',
        ]);
    }

    /**
     * Indicate that the post has an attached video.
     */
    public function withVideo(): static
    {
        return $this->state(fn (array $attributes) => [
            'media_path' => 'posts/videos/'.fake()->uuid().'.mp4',
            'media_type' => 'video',
        ]);
    }

    /**
     * Indicate that the post is only visible to its author.
     */
    public function private(): static
    {
        return $this->state(fn (array $attributes) => [
            'privacy_status' => PrivacyStatus::Private,
        ]);
    }

    /**
     * Indicate that the post is a share of another post.
     */
    public function sharing(Post $post): static
    {
        return $this->state(fn (array $attributes) => [
            'shared_post_id' => $post->id,
        ]);
    }

    /**
     * Indicate that the post has no text body.
     */
    public function withoutBody(): static
    {
        return $this->state(fn (array $attributes) => [
            'body' => null,
        ]);
    }
}
