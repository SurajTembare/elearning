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
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CommentController;
use Illuminate\Foundation\Auth\User;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserController::class, 'indexx'])->name('indexx');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/courses', [CourseController::class, 'courses'])->name('courses');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/insertcontact', [ContactController::class, 'insertcontact'])->name('insertcontact');

Route::get('/instructors', [UserController::class, 'instructors'])->name('instructors');


Route::get('/blogs', [BlogController::class, 'blogs'])->name('blogs');
Route::get('/blog/{slug}', [BlogController::class, 'blogDetails'])->name('blog.details');
Route::post('/comment/store', [BlogController::class, 'storeComment'])->name('comment.store')->middleware('auth', 'verified');
// Route::post('/admin/reply/store/{id}', [BlogController::class, 'reply'])->name('admin.comment.reply')->middleware('auth', 'admin');


//profile
Route::middleware('auth')->group(function () {
    Route::get('/student/profile', [UserController::class, 'profile'])
        ->name('student.profile');
});

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

Route::get('/my-courses', [CourseController::class, 'myCourses'])
    ->name('my.courses')
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







Route::prefix('admin')->name('admin.')->group(function () {

    // Add lecture form (course wise)
    Route::get('/lecture/create/{course_id}', [AdminLectureController::class, 'create'])->name('lecture.create')->middleware(['auth', 'admin']);

    // Store lecture
    Route::post('/lecture/store', [AdminLectureController::class, 'store'])->name('lecture.store')->middleware(['auth', 'admin']);

    // Lecture list (course wise)
    Route::get('/lecture/list/{course_id}', [AdminLectureController::class, 'list'])->name('lecture.list')->middleware(['auth', 'admin']);

    //lecture delete
    Route::get('/lecture/delete/{id}', [AdminLectureController::class, 'delete'])->name('lecture.delete')->middleware(['auth', 'admin']);
    //lecture edit
    Route::get('/lecture/edit/{id}', [AdminLectureController::class, 'edit'])->name('lecture.edit')->middleware(['auth', 'admin']);
    Route::post('/lecture/update/{id}', [AdminLectureController::class, 'update'])->name('lecture.update')->middleware(['auth', 'admin']);
    //add courses
    Route::get('/courses', [AdminCourseController::class, 'index'])->name('course.list')->middleware(['auth', 'admin']);

    Route::get('/courses/create', [AdminCourseController::class, 'create'])->name('course.create')->middleware(['auth', 'admin']);

    Route::post('/courses/store', [AdminCourseController::class, 'store'])->name('course.store')->middleware(['auth', 'admin']);

    Route::get('/course/delete/{id}', [AdminCourseController::class, 'delete'])->name('course.delete')->middleware(['auth', 'admin']);

    Route::get('/course/edit/{id}', [AdminCourseController::class, 'edit'])->name('course.edit')->middleware(['auth', 'admin']);

    Route::post('/course/update/{id}', [AdminCourseController::class, 'update'])->name('course.update')->middleware(['auth', 'admin']);

    //contact
    Route::get('/contactlist', [ContactController::class, 'contactlist'])->name('contactlist')->middleware(['auth', 'admin']);

    //instructor
    Route::get('/instructors', [InstructorController::class, 'index'])->name('instructor.list')->middleware(['auth', 'admin']);
    Route::get('/instructor/create', [InstructorController::class, 'create'])->name('instructor.create')->middleware(['auth', 'admin']);
    Route::post('/instructor/store', [InstructorController::class, 'store'])->name('instructor.store')->middleware(['auth', 'admin']);

    Route::get('/instructor/edit/{id}', [InstructorController::class, 'edit'])->name('instructor.edit')->middleware(['auth', 'admin']);
    Route::post('/instructor/update/{id}', [InstructorController::class, 'update'])->name('instructor.update')->middleware(['auth', 'admin']);

    Route::get('/instructor/delete/{id}', [InstructorController::class, 'delete'])->name('instructor.delete')->middleware(['auth', 'admin']);

    //blog
    Route::get('/blogs', [BlogController::class, 'index'])->name('blog.list')->middleware(['auth', 'admin']);
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create')->middleware(['auth', 'admin']);
    Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store')->middleware(['auth', 'admin']);

    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit')->middleware(['auth', 'admin']);
    Route::post('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update')->middleware(['auth', 'admin']);

    Route::get('/blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete')->middleware(['auth', 'admin']);

    //comment
    Route::get('/comments', [CommentController::class, 'index'])->name('comment.list')->middleware(['auth', 'admin']);

    Route::post('/comment/reply/{id}', [CommentController::class, 'reply'])
        ->name('comment.reply')->middleware(['auth', 'admin']);

    Route::delete('/comment/{id}', [CommentController::class, 'delete'])
        ->name('comment.delete')->middleware(['auth', 'admin']);

        Route::post('/comment/approve/{id}', [CommentController::class, 'approve'])
    ->name('comment.approve')->middleware(['auth', 'admin']);
   
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