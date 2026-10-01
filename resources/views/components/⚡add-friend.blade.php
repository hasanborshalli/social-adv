<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;

new class extends Component
{
    #[Locked]
    public User $target;

    #[Locked]
    public string $state = '';

    public function mount(User $target): void
    {
        $this->target = $target;
        $this->refreshState();
    }

    public function addFriend(): void
    {
        $user = Auth::user();
        if ($user->is($this->target) || $user->isFriendWith($this->target) || $user->isRequestSentTo($this->target) || $user->isRequestReceivedFrom($this->target)) {
            $this->refreshState();
            return;
        }

        $user->friendRequestsSent()->create(['receiver_id' => $this->target->id]);
        $this->refreshState();
    }

    public function cancelRequest(): void
    {
        Auth::user()->friendRequestsSent()
            ->where('receiver_id', $this->target->id)
            ->where('status', 'pending')
            ->delete();
        $this->refreshState();
    }

    public function acceptRequest(): void
    {
        Auth::user()->friendRequestsRecieved()
            ->where('sender_id', $this->target->id)
            ->where('status', 'pending')
            ->update(['status' => 'accepted']);
        $this->refreshState();
    }

    public function declineRequest(): void
    {
        Auth::user()->friendRequestsRecieved()
            ->where('sender_id', $this->target->id)
            ->where('status', 'pending')
            ->delete();
        $this->refreshState();
    }

    public function unfriend(): void
    {
        $user = Auth::user();
        $user->friendRequestsSent()->where('receiver_id', $this->target->id)->where('status', 'accepted')->delete();
        $user->friendRequestsRecieved()->where('sender_id', $this->target->id)->where('status', 'accepted')->delete();
        $this->refreshState();
    }

    private function refreshState(): void
    {
        $user = Auth::user();
        if ($user->isFriendWith($this->target)) {
            $this->state = 'friends';
        } elseif ($user->isRequestSentTo($this->target)) {
            $this->state = 'pending sent';
        } elseif ($user->isRequestReceivedFrom($this->target)) {
            $this->state = 'pending received';
        } else {
            $this->state = 'nothing';
        }
    }
};
?>
<div class="d-flex gap-2">
    @switch($state)
    @case('friends')
    <button class="btn btn-primary" type="button" wire:click="unfriend">
        <i class="bi bi-person-dash me-1" aria-hidden="true"></i>Unfriend
    </button>
    @break
    @case('pending sent')
    <button class="btn btn-primary" type="button" wire:click="cancelRequest">
        <i class="bi bi-person-x me-1" aria-hidden="true"></i>Cancel request
    </button>
    @break
    @case('pending received')
    <button class="btn btn-primary" type="button" wire:click="acceptRequest">
        <i class="bi bi-person-check me-1" aria-hidden="true"></i>Accept request
    </button>
    <button class="btn btn-primary" type="button" wire:click="declineRequest">
        <i class="bi bi-person-x me-1" aria-hidden="true"></i>Decline request
    </button>
    @break
    @case('nothing')
    <button class="btn btn-primary" type="button" wire:click="addFriend">
        <i class="bi bi-person-plus me-1" aria-hidden="true"></i>Add friend
    </button>
    @break
    @endswitch
</div>