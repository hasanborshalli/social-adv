<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_settings_page_contains_the_profile_settings_component(): void
    {
        $response = $this->actingAs(User::factory()->create())->get(route('settings'));

        $response->assertSeeLivewire('profile-settings');
    }

    public function test_form_is_filled_with_the_current_user_details(): void
    {
        $user = User::factory()->create([
            'bio' => 'Hello there',
            'birthday' => '1995-05-10',
        ]);

        Livewire::actingAs($user)
            ->test('profile-settings')
            ->assertSet('name', $user->name)
            ->assertSet('username', $user->username)
            ->assertSet('bio', 'Hello there')
            ->assertSet('birthday', '1995-05-10');
    }

    public function test_users_can_update_their_profile_settings(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile-settings')
            ->set('name', 'Jane Doe')
            ->set('username', 'jane.doe')
            ->set('bio', 'Bikes and film cameras.')
            ->set('work', 'Designer')
            ->set('education', 'Art School')
            ->set('city', 'Manchester')
            ->set('website', 'https://example.com')
            ->set('birthday', '1993-04-22')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('profile-updated');

        $user->refresh();
        $this->assertSame('Jane Doe', $user->name);
        $this->assertSame('jane.doe', $user->username);
        $this->assertSame('Bikes and film cameras.', $user->bio);
        $this->assertSame('Designer', $user->work);
        $this->assertSame('Art School', $user->education);
        $this->assertSame('Manchester', $user->city);
        $this->assertSame('https://example.com', $user->website);
        $this->assertSame('1993-04-22', $user->birthday->format('Y-m-d'));
    }

    public function test_cleared_optional_fields_are_stored_as_null(): void
    {
        $user = User::factory()->create(['bio' => 'Old bio']);

        Livewire::actingAs($user)
            ->test('profile-settings')
            ->set('bio', '')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertNull($user->refresh()->bio);
    }

    public function test_users_can_keep_their_own_username(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile-settings')
            ->call('save')
            ->assertHasNoErrors();
    }

    public function test_username_must_be_unique(): void
    {
        User::factory()->create(['username' => 'taken']);
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile-settings')
            ->set('username', 'taken')
            ->call('save')
            ->assertHasErrors(['username' => 'unique']);
    }

    public function test_invalid_input_is_rejected(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile-settings')
            ->set('name', '')
            ->set('bio', str_repeat('a', 161))
            ->set('website', 'not-a-url')
            ->set('birthday', now()->addDay()->format('Y-m-d'))
            ->call('save')
            ->assertHasErrors([
                'name' => 'required',
                'bio' => 'max',
                'website' => 'url',
                'birthday' => 'before',
            ]);
    }

    public function test_cancel_restores_saved_values(): void
    {
        $user = User::factory()->create(['name' => 'Original Name']);

        Livewire::actingAs($user)
            ->test('profile-settings')
            ->set('name', 'Changed Name')
            ->call('cancel')
            ->assertSet('name', 'Original Name');
    }
}
