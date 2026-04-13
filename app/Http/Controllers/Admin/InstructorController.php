<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
      public function index()
    {
        $instructors = Instructor::latest()->get();
        return view('admin.instructor_list', compact('instructors'));
    }

    public function create()
    {
        return view('admin.add_instructor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('instructors', 'public');
        }

        Instructor::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'bio' => $request->bio,
            'image' => $imagePath
        ]);

        return back()->with('success','Instructor Added');
    }

    public function edit($id)
    {
        $instructor = Instructor::findOrFail($id);
        return view('admin.edit_instructor', compact('instructor'));
    }

    public function update(Request $request, $id)
    {
        $instructor = Instructor::findOrFail($id);

        $imagePath = $instructor->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('instructors', 'public');
        }

        $instructor->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'bio' => $request->bio,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.instructor.list')
            ->with('success','Instructor Updated');
    }

    public function delete($id)
    {
        Instructor::findOrFail($id)->delete();

        return back()->with('success','Instructor Deleted');
    }
}
