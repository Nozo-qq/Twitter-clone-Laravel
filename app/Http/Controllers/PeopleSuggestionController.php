<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class PeopleSuggestionController extends Controller
{

    public function __invoke(Request $request)
    {
        $user_id = auth()->user()->id;

        $users = User::query()
                    ->where('id', '<>', $user_id)
                    ->whereNotIn('id', function($query) use ($user_id){
                        $query->select('user_id')
                              ->from('follower_user')
                              ->whereRaw('follower_id = ?', [$user_id]);
                    })->get();

        return view('suggestions', [
            'users' => $users
        ]);
    }
}
