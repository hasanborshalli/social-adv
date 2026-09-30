<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;

new class extends Component
{
    public string $email = '';
    public string $phone = '';
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $delete_password = '';
    public bool $accountSaved = false;
    public bool $passwordUpdated = false;

    public function mount(): void
    {
        $user = Auth::user();

        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
    }

    public function updateAccount(): void
    {
        $this->accountSaved = false;

        $validated = $this->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore(Auth::id())],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^\+?[0-9\s\-()]{7,20}$/'],
        ]);

        Auth::user()->update([
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?: null,
        ]);

        $this->accountSaved = true;
    }

    public function updatePassword(): void
    {
        $this->passwordUpdated = false;

        $validated = $this->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', 'min:12', 'confirmed', 'different:current_password'],
        ]);

        Auth::user()->update(['password' => $validated['password']]);

        $this->reset('current_password', 'password', 'password_confirmation');
        $this->passwordUpdated = true;
    }

    public function deleteAccount(): void
    {
        $this->validate([
            'delete_password' => ['required', 'string', 'current_password'],
        ]);

        $user = Auth::user();

        $storedFiles = $user->posts()->withTrashed()->whereNotNull('media_path')->pluck('media_path')
            ->push($user->profile_pic, $user->cover_photo)
            ->filter()
            ->all();

        logout_user();
        $user->delete();
        Storage::disk('public')->delete($storedFiles);

        $this->redirect(route('login'));
    }
};
?>

<div>
    <form class="card mb-3" wire:submit="updateAccount" novalidate>
        <div class="card-body">
            <h2 class="h5 mb-1">Account</h2>
            <p class="text-secondary small mb-4">Contact details and regional preferences.</p>

            <div class="row g-3">
                <div class="col-12 col-sm-6">
                    <label class="form-label" for="setEmail">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="setEmail"
                        wire:model="email" autocomplete="email" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-sm-6">
                    <label class="form-label" for="setPhone">Mobile number</label>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="setPhone"
                        wire:model="phone" autocomplete="tel" placeholder="+44 7700 900123">
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent d-flex justify-content-end align-items-center gap-2 py-3">
            @if ($accountSaved)
            <span class="text-success small me-auto" role="status">Account details saved.</span>
            @endif
            <button class="btn btn-primary px-4" type="submit" wire:loading.attr="disabled"
                wire:target="updateAccount">Save changes</button>
        </div>
    </form>

    <form class="card mb-3" wire:submit="updatePassword" novalidate>
        <div class="card-body">
            <h2 class="h6 mb-3">Change password</h2>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label" for="setCurrentPw">Current password</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                        id="setCurrentPw" wire:model="current_password" autocomplete="current-password" required>
                    @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-sm-6">
                    <label class="form-label" for="setNewPw">New password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="setNewPw"
                        wire:model="password" autocomplete="new-password" minlength="12" required>
                    <div class="form-text">At least 12 characters.</div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-sm-6">
                    <label class="form-label" for="setConfirmPw">Confirm new password</label>
                    <input type="password" class="form-control" id="setConfirmPw" wire:model="password_confirmation"
                        autocomplete="new-password" minlength="12" required>
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent d-flex justify-content-end align-items-center gap-2 py-3">
            @if ($passwordUpdated)
            <span class="text-success small me-auto" role="status">Password updated.</span>
            @endif
            <button class="btn btn-primary px-4" type="submit" wire:loading.attr="disabled"
                wire:target="updatePassword">Update password</button>
        </div>
    </form>

    <section class="card border-danger-subtle" aria-labelledby="dangerZoneHeading">
        <div class="card-body">
            <h2 class="h6 text-danger mb-3" id="dangerZoneHeading">Delete account</h2>
            <div class="setting-row pt-0">
                <div class="setting-row__text">
                    <p class="fw-semibold mb-0">Delete account</p>
                    <p class="text-secondary small mb-0">Permanently removes your posts, photos and messages.</p>
                </div>
                <div class="setting-row__control">
                    <button class="btn btn-outline-danger" type="button" data-bs-toggle="modal"
                        data-bs-target="#deleteAccountModal">Delete account</button>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== Delete account dialog ===================== -->
    <div class="modal fade" role="dialog" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" wire:submit="deleteAccount" novalidate>
                <div class="modal-header">
                    <h2 class="modal-title h5 text-danger" id="deleteAccountLabel">Delete your account?</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">
                        This permanently deletes your account, posts and photos. <strong>This can't be undone.</strong>
                    </p>
                    <label class="form-label" for="deletePassword">Enter your password to confirm</label>
                    <input type="password" class="form-control @error('delete_password') is-invalid @enderror"
                        id="deletePassword" wire:model="delete_password" autocomplete="current-password" required>
                    @error('delete_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger px-4" wire:loading.attr="disabled"
                        wire:target="deleteAccount">Delete account</button>
                </div>
            </form>
        </div>
    </div>
</div>