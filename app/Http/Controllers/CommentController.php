<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Jobs\NotifyAuthorOfComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;
    
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:2000',
            'post_id' => 'required|exists:posts,id'
        ]);

        $comment = new Comment($validated);
        $comment->user_id = Auth::id();
        $comment->save();
        
        $post = Post::find($validated['post_id']);
        NotifyAuthorOfComment::dispatch($comment, $post);

        return back()->with('success', 'Bình luận đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'content' => 'required|string|max:2000'
        ]);

        $comment->update($validated);

        return back()->with('success', 'Bình luận đã được cập nhật!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return back()->with('success', 'Bình luận đã được xóa!');
    }
}
