<?php

namespace Tests\Feature;

use App\Enums\FriendRequestAudience;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FriendRequestPolicyTest extends TestCase
{
    use RefreshDatabase;

    private function makeFriends(User $first, User $second): void
    {
        $first->friendRequestsSent()->create(['receiver_id' => $second->id, 'status' => 'accepted']);
    }

    public function test_has_mutual_returns_true_when_users_share_a_friend(): void
    {
        [$user, $target, $mutual] = User::factory()->count(3)->create();
        $this->makeFriends($user, $mutual);
        $this->makeFriends($mutual, $target);

        $this->assertTrue($user->hasMutual($target));
        $this->assertTrue($target->hasMutual($user));
    }

    public function test_has_mutual_returns_false_when_users_share_no_friend(): void
    {
        [$user, $target, $other] = User::factory()->count(3)->create();
        $this->makeFriends($user, $other);

        $this->assertFalse($user->hasMutual($target));
    }

    public function test_anyone_can_send_a_request_when_audience_is_everyone(): void
    {
        $user = User::factory()->create();
        $target = User::factory()->create(['friend_request_audience' => FriendRequestAudience::Everyone]);

        Livewire::actingAs($user)
            ->test('add-friend', ['target' => $target])
            ->assertSee('Add friend')
            ->call('addFriend')
            ->assertSet('state', 'pending sent');
    }

    public function test_strangers_cannot_send_a_request_when_audience_is_friends_of_friends(): void
    {
        $user = User::factory()->create();
        $target = User::factory()->create(['friend_request_audience' => FriendRequestAudience::FriendsOfFriends]);

        Livewire::actingAs($user)
            ->test('add-friend', ['target' => $target])
            ->assertDontSee('Add friend')
            ->call('addFriend')
            ->assertForbidden();

        $this->assertFalse($user->isRequestSentTo($target));
    }

    public function test_users_with_mutual_friends_can_send_a_request_when_audience_is_friends_of_friends(): void
    {
        [$user, $mutual] = User::factory()->count(2)->create();
        $target = User::factory()->create(['friend_request_audience' => FriendRequestAudience::FriendsOfFriends]);
        $this->makeFriends($user, $mutual);
        $this->makeFriends($target, $mutual);

        Livewire::actingAs($user)
            ->test('add-friend', ['target' => $target])
            ->assertSee('Add friend')
            ->call('addFriend')
            ->assertSet('state', 'pending sent');
    }
}
