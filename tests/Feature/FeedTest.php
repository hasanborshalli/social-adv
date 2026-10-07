<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_can_view_the_feed(): void
    {
        $response = $this->get(route('feed'));

        $response->assertOk();
        $response->assertSee('Log in');
        $response->assertSee('Create an account');
        $response->assertDontSee('post-actions', escape: false);
        $response->assertDontSee('Friends only');
    }

    public function test_authenticated_users_see_their_name_and_post_actions(): void
    {
        $user = User::factory()->create(['name' => 'Jane Doe']);
        Post::factory()->create();

        $response = $this->actingAs($user)->get(route('feed'));

        $response->assertOk();
        $response->assertSee("What's on your mind, Jane?", escape: false);
        $response->assertSee('post-actions', escape: false);
        $response->assertSee('Friends only');
    }

    public function test_guests_only_see_public_posts(): void
    {
        Post::factory()->create(['body' => 'A public post']);
        Post::factory()->private()->create(['body' => 'A private post']);

        $response = $this->get(route('feed'));

        $response->assertSee('A public post');
        $response->assertDontSee('A private post');
    }

    public function test_users_see_their_own_and_their_friends_private_posts_but_not_strangers(): void
    {
        $user = User::factory()->create();
        $friend = User::factory()->create();
        $user->friendRequestsSent()->create(['receiver_id' => $friend->id, 'status' => 'accepted']);

        Post::factory()->for($user)->private()->create(['body' => 'My own private post']);
        Post::factory()->for($friend)->private()->create(['body' => 'A friend private post']);
        Post::factory()->private()->create(['body' => 'A stranger private post']);

        $response = $this->actingAs($user)->get(route('feed'));

        $response->assertSee('My own private post');
        $response->assertSee('A friend private post');
        $response->assertDontSee('A stranger private post');
    }
}
