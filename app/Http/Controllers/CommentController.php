<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\models\Idea;
use App\models\Comment;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller {
    public function store(CreateCommentRequest $request, Idea $idea) {

        $validated = $request->validated();

        $comment = new Comment();
        $comment->idea_id = $idea->id;
        $comment->user_id = auth()->id();
        $comment->content = $request->get("content");
        $comment->save();
        return redirect()->route("ideas.show", $idea->id)->with('success', "Comment posted successfully!.");
    }

    public function show(Comment $comment) {
        return view('Shared.comments-box', compact('comment'));
    }

    public function edit(Idea $idea, Comment $comment) {
        Gate::Authorize('comment.edit', $comment);
        return view('Shared.comment-edit-card', compact('comment', 'idea'));
    }

    public function update(UpdateCommentRequest $request, Idea $idea, Comment $comment) {
        Gate::Authorize('comment.edit', $comment);

        $validated = $request->validated();
        $comment->update($validated);
        return redirect()->route('ideas.show', $idea->id);
    }

    public function destroy(Idea $idea, Comment $comment) {
        Gate::Authorize('comment.delete', $comment);
        $comment->delete();
        return redirect()->route('ideas.show', $idea->id);
    }
}
