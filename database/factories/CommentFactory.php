<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
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
            'post_id' => Post::factory(),
            'comment_id' => null,
            'body' => fake()->sentence(),
        ];
    }

    /**
     * Indicate that the comment is a reply to the given comment, on the same post.
     */
    public function replyTo(Comment $comment): static
    {
        return $this->state(fn (array $attributes) => [
            'post_id' => $comment->post_id,
            'comment_id' => $comment->id,
        ]);
    }
}
