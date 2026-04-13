<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\Course;

class LectureController extends Controller
{
    // Show Add Lecture Form
    public function create($course_id)
    {
        return view('admin.add_lecture', compact('course_id'));
    }

    // Store Lecture
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'title' => 'required',
            'file' => 'nullable|mimes:pdf|max:10240',
            'thumbnail' => 'nullable|image|max:2048'
        ]);
       
        $filePath = null;
        $thumbnailPath = null;

        // Upload PDF
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('lectures', 'public');
        }

        // Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('lecture_thumbnails', 'public');
        }

        Lecture::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'file_path' => $filePath,
            'thumbnail' => $thumbnailPath
        ]);

        return redirect()->route('admin.lecture.list', $request->course_id)
                         ->with('success', 'Lecture Added Successfully');
    }

    // Lecture List (course wise)
    public function list($course_id)
    {
        $course = Course::findOrFail($course_id);

        $lectures = Lecture::where('course_id', $course_id)->latest()->get();

        return view('admin.lecture_list', compact('lectures', 'course'));
    }

    public function delete($id){

    $lectures=Lecture::findOrfail($id);
    $lectures->delete();
    return redirect()->back()->with('success','Lecture Deleted Successfully');
    }

    public function edit($id){
        $lectures=Lecture::findOrfail($id);
        return view ('admin.updatelecture',compact('lectures'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required',
            'file' => 'nullable|mimes:pdf|max:10240',
            'thumbnail' => 'nullable|image|max:2048'
        ]);

        $lecture = Lecture::findOrFail($id);

        $filePath = $lecture->file_path;
        $thumbnailPath = $lecture->thumbnail;

        // Upload PDF
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('lectures', 'public');
        }

        // Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('lecture_thumbnails', 'public');
        }

        $lecture->update([
            'title' => $request->title,
            'file_path' => $filePath,
            'thumbnail' => $thumbnailPath
        ]);

        return redirect()->route('admin.lecture.list', $lecture->course_id)
                         ->with('success', 'Lecture Updated Successfully');
    }
}