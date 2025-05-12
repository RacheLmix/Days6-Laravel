<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('user.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('user.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Auth::user()->posts()->create($validated);

        return redirect()->route('user.posts.show', $post)
            ->with('success', 'Bài viết đã được tạo thành công!');
    }

    public function show(Post $post)
    {
        return view('user.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        // Replace $this->authorize('update', $post) with:
        if (! Gate::allows('update', $post)) {
            abort(403);
        }
        
        return view('user.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Replace $this->authorize('update', $post) with:
        if (! Gate::allows('update', $post)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('user.posts.show', $post)
            ->with('success', 'Bài viết đã được cập nhật thành công!');
    }

    public function destroy(Post $post)
    {
        // Replace $this->authorize('delete', $post) with:
        if (! Gate::allows('delete', $post)) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('user.posts.index')
            ->with('success', 'Bài viết đã được xóa thành công!');
    }
}
