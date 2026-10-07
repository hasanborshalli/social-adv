<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_like_and_unlike_a_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $user->like($post);

        $this->assertTrue($user->hasLiked($post));
        $this->assertDatabaseHas('likes', ['user_id' => $user->id, 'post_id' => $post->id]);

        $user->unlike($post);

        $this->assertFalse($user->hasLiked($post));
        $this->assertDatabaseMissing('likes', ['user_id' => $user->id, 'post_id' => $post->id]);
    }

    public function test_liking_a_post_twice_only_counts_once(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $user->like($post);
        $user->like($post);

        $this->assertSame(1, $post->likes()->count());
    }

    public function test_the_database_rejects_duplicate_likes(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $user->likedPosts()->attach($post);

        $this->expectException(UniqueConstraintViolationException::class);

        $user->likedPosts()->attach($post);
    }

    public function test_the_like_button_toggles_a_like(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Livewire::actingAs($user)
            ->test('like-button', ['post' => $post])
            ->assertSet('isLiked', false)
            ->call('toggleLike')
            ->assertSet('isLiked', true)
            ->assertDispatched("like-toggled.{$post->id}")
            ->call('toggleLike')
            ->assertSet('isLiked', false);
    }

    public function test_the_like_button_shows_an_existing_like(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $user->like($post);

        Livewire::actingAs($user)
            ->test('like-button', ['post' => $post])
            ->assertSet('isLiked', true);
    }

    public function test_the_like_count_shows_the_number_of_likes(): void
    {
        $post = Post::factory()->create();
        User::factory()->count(2)->create()->each->like($post);

        Livewire::test('like-count', ['post' => $post])
            ->assertSee('2 likes');
    }

    public function test_the_like_count_refreshes_when_its_post_is_liked(): void
    {
        $post = Post::factory()->create();

        $likeCount = Livewire::test('like-count', ['post' => $post])
            ->assertSee('0 likes');

        User::factory()->create()->like($post);

        $likeCount->dispatch("like-toggled.{$post->id}")
            ->assertSee('1 like');
    }

    public function test_the_like_count_ignores_likes_on_other_posts(): void
    {
        $post = Post::factory()->create();
        $otherPost = Post::factory()->create();

        $likeCount = Livewire::test('like-count', ['post' => $post]);

        User::factory()->create()->like($post);

        $likeCount->dispatch("like-toggled.{$otherPost->id}")
            ->assertSee('0 likes');
    }

    public function test_users_cannot_like_a_post_they_cannot_see(): void
    {
        $stranger = User::factory()->create();
        $post = Post::factory()->private()->create();

        Livewire::actingAs($stranger)
            ->test('like-button', ['post' => $post])
            ->call('toggleLike')
            ->assertForbidden();

        $this->assertFalse($stranger->hasLiked($post));
    }
}
