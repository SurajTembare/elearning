<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // Course List
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.course_list', compact('courses'));
    }

    // Show Add Form
    public function create()
    {
        return view('admin.add_course');
    }

    // Store Course
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric'
        ]);

        $thumbnailPath = null;

        // Upload Image
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('courses', 'public');
        }

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'price' => $request->price,
            'is_paid' => $request->price > 0 ? 1 : 0
        ]);

        return redirect()->route('admin.course.list')->with('success', 'Course Added Successfully');
    }
}