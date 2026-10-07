<?php

namespace Tests\Feature;

use App\Enums\PrivacyStatus;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ShareTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_share_a_public_post_with_a_message(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Livewire::actingAs($user)
            ->test('share-post', ['post' => $post, 'modalId' => 'share-post-1'])
            ->set('body', 'Look at this!')
            ->set('privacyStatus', 'friends')
            ->call('share')
            ->assertHasNoErrors()
            ->assertSet('body', '')
            ->assertDispatched("post-shared.{$post->id}");

        $share = $user->posts()->sole();

        $this->assertTrue($share->sharedPost->is($post));
        $this->assertSame('Look at this!', $share->body);
        $this->assertSame(PrivacyStatus::Friends, $share->privacy_status);
    }

    public function test_a_share_without_a_message_has_no_body(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Livewire::actingAs($user)
            ->test('share-post', ['post' => $post, 'modalId' => 'share-post-1'])
            ->call('share')
            ->assertHasNoErrors();

        $this->assertNull($user->posts()->sole()->body);
    }

    public function test_users_cannot_share_a_post_that_is_not_public(): void
    {
        $friend = User::factory()->create();
        $post = Post::factory()->for($friend)->create(['privacy_status' => PrivacyStatus::Friends]);
        $user = User::factory()->create();
        $user->friendRequestsSent()->create(['receiver_id' => $friend->id, 'status' => 'accepted']);

        Livewire::actingAs($user)
            ->test('share-post', ['post' => $post, 'modalId' => 'share-post-1'])
            ->call('share')
            ->assertForbidden();

        $this->assertSame(0, $post->shares()->count());
    }

    public function test_users_cannot_share_a_share(): void
    {
        $share = Post::factory()->sharing(Post::factory()->create())->create();

        $this->assertFalse(User::factory()->create()->can('share', $share));
    }

    public function test_the_share_privacy_must_be_valid(): void
    {
        $post = Post::factory()->create();

        Livewire::actingAs(User::factory()->create())
            ->test('share-post', ['post' => $post, 'modalId' => 'share-post-1'])
            ->set('privacyStatus', 'everyone')
            ->call('share')
            ->assertHasErrors('privacyStatus');
    }

    public function test_the_share_count_refreshes_when_its_post_is_shared(): void
    {
        $post = Post::factory()->create();

        $shareCount = Livewire::test('share-count', ['post' => $post])
            ->assertSee('0 shares');

        Post::factory()->sharing($post)->create();

        $shareCount->dispatch("post-shared.{$post->id}")
            ->assertSee('1 share');
    }

    public function test_the_feed_shows_a_share_with_its_original_post(): void
    {
        $original = Post::factory()->create(['body' => 'The original post']);
        Post::factory()->sharing($original)->create(['body' => 'My thoughts on it']);

        $response = $this->actingAs(User::factory()->create())->get(route('feed'));

        $response->assertOk();
        $response->assertSee('shared a post');
        $response->assertSee('My thoughts on it');
        $response->assertSee('The original post');
    }

    public function test_a_share_hides_an_original_post_that_was_deleted(): void
    {
        $original = Post::factory()->create(['body' => 'The original post']);
        Post::factory()->sharing($original)->create();
        $original->delete();

        $response = $this->get(route('feed'));

        $response->assertOk();
        $response->assertDontSee('The original post');
        $response->assertSee("This content isn't available right now", escape: false);
    }

    public function test_a_share_hides_an_original_post_the_viewer_can_no_longer_see(): void
    {
        $original = Post::factory()->create(['body' => 'The original post']);
        Post::factory()->sharing($original)->create();
        $original->update(['privacy_status' => PrivacyStatus::Private]);

        $response = $this->get(route('feed'));

        $response->assertDontSee('The original post');
        $response->assertSee("This content isn't available right now", escape: false);
    }
}
