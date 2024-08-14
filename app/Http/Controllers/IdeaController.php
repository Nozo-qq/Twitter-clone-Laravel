<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use Illuminate\Http\Request;
use App\models\idea;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    public function show(Idea $idea) {
        $show = true;
        return view('ideas.show', compact('idea', 'show'));
    }
    public function store(CreateIdeaRequest $request) {
        $validated = $request->validated();
        $validated["user_id"] = auth()->id();

        Idea::create($validated);
        return redirect()->route('dashboard')->with('success', 'idea has created successfully!');
    }

    public function destroy(Idea $idea) {
        Gate::Authorize('delete', $idea);
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'idea has deleted successfully!');
    }

    public function edit(Idea $idea) {
        Gate::Authorize('update', $idea);
        $editing = true;
        return view('ideas.show', compact('idea','editing'));
    }

    public function update(UpdateIdeaRequest $request, Idea $idea) {
        Gate::Authorize('update', $idea);
        $validated = $request->validated();

        $idea->update($validated);

        return redirect()->route('ideas.show', $idea->id)->with('success', 'idea has updated successfully!');
    }
}
