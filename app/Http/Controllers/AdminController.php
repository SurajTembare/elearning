<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;

use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('user_type', 'user')->count();
        $totalCourses = Course::count();
        $totalEnrollments = Enrollment::count();
        $totalRevenue = Enrollment::with('course')->get()->sum(function ($enrollment) {
            return $enrollment->course ? $enrollment->course->price : 0;
        });
        return view('admin.index', compact('totalUsers', 'totalCourses', 'totalEnrollments', 'totalRevenue'));
    }
}
