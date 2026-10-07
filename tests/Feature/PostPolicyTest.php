<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class PostPolicyTest extends TestCase
{
    use RefreshDatabase;

    private function makeFriends(User $first, User $second): void
    {
        $first->friendRequestsSent()->create(['receiver_id' => $second->id, 'status' => 'accepted']);
    }

    public function test_anyone_can_see_a_public_post(): void
    {
        $post = Post::factory()->create();
        $stranger = User::factory()->create();

        $this->assertTrue($stranger->can('view', $post));
    }

    public function test_guests_can_see_a_public_post(): void
    {
        $post = Post::factory()->create();

        $this->assertTrue(Gate::forUser(null)->allows('view', $post));
    }

    public function test_owner_can_see_their_private_post(): void
    {
        $post = Post::factory()->private()->create();

        $this->assertTrue($post->user->can('view', $post));
    }

    public function test_friends_can_see_a_private_post(): void
    {
        $post = Post::factory()->private()->create();
        $friend = User::factory()->create();
        $this->makeFriends($friend, $post->user);

        $this->assertTrue($friend->can('view', $post));
    }

    public function test_strangers_cannot_see_a_private_post(): void
    {
        $post = Post::factory()->private()->create();
        $stranger = User::factory()->create();

        $this->assertFalse($stranger->can('view', $post));
    }

    public function test_pending_requesters_cannot_see_a_private_post(): void
    {
        $post = Post::factory()->private()->create();
        $requester = User::factory()->create();
        $requester->friendRequestsSent()->create(['receiver_id' => $post->user_id, 'status' => 'pending']);

        $this->assertFalse($requester->can('view', $post));
    }

    public function test_guests_cannot_see_a_private_post(): void
    {
        $post = Post::factory()->private()->create();

        $this->assertFalse(Gate::forUser(null)->allows('view', $post));
    }

    public function test_anyone_signed_in_can_like_a_public_post(): void
    {
        $post = Post::factory()->create();
        $stranger = User::factory()->create();

        $this->assertTrue($stranger->can('like', $post));
    }

    public function test_guests_cannot_like_a_public_post(): void
    {
        $post = Post::factory()->create();

        $this->assertFalse(Gate::forUser(null)->allows('like', $post));
    }

    public function test_friends_can_like_a_private_post(): void
    {
        $post = Post::factory()->private()->create();
        $friend = User::factory()->create();
        $this->makeFriends($friend, $post->user);

        $this->assertTrue($friend->can('like', $post));
    }

    public function test_strangers_cannot_like_a_private_post(): void
    {
        $post = Post::factory()->private()->create();
        $stranger = User::factory()->create();

        $this->assertFalse($stranger->can('like', $post));
    }
}
