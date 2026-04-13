<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Str;

class BlogController extends Controller
{


    public function blogs()
    {
        $blogs = Blog::where('status', 1)->latest()->get();
        return view('blogs', compact('blogs'));
    }

    // public function blogDetails($slug)
    // {
    //     $blog = Blog::where('slug', $slug)->firstOrFail();
    //     return view('blog_details', compact('blog'));
    // }

    public function blogDetails($slug)
{
    $blog = Blog::with('comments.user')->where('slug',$slug)->firstOrFail();

    return view('blog_details', compact('blog'));
}

    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blog_list', compact('blogs'));
    }

    public function create()
    {
        return view('admin.add_blog');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'status' => 1
        ]);

        return back()->with('success', 'Blog Added');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.edit_blog', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $imagePath = $blog->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.blog.list')->with('success', 'Updated');
    }

    public function delete($id)
    {
        Blog::findOrFail($id)->delete();
        return back()->with('success', 'Deleted');
    }


    public function storeComment(Request $request)
{
    $request->validate([
        'comment' => 'required'
    ]);

    Comment::create([
        'user_id' => auth()->id(),
        'blog_id' => $request->blog_id,
        'comment' => $request->comment,
         'status' => 0 // ❗ always pending first
    ]);

    return back()->with('success','Comment added');
}

 public function reply(Request $request, $id)
    {
        $request->validate([
            'admin_reply' => 'required'
        ]);

        $comment = Comment::findOrFail($id);

        $comment->update([
            'admin_reply' => $request->admin_reply
        ]);

        return back()->with('success','Reply added');
    }
}
