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

    // // Store Lecture
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'course_id' => 'required',
    //         'title' => 'required',
    //         'file' => 'nullable|mimes:pdf|max:10240',
    //         'thumbnail' => 'nullable|image|max:2048'
    //     ]);
       
    //     $filePath = null;
    //     $thumbnailPath = null;
    //     $videoPath = null;

    //     // Upload PDF
    //     if ($request->hasFile('file')) {
    //         $filePath = $request->file('file')->store('lectures', 'public');
    //     }

    //     // Upload Thumbnail
    //     if ($request->hasFile('thumbnail')) {
    //         $thumbnailPath = $request->file('thumbnail')->store('lecture_thumbnails', 'public');
    //     }

    //     // Upload Video

    // if($request->hasFile('video_file')){
    //     $videoPath = $request->file('video_file')->store('videos','public');
    // }

    //     Lecture::create([
    //         'course_id' => $request->course_id,
    //         'title' => $request->title,
    //         'file_path' => $filePath,
    //         'video_file' => $videoPath,
    //         'thumbnail' => $thumbnailPath
    //     ]);

    //     return redirect()->route('admin.lecture.list', $request->course_id)
    //                      ->with('success', 'Lecture Added Successfully');
    // }

        // Store Lecture
        public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'type' => 'required',
        'file' => 'required'
    ]);

    $filePath = null;
    $videoPath = null;

    if($request->type == 'pdf'){
        $filePath = $request->file('file')->store('lectures','public');
    }

    if($request->type == 'video'){
        $videoPath = $request->file('file')->store('videos','public');
    }

    Lecture::create([
        'course_id' => $request->course_id,
        'title' => $request->title,
        'type' => $request->type,
        'file_path' => $filePath,
        'video_file' => $videoPath,
    ]);

    return back()->with('success','Lecture added successfully');
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

    public function update(Request $request, $id)
{
    $lecture = Lecture::findOrFail($id);

    // ✅ Validation based on type
    if ($request->type == 'pdf') {
        $request->validate([
            'title' => 'required',
            'file' => 'nullable|mimes:pdf|max:10240'
        ]);
    }

    if ($request->type == 'video') {
        $request->validate([
            'title' => 'required',
            'file' => 'nullable|mimes:mp4,mov,avi|max:51200'
        ]);
    }

    $filePath = $lecture->file_path;
    $videoPath = $lecture->video_file;
    $thumbnailPath = $lecture->thumbnail;

    // ✅ Update PDF
    if ($request->type == 'pdf' && $request->hasFile('file')) {
        $filePath = $request->file('file')->store('lectures', 'public');

        // remove old video
        $videoPath = null;
    }

    // ✅ Update Video
    if ($request->type == 'video' && $request->hasFile('file')) {
        $videoPath = $request->file('file')->store('videos', 'public');

        // remove old pdf
        $filePath = null;
    }

    // Thumbnail (optional)
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('lecture_thumbnails', 'public');
    }

    // ✅ Update record
    $lecture->update([
        'title' => $request->title,
        'type' => $request->type,
        'file_path' => $filePath,
        'video_file' => $videoPath,
        'thumbnail' => $thumbnailPath
    ]);

    return redirect()->route('admin.lecture.list', $lecture->course_id)
                     ->with('success', 'Lecture Updated Successfully');
}
}