<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('home', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('createblog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required'],
            'author'=>['required'],
            'content'=>['required','max:255'],
        ]);
        
        $data= $request->all();
        
  
        $blog = Blog::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'author_name'=>$data['author'],
            'content'=> $data['content'],
            'user_id'=> Auth::id()// OR $request->user_id
        ]);
        return redirect('/blogs');
    }

    /**
     * Display the specified resource.
     */
   public function show(Blog $blog)
   {
            return view('showblog', compact('blog'));
   }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('editblog',['blog'=>$blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $data= $request->all();
        //validate and store the blog data
        // $blog->blog_title = $data['title'];
        // $blog->author_name = $data['author'];
        // $blog->content = $data['content'];
        // $blog->update();
        // return redirect('/blogs');
         Blog::where('slug',$blog->slug)->update([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'author_name'=>$data['author'],
            'content'=> $data['content']
        ]);
        return redirect('/blogs');
    }
        
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect('/blogs');
    }
}
