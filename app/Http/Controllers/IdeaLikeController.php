<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea) {
        $liker = auth()->user();
        $liker->likes()->attach($idea);
        return redirect()->back();

    }
    public function dislike(Idea $idea) {
        $liker = auth()->user();
        $liker->likes()->detach($idea);
        return redirect()->back();
    }

    public function show(Idea $idea)
{
    $userId = auth()->id();
    $userHasLiked = DB::table('likes')
                      ->where('user_id', $userId)
                      ->where('idea_id', $idea->id)
                      ->exists();

    return view('your.view', compact('idea', 'userHasLiked'));
}
}
