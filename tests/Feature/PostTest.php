<?php

namespace Tests\Feature;

use App\Enums\PrivacyStatus;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_create_a_post(): void
    {
        $response = $this->post(route('posts.store'), [
            'body' => 'Hello world',
            'privacy_status' => 'public',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseCount('posts', 0);
    }

    public function test_users_can_create_a_public_post(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'body' => 'Hello world',
            'privacy_status' => 'public',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'body' => 'Hello world',
            'privacy_status' => PrivacyStatus::Public->value,
        ]);
    }

    public function test_users_can_create_a_private_post(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'body' => 'Just for me',
            'privacy_status' => 'private',
        ]);

        $response->assertRedirect();

        $post = Post::first();
        $this->assertSame(PrivacyStatus::Private, $post->privacy_status);
    }

    public function test_users_can_attach_an_image_to_a_post(): void
    {
        Storage::fake('local');

        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('photo.jpg');

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'media' => $file,
            'privacy_status' => 'public',
        ]);

        $response->assertRedirect();

        $post = Post::first();
        $this->assertSame('image', $post->media_type);
        Storage::disk('local')->assertExists($post->media_path);
        $this->assertStringStartsWith('posts/images/', $post->media_path);
    }

    public function test_users_can_attach_a_video_to_a_post(): void
    {
        Storage::fake('local');

        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('clip.mp4', 100, 'video/mp4');

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'media' => $file,
            'privacy_status' => 'public',
        ]);

        $response->assertRedirect();

        $post = Post::first();
        $this->assertSame('video', $post->media_type);
        Storage::disk('local')->assertExists($post->media_path);
        $this->assertStringStartsWith('posts/videos/', $post->media_path);
    }

    public function test_post_requires_a_body_or_media(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'privacy_status' => 'public',
        ]);

        $response->assertSessionHasErrors(['body', 'media']);
        $this->assertDatabaseCount('posts', 0);
    }

    public function test_privacy_status_is_required(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'body' => 'Hello world',
        ]);

        $response->assertSessionHasErrors('privacy_status');
        $this->assertDatabaseCount('posts', 0);
    }

    public function test_privacy_status_must_be_a_valid_option(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'body' => 'Hello world',
            'privacy_status' => 'friends-only',
        ]);

        $response->assertSessionHasErrors('privacy_status');
        $this->assertDatabaseCount('posts', 0);
    }

    public function test_create_post_dropdown_defaults_to_the_users_privacy_status(): void
    {
        $user = User::factory()->create(['privacy_status' => PrivacyStatus::Private]);

        $response = $this->actingAs($user)->get(route('feed'));

        $response->assertOk();
        $response->assertSee('<option value="private" selected', escape: false);
    }
}
