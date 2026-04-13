<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Instructor;

class UserController extends Controller
{
    // public function indexx()
    // {
    //     return view('indexx');
    // }
  public function index()
    {
        $courses = Course::latest()->get()->take(3);
        return view('courses.index', compact('courses'));
    }

    public function about()
    {
        $userCount = \App\Models\User::count();
        $courseCount = \App\Models\Course::count();
        $enrollmentCount = \App\Models\Enrollment::count();
        return view('about', compact('userCount', 'courseCount', 'enrollmentCount'));
    }

    public function instructors()
{
    $instructors = Instructor::latest()->get();

    return view('instructors', compact('instructors'));
}

public function profile()
{
    $user = auth()->user();

    $enrollments = Enrollment::with('course')
                    ->where('user_id', $user->id)
                    ->get();

    return view('profile', compact('user','enrollments'));
}
}
