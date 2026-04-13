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
        return view('admin.index', compact('totalUsers', 'totalCourses', 'totalEnrollments'));
    }
}
