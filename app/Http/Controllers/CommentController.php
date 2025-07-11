<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Phone;

class CommentController extends Controller
{
    public function index()
{
    $comments = Comment::with('user')->latest()->get();
    return Inertia::render('Comments/Index', [
        'comments' => $comments,
    ]);
}

public function store(Request $request, Phone $phone)
{
    $request->validate([
        'body' => 'required|string|max:1000',
    ]);

    $phone->comments()->create([
        'user_id' => $request->user()->id,
        'body' => $request->body,
    ]);

    return redirect()->back();
}



}
