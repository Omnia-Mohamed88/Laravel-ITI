<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentsRequest;
use App\Http\Requests\UpdateCommentsRequest;
use App\Models\Comments;

class CommentsController extends Controller
{
    function __construct(){
        $this->middleware('auth')->only(['store']);
    }
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
    public function store(StoreCommentsRequest $request)
    {
        //
        $req = request()->all();
        $new_comment = new Comments();
        $new_comment->content = $req['content'];
        $new_comment->commentable_id = $req['post_id'];
        $new_comment->commentable_type = 'App\Models\Posts';
        $new_comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentsRequest $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comments $comments)
    {
        //
    }
}
