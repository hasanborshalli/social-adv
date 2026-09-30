<?php

namespace Tests\Feature;

use App\Enums\FriendRequestAudience;
use App\Enums\PrivacyStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PrivacySettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_settings_page_contains_the_privacy_settings_component(): void
    {
        $response = $this->actingAs(User::factory()->create())->get(route('settings'));

        $response->assertSeeLivewire('privacy-settings');
    }

    public function test_form_is_filled_with_the_current_user_settings(): void
    {
        $user = User::factory()->create([
            'privacy_status' => PrivacyStatus::Friends,
            'friend_request_audience' => FriendRequestAudience::FriendsOfFriends,
        ]);

        Livewire::actingAs($user)
            ->test('privacy-settings')
            ->assertSet('privacy_status', 'friends')
            ->assertSet('friend_request_audience', 'friends_of_friends');
    }

    public function test_private_users_default_to_friends(): void
    {
        $user = User::factory()->private()->create();

        Livewire::actingAs($user)
            ->test('privacy-settings')
            ->assertSet('privacy_status', 'friends');
    }

    public function test_users_can_update_their_privacy_settings(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('privacy-settings')
            ->set('privacy_status', 'friends')
            ->set('friend_request_audience', 'friends_of_friends')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('privacySaved', true);

        $user->refresh();
        $this->assertSame(PrivacyStatus::Friends, $user->privacy_status);
        $this->assertSame(FriendRequestAudience::FriendsOfFriends, $user->friend_request_audience);
    }

    public function test_posts_audience_can_only_be_public_or_friends(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('privacy-settings')
            ->set('privacy_status', 'private')
            ->call('save')
            ->assertHasErrors('privacy_status');

        $this->assertSame(PrivacyStatus::Public, $user->refresh()->privacy_status);
    }

    public function test_invalid_input_is_rejected(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('privacy-settings')
            ->set('privacy_status', '')
            ->set('friend_request_audience', 'nobody')
            ->call('save')
            ->assertHasErrors([
                'privacy_status' => 'required',
                'friend_request_audience',
            ]);
    }
}
