<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
public function enroll($course_id)
{
    $course = Course::findOrFail($course_id);

    // ❌ Block direct enroll if paid
    if($course->is_paid){
        return redirect()->route('course.payment', $course->id);
    }

    // ✅ Free course enroll
    Enrollment::firstOrCreate([
        'user_id' => auth()->id(),
        'course_id' => $course_id
    ]);

    return back()->with('success','Enrolled Successfully');
}
    // public function dashboards($id)
    // {
    //     $enrolledCourses = Enrollment::with('course')
    //         ->where('user_id', auth()->$id())
    //         ->get();

    //     return view('dashboards', compact('enrolledCourses'));
    // } 
}
