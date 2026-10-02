<?php

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;

new class extends Component
{
    #[Locked]
    public User $target;

    #[Locked]
    public bool $requestSent = false;

    public function addFriend(): void
    {
        $this->authorize('create', [FriendRequest::class, $this->target]);

        Auth::user()->friendRequestsSent()->create(['receiver_id' => $this->target->id]);
        $this->requestSent = true;
    }

    public function cancelRequest(): void
    {
        Auth::user()->friendRequestsSent()
            ->where('receiver_id', $this->target->id)
            ->where('status', 'pending')
            ->delete();
        $this->requestSent = false;
    }
};
?>
<div>
    @if ($requestSent)
    <button class="btn btn-sm btn-primary" type="button" wire:click="cancelRequest" aria-label="Cancel friend request to {{ $target->name }}">
        <i class="bi bi-person-x" aria-hidden="true"></i>
    </button>
    @else
    @can('create', [\App\Models\FriendRequest::class, $target])
    <button class="btn btn-sm btn-outline-primary" type="button" wire:click="addFriend" aria-label="Add {{ $target->name }} as a friend">
        <i class="bi bi-person-plus" aria-hidden="true"></i>
    </button>
    @endcan
    @endif
</div>
