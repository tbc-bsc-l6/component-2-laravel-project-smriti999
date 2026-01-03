<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Ensure the logged-in user is an admin
     */
    private function ensureAdmin()
    {
        if (!Auth::check() || Auth::user()->user_role_id != 1) {
            abort(403, 'Only admin can perform this action.');
        }
    }

    /**
     * Display a listing of the blogs.
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('home', compact('blogs')); // your blog list page
    }

    /**
     * Show the form for creating a new blog.
     */
    public function create()
    {
        $this->ensureAdmin();
        return view('createblog');
    }

    /**
     * Store a newly created blog in storage.
     */
    public function store(Request $request)
    {
        $this->ensureAdmin();

        $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'author'  => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'], // content can be long text
        ]);

        Blog::create([
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
            'author_name' => $request->input('author'),
            'content'     => $request->input('content'),
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified blog.
     */
    public function show(Blog $blog)
    {
        return view('showblog', compact('blog'));
    }

    /**
     * Show the form for editing the specified blog.
     */
    public function edit(Blog $blog)
    {
        $this->ensureAdmin();
        return view('editblog', compact('blog'));
    }

    /**
     * Update the specified blog in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $this->ensureAdmin();

        $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'author'  => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'], // matches textarea name
        ]);

        $blog->update([
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
            'author_name' => $request->input('author'),
            'content'     => $request->input('content'),
        ]);

        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified blog from storage.
     */
    public function destroy(Blog $blog)
    {
        $this->ensureAdmin();
        $blog->delete();

        return redirect()->route('blogs.index');
    }
}
