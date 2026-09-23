<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_update_the_profile_picture(): void
    {
        $response = $this->post(route('profile.picture.update'), [
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertRedirect(route('login'));
    }

    public function test_users_can_upload_a_profile_picture(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)->post(route('profile.picture.update'), [
            'avatar' => $file,
        ]);

        $response->assertRedirect();

        $user->refresh();
        Storage::disk('public')->assertExists($user->profile_pic);
        $this->assertStringStartsWith('profile-pictures/', $user->profile_pic);
    }

    public function test_uploading_a_new_profile_picture_deletes_the_old_one(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'profile_pic' => UploadedFile::fake()->image('old.jpg')->store('profile-pictures', 'public'),
        ]);
        $oldProfilePic = $user->profile_pic;

        $response = $this->actingAs($user)->post(route('profile.picture.update'), [
            'avatar' => UploadedFile::fake()->image('new.jpg'),
        ]);

        $response->assertRedirect();

        $user->refresh();
        Storage::disk('public')->assertMissing($oldProfilePic);
        Storage::disk('public')->assertExists($user->profile_pic);
    }

    public function test_profile_picture_must_be_an_image(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('profile.picture.update'), [
            'avatar' => UploadedFile::fake()->create('resume.pdf', 100),
        ]);

        $response->assertSessionHasErrors('avatar');
        $this->assertNull($user->fresh()->profile_pic);
    }

    public function test_profile_picture_is_required(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('profile.picture.update'), []);

        $response->assertSessionHasErrors('avatar');
    }

    public function test_guests_cannot_update_the_cover_photo(): void
    {
        $response = $this->post(route('profile.cover.update'), [
            'cover' => UploadedFile::fake()->image('cover.jpg'),
        ]);

        $response->assertRedirect(route('login'));
    }

    public function test_users_can_upload_a_cover_photo(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('cover.jpg');

        $response = $this->actingAs($user)->post(route('profile.cover.update'), [
            'cover' => $file,
        ]);

        $response->assertRedirect();

        $user->refresh();
        Storage::disk('public')->assertExists($user->cover_photo);
        $this->assertStringStartsWith('cover-photos/', $user->cover_photo);
    }

    public function test_uploading_a_new_cover_photo_deletes_the_old_one(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'cover_photo' => UploadedFile::fake()->image('old-cover.jpg')->store('cover-photos', 'public'),
        ]);
        $oldCoverPhoto = $user->cover_photo;

        $response = $this->actingAs($user)->post(route('profile.cover.update'), [
            'cover' => UploadedFile::fake()->image('new-cover.jpg'),
        ]);

        $response->assertRedirect();

        $user->refresh();
        Storage::disk('public')->assertMissing($oldCoverPhoto);
        Storage::disk('public')->assertExists($user->cover_photo);
    }

    public function test_cover_photo_must_be_an_image(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('profile.cover.update'), [
            'cover' => UploadedFile::fake()->create('resume.pdf', 100),
        ]);

        $response->assertSessionHasErrors('cover');
        $this->assertNull($user->fresh()->cover_photo);
    }

    public function test_cover_photo_is_required(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('profile.cover.update'), []);

        $response->assertSessionHasErrors('cover');
    }
}
