<?php

namespace App\Policies;

use Illuminate\Support\Facades\Gate;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IdeaPolicy {


    public function is_owner(User $user, Idea $idea): bool {
        return $user->id === $idea->user_id;
    }
    public function update(User $user, Idea $idea): bool {
        return Gate::allows('admin') || $this->is_owner($user, $idea);
    }

    public function delete(User $user, Idea $idea): bool {
        return Gate::allows('admin') || $this->is_owner($user, $idea);
    }
}
