<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //  public function reply(Request $request, $id)
    // {
    //     $request->validate([
    //         'admin_reply' => 'required'
    //     ]);

    //     $comment = Comment::findOrFail($id);

    //     $comment->update([
    //         'admin_reply' => $request->admin_reply
    //     ]);

    //     return back()->with('success','Reply added');
    // }

     public function index()
    {
        $comments = Comment::with('user','blog')->latest()->get();
        return view('admin.comment_list', compact('comments'));
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

    public function delete($id)
{
    $comment = Comment::findOrFail($id);
    $comment->delete();

    return back()->with('success','Comment deleted successfully');
}

public function approve($id)
{
    $comment = Comment::findOrFail($id);

    $comment->status = 1;
    $comment->save(); // 🔥 IMPORTANT

    return back()->with('success','Comment approved');
}
}
