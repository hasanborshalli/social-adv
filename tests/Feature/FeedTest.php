<?php

namespace Tests\Feature;

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

        $response = $this->actingAs($user)->get(route('feed'));

        $response->assertOk();
        $response->assertSee("What's on your mind, Jane?", escape: false);
        $response->assertSee('post-actions', escape: false);
        $response->assertSee('Friends only');
    }
}
