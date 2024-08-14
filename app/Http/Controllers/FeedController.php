<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Idea;

class FeedController extends Controller {

    public function __invoke(Request $request) {

        $followingIDs = auth()->user()->followings()->pluck('user_id');

        $ideas = Idea::when(request()->has('search'), function ($query, $followingIDs) {
            $query->search(request('search', ''))->whereIn('user_id', $followingIDs);
        })->whereIn('user_id', $followingIDs)
        ->orderBy('created_at', 'DESC')
        ->paginate(5);

        return view('dashboard', [
            'ideas' => $ideas
        ]);
    }
}
