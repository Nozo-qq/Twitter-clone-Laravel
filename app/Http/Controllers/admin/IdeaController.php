<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index() {

        $ideas = Idea::latest()->paginate(10);

        return view('Admin.Ideas.index', compact('ideas'));
    }
}
