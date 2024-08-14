<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
    public function show(User $user) {
        $ideas = $user->ideas()->paginate(5);
        return view('Users.show', compact('user', 'ideas'));
    }

    public function edit(User $user) {
        Gate::authorize('update', $user);

        $ideas = $user->ideas()->paginate(5);
        return view('users.edit', compact('user', 'ideas'));
    }

    public function update(UpdateUserRequest $request, User $user) {
        Gate::authorize('update', $user);

        $validated = $request->validated();


        if($request->has('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);
        return redirect()->route('profile', $user);
    }

    public function profile(User $user) {
        return $this->show($user);
    }
}
