<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Mail\EnrollmentMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get()->take(3);
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::with('lectures')->findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function courses()
    {
        $courses = Course::all();
        return view('courses.courses', compact('courses'));
    }

    public function payment($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.payment', compact('course'));
    }

    // public function paymentSuccess($id)
    // {
    //     // 👉 Here later Razorpay/Stripe verification will come

    //     Enrollment::firstOrCreate([
    //         'user_id' => auth()->id(),
    //         'course_id' => $id
    //     ]);

    //     return redirect()->route('course.details', $id)
    //         ->with('success', 'Payment Successful & Enrolled!');
    // }
    public function paymentSuccess($id)
    {
        $user = auth()->user();
        $course = Course::findOrFail($id);

        // SAVE ENROLLMENT
        Enrollment::firstOrCreate([
            'user_id' => $user->id,
            'course_id' => $id
        ]);

        // SEND EMAIL
        Mail::to($user->email)->send(new EnrollmentMail($user, $course));

        return redirect()->route('course.details', $id)
            ->with('success', 'Payment successful & enrolled!');
    }
    public function myCourses()
    {
        $enrollments = Enrollment::with('course')
            ->where('user_id', auth()->id())
            ->get();

        return view('my_courses', compact('enrollments'));
    }
}
