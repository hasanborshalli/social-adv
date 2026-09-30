<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

new class extends Component
{
    public string $name = '';
    public string $username = '';
    public string $bio = '';
    public string $work = '';
    public string $education = '';
    public string $city = '';
    public string $website = '';
    public string $birthday = '';

    public function mount(): void
    {
        $this->fillFromUser();
    }

    public function save(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:30', 'regex:/^[a-zA-Z0-9_.]+$/', Rule::unique('users', 'username')->ignore($user->id)],
            'bio' => ['nullable', 'string', 'max:160'],
            'work' => ['nullable', 'string', 'max:50'],
            'education' => ['nullable', 'string', 'max:50'],
            'city' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'url', 'max:255'],
            'birthday' => ['required', 'date', 'before:today'],
        ]);

        $user->update(array_map(fn (string $value): ?string => $value === '' ? null : $value, $validated));

        $this->dispatch('profile-updated');
    }

    public function cancel(): void
    {
        $this->resetValidation();
        $this->fillFromUser();
    }

    private function fillFromUser(): void
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->username = $user->username;
        $this->bio = $user->bio ?? '';
        $this->work = $user->work ?? '';
        $this->education = $user->education ?? '';
        $this->city = $user->city ?? '';
        $this->website = $user->website ?? '';
        $this->birthday = $user->birthday?->format('Y-m-d') ?? '';
    }
};
?>

<form class="card" wire:submit="save" novalidate>
    <div class="card-body">
        <h2 class="h5 mb-1">Profile</h2>
        <p class="text-secondary small mb-4">This is what people see when they open your profile.</p>

        <div class="setting-row">
            <div class="setting-row__text">
                <p class="fw-semibold mb-0">Profile picture</p>
                <p class="text-secondary small mb-0">Square images look best.</p>
            </div>
            <div class="setting-row__control d-flex align-items-center gap-3">
                <img class="avatar avatar-xl" src="{{ auth()->user()->profile_picture_url }}" alt="Your current profile picture">
                <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#changeAvatarModal">Change</button>
            </div>
        </div>

        <div class="setting-row">
            <div class="setting-row__text">
                <p class="fw-semibold mb-0">Cover photo</p>
                <p class="text-secondary small mb-0">Always public. 1600 × 500 px or larger.</p>
            </div>
            <div class="setting-row__control d-flex align-items-center gap-3">
                <img class="rounded object-fit-cover" src="{{ auth()->user()->cover_photo_url }}" alt="Your current cover photo" width="120" height="38">
                <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#changeCoverModal">Change</button>
            </div>
        </div>

        <hr class="my-4">

        <div class="row g-3">
            <div class="col-12 col-sm-6">
                <label class="form-label" for="setName">Display name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="setName"
                    wire:model="name" autocomplete="name" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-sm-6">
                <label class="form-label" for="setUsername">Username</label>
                <div class="input-group">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="setUsername"
                        wire:model="username" pattern="[a-zA-Z0-9_.]{3,30}" autocomplete="username" required>
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-text">Letters, numbers, dots and underscores. 3–30 characters.</div>
            </div>

            <div class="col-12">
                <label class="form-label" for="setBio">Bio</label>
                <textarea class="form-control @error('bio') is-invalid @enderror" id="setBio" wire:model="bio" rows="3"
                    maxlength="160"></textarea>
                @error('bio')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Up to 160 characters.</div>
            </div>

            <div class="col-12 col-sm-6">
                <label class="form-label" for="setWork">Work</label>
                <input type="text" class="form-control @error('work') is-invalid @enderror" id="setWork"
                    wire:model="work" maxlength="50">
                @error('work')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-sm-6">
                <label class="form-label" for="setEducation">Education</label>
                <input type="text" class="form-control @error('education') is-invalid @enderror" id="setEducation"
                    wire:model="education" maxlength="50">
                @error('education')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-sm-6">
                <label class="form-label" for="setCity">Current city</label>
                <input type="text" class="form-control @error('city') is-invalid @enderror" id="setCity"
                    wire:model="city" maxlength="100">
                @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-sm-6">
                <label class="form-label" for="setWebsite">Website</label>
                <input type="url" class="form-control @error('website') is-invalid @enderror" id="setWebsite"
                    wire:model="website" placeholder="https://example.com">
                @error('website')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-sm-6">
                <label class="form-label" for="setBirthday">Birthday</label>
                <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="setBirthday"
                    wire:model="birthday" required>
                @error('birthday')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="card-footer bg-transparent d-flex justify-content-end align-items-center gap-2 py-3">
        <span class="text-success small me-auto" x-data="{ shown: false }"
            x-on:profile-updated.window="shown = true; setTimeout(() => shown = false, 2500)" x-show="shown" x-transition
            style="display: none;">Changes saved.</span>
        <button class="btn btn-light" type="button" wire:click="cancel">Cancel</button>
        <button class="btn btn-primary px-4" type="submit" wire:loading.attr="disabled">Save changes</button>
    </div>
</form>
