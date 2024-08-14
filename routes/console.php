<?php

use Illuminate\Support\Facades\Artisan;
use App\Models\User;


// this command to make a user as admin
Artisan::command('make-admin {userId}', function ($userId) {
    $user = User::find($userId);
    if($user) {
        $user->is_admin = 1;
        $user->save();
    } else {
        abort(404);
    }

    $this->info("User {$userId} has been made an admin.");
})->describe('Make a user an admin');
