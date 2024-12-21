<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment; // Aggiungi il modello Comment
use App\Http\Requests\CommentFormRequest; // Aggiungi il request personalizzato

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentFormRequest $request)
    {
        $comment = new Comment(); // Usa il modello Comment, non CommentsController
        $comment->post_id = $request->get('post_id');
        $comment->content = $request->get('content');
        $comment->save();

        return redirect()->back()->with('status', 'Your comment has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
