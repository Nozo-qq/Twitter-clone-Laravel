<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class UserPolicy {

    public function is_owner(User $user, User $model): bool {
        return $user->is($model);
    }
    public function update(User $user, User $model): bool {
        return $this->is_owner($user, $model) || Gate::allows('admin');
    }
}
