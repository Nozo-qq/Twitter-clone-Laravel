<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
class AuthController extends Controller
{
    public function register() {
        return view('Auth.register');
    }

    public function store() {

        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:40',
                'email' => 'required|email|unique:users,email',
                'password'=> 'required|confirmed|min:8'
            ]
        );
       $user = User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]
        );
        request()->session()->regenerate();
        auth()->login($user);

        Mail::to($user->email)
        ->send(new WelcomeEmail($user));
        return redirect()->route('dashboard')->with('success','Account created successfully!.');
    }
    public function login() {
        return view('Auth.login');
    }

    public function Authenticate() {
        $validated = request()->validate(
            [
                'email' => 'required|email',
                'password'=> 'required|min:8'
            ]
        );

        if(auth()->attempt($validated)) {
            request()->session()->regenerate();
            return redirect()->route('dashboard')->with('success','Logged in successfully!.');
        }
        return redirect()->route('login')->withErrors([
            'email' => "No matching with the provided email and password!."
        ]);
    }

    public function logout() {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success','Account logged out successfully!.');
    }

}
