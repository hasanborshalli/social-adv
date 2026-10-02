<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class RightRail extends Component
{
    public ?User $user;

    /**
     * @var Collection<int, User>
     */
    public Collection $peopleYouMayKnow;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = Auth::user();
        $this->peopleYouMayKnow = $this->user?->peopleYouMayKnow() ?? collect();
    }

    /**
     * Count the friends the current user has in common with the given person.
     */
    public function mutualFriendsCount(User $person): int
    {
        return $this->user->friends()->whereIn('id', $person->friends()->select('id'))->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.right-rail');
    }
}
