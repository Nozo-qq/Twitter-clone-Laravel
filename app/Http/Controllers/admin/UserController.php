<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->where('is_admin', 0)->latest()->paginate(10);
        return view('Admin.Users.index', compact('users'));
    }
    public function admins_index()
    {
        $users = User::query()->where('is_admin', 1)->latest()->paginate(10);
        return view('Admin.Users.admins-index', compact('users'));
    }
    public function promote($userId) {
        $user = User::find($userId);
        if($user) {
            $user->is_admin = 1;
            $user->save();
        } else {
            abort(404);
        }
        return redirect()->back();
    }


}
