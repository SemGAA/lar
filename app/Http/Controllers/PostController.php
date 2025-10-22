<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        if (Auth::user()->is_admin) {
            $posts = Post::with(['user', 'category'])->latest()->get();
        } else {
            $posts = Post::with(['user', 'category'])
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();
        }
        
        return view('dashboard.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'excerpt' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'is_published' => ['boolean']
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = Auth::id();
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        Post::create($validated);

        session()->flash('ok', 'Пост успешно создан');
        return to_route('dashboard.posts.index');
    }

    public function edit(Post $post)
    {
        if (!$post->isOwner(Auth::user()) && !Auth::user()->is_admin) {
            abort(403);
        }

        $categories = Category::all();
        return view('dashboard.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        if (!$post->isOwner(Auth::user()) && !Auth::user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'excerpt' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'is_published' => ['boolean']
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        if ($validated['is_published'] && !$post->is_published) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        session()->flash('ok', 'Пост успешно обновлен');
        return to_route('dashboard.posts.index');
    }

    public function destroy(Post $post)
    {
        if (!$post->isOwner(Auth::user()) && !Auth::user()->is_admin) {
            abort(403);
        }

        $post->delete();
        session()->flash('ok', 'Пост успешно удален');
        return back();
    }
}