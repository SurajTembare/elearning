<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Admin\LectureController as AdminLectureController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ContactController;
use Illuminate\Foundation\Auth\User;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserController::class, 'indexx'])->name('indexx');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/courses', [CourseController::class, 'courses'])->name('courses');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/insertcontact', [ContactController::class, 'insertcontact'])->name('insertcontact');

// Home - All Courses
Route::get('/', [CourseController::class, 'index'])
    ->name('courses.index');

// Course Details
Route::get('/course/{id}', [CourseController::class, 'show'])
    ->name('course.details');
// Course Payment
Route::get('/course/payment/{id}', [CourseController::class, 'payment'])->name('course.payment');

Route::post('/course/payment/success/{id}', [CourseController::class, 'paymentSuccess'])->name('course.payment.success');
    
//enroll
   Route::post('/course/enroll/{course_id}', [EnrollmentController::class, 'enroll'])
    ->name('course.enroll')
    ->middleware('auth', 'verified');


//STUDENT ROUTES AUTH REQUIRED


Route::middleware(['auth'])->group(function () {

    // Enroll Course
    Route::post('/course/enroll/{id}', [EnrollmentController::class, 'enroll'])
        ->name('course.enroll');

    // Student Dashboard
    Route::get('/dashboard', [EnrollmentController::class, 'dashboard'])
        ->name('dashboard');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin']);

// Course List
// Route::get('/courses', [AdminCourseController::class, 'index'])
//     ->name('admin.course.list')->middleware(['auth', 'admin']);;

// // Create Course Form
// Route::get('/courses/create', [AdminCourseController::class, 'create'])
//     ->name('admin.course.create')->middleware(['auth', 'admin']);;

// // Store Course
// Route::post('/courses', [AdminCourseController::class, 'store'])
//     ->name('admin.course.store');

// Route::get('/courses/{id}/lectures/create', [AdminLectureController::class, 'create'])
//     ->name('admin.lecture.create')->middleware(['auth', 'admin']);;

// // Store Lecture

//   Route::get('/courses/{id}/lectures', [AdminLectureController::class, 'index'])
//         ->name('admin.lecture.list')->middleware(['auth', 'admin']);;

//     Route::get('/courses/{id}/lecture/create', [AdminLectureController::class, 'create'])
//         ->name('admin.lecture.create')->middleware(['auth', 'admin']);

//     Route::post('/lectures', [AdminLectureController::class, 'store'])
//         ->name('admin.lecture.store')->middleware(['auth', 'admin']);

// // Courses
// Route::get('/courses', [AdminCourseController::class, 'index'])
//     ->name('admin.course.list')->middleware(['auth', 'admin']);

// Route::get('/courses/create', [AdminCourseController::class, 'create'])
//     ->name('admin.course.create')->middleware(['auth', 'admin']);

// Route::post('/courses', [AdminCourseController::class, 'store'])
//     ->name('admin.course.store')->middleware(['auth', 'admin']);


// // Lectures
// Route::get('/courses/{id}/lectures', [AdminLectureController::class, 'index'])
//     ->name('admin.lecture.list')->middleware(['auth', 'admin']);

// Route::get('/courses/{id}/lectures/create', [AdminLectureController::class, 'create'])
//     ->name('admin.lecture.create')->middleware(['auth', 'admin']);

// Route::post('/lectures', [AdminLectureController::class, 'store'])
//     ->name('admin.lecture.store')->middleware(['auth', 'admin']); 

Route::prefix('admin')->name('admin.')->group(function () {

    // Add lecture form (course wise)
    Route::get('/lecture/create/{course_id}', [AdminLectureController::class, 'create'])->name('lecture.create')->middleware(['auth', 'admin']);

    // Store lecture
    Route::post('/lecture/store', [AdminLectureController::class, 'store'])->name('lecture.store')->middleware(['auth', 'admin']);

    // Lecture list (course wise)
    Route::get('/lecture/list/{course_id}', [AdminLectureController::class, 'list'])->name('lecture.list')->middleware(['auth', 'admin']);

    //add courses
      Route::get('/courses', [AdminCourseController::class, 'index'])->name('course.list')->middleware(['auth', 'admin']);

    Route::get('/courses/create', [AdminCourseController::class, 'create'])->name('course.create')->middleware(['auth', 'admin']);

    Route::post('/courses/store', [AdminCourseController::class, 'store'])->name('course.store')->middleware(['auth', 'admin']);

    //contact
    Route::get('/contactlist', [ContactController::class, 'contactlist'])->name('contactlist')->middleware(['auth', 'admin']);
});
// Route::get('add_category', [AdminController::class, 'add_category'])->middleware(['auth', 'admin']);
// Route::post('post_category', [AdminController::class, 'post_category'])->middleware(['auth', 'admin']);
// Route::get('viewcategory', [AdminController::class, 'viewCategory'])->name('viewcategory')
//     ->middleware(['auth', 'admin']);


// Route::get('delete_category/{id}', [AdminController::class, 'deleteCategory'])->middleware(['auth', 'admin']);
// Route::get('update_category/{id}', [AdminController::class, 'updateCategory'])->middleware(['auth', 'admin']);
// Route::post('postUpdateCategory/{id}', [AdminController::class, 'postUpdateCategory'])->middleware(['auth', 'admin']);
// Route::get('add_product', [AdminController::class, 'add_product'])->middleware(['auth', 'admin']);
// Route::post('upload_product', [AdminController::class, 'upload_product'])->middleware(['auth', 'admin']);
// Route::get('view_product', [AdminController::class, 'view_product'])->middleware(['auth', 'admin']);