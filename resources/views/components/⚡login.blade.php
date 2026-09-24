<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

new class extends Component
{
    public string $identifier = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void
    {
        $credentials = $this->validate([
            'identifier' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $field = filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (! Auth::attempt([$field => $credentials['identifier'], 'password' => $credentials['password']], $this->remember)) {
            throw ValidationException::withMessages([
                'identifier' => 'The provided credentials do not match our records.',
            ]);
        }

        request()->session()->regenerate();

        $this->redirectIntended(route('feed'));
    }
};
?>

<div class="card auth-card">
    <div class="card-body p-4 p-sm-5">
        <h1 class="h4 mb-1">Log in</h1>
        <p class="text-secondary mb-4">Welcome back. Pick up where you left off.</p>

        <form wire:submit="login" novalidate>
            <div class="mb-3">
                <label class="form-label" for="loginIdentifier">Email or username</label>
                <input type="text" class="form-control @error('identifier') is-invalid @enderror" id="loginIdentifier"
                    wire:model="identifier" name="identifier" value="{{ old('identifier') }}" autocomplete="username"
                    placeholder="you@example.com" required>
                @error('identifier')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-baseline">
                    <label class="form-label" for="loginPassword">Password</label>
                    <a class="small link-muted" href="#">Forgot password?</a>
                </div>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="loginPassword"
                    wire:model="password" name="password" autocomplete="current-password" minlength="12" required>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="loginRemember" wire:model="remember"
                    @checked(old('remember', true))>
                <label class="form-check-label" for="loginRemember">Keep me logged in</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Log in</button>

            <p class="divider-text mb-3">new here?</p>

            <a class="btn btn-light w-100 py-2" href="{{ route('register') }}">Create an account</a>
        </form>
    </div>
</div>