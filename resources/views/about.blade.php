@extends('master')

@section('content')

<!-- ABOUT SECTION -->
<section class="about_section layout_padding">
   <div class="container">
      <div class="row align-items-center">

         <!-- Image -->
         <div class="col-md-6">
            <div class="img-box">
               <img src="{{ asset('front_end/images/about-edu.png') }}" class="img-fluid">
            </div>
         </div>

         <!-- Content -->
         <div class="col-md-6">
            <h2>About Our Learning Platform</h2>

            <p>
               Our platform is designed to provide high-quality online education
               to students worldwide. We focus on practical learning, real-world
               skills, and career growth.
            </p>

            <p>
               Whether you are a beginner or an advanced learner, our courses help
               you gain expertise in Web Development, Programming, Data Science,
               and many more domains.
            </p>

            <a href="/courses" class="btn btn-primary mt-3">
               Explore Courses
            </a>
         </div>

      </div>
   </div>
</section>

<!-- FEATURES -->
<section class="layout_padding bg-light" style="padding-left: 300px;">
   <div class="container text-center">
      <h2 class="mb-3" style="padding-right:300px;">Our Features</h2>

      <div class="row">

         <div class="col-md-3">
            <div class="card p-3 shadow-sm">
               <h5>📚 Quality Courses</h5>
               <p>Expert-designed courses with real-world examples.</p>
            </div>
         </div>

         <!-- <div class="col-md-3">
            <div class="card p-3 shadow-sm">
               <h5>🎥 Video Lectures</h5>
               <p>Structured lessons with easy-to-follow videos.</p>
            </div>
         </div> -->

         <div class="col-md-3">
            <div class="card p-3 shadow-sm">
               <h5>📄 Download Notes</h5>
               <p>Get PDFs and materials for offline study.</p>
            </div>
         </div>

         <div class="col-md-3">
            <div class="card p-3 shadow-sm">
               <h5>📈 Track Progress</h5>
               <p>Monitor your learning journey and growth.</p>
            </div>
         </div>

      </div>
   </div>
</section>

<!-- WHY CHOOSE US -->
<section class="layout_padding">
   <div class="container">
      <h2 class="text-center mb-4">Why Choose Us</h2>

      <div class="row">

         <div class="col-md-6">
            <ul class="list-group">
               <li class="list-group-item">✔ Beginner to Advanced Courses</li>
               <li class="list-group-item">✔ Affordable Pricing</li>
               <li class="list-group-item">✔ Learn Anytime, Anywhere</li>
               <li class="list-group-item">✔ Industry Relevant Skills</li>
            </ul>
         </div>

         <div class="col-md-6">
            <ul class="list-group">
               <li class="list-group-item">✔ Expert Instructors</li>
               <li class="list-group-item">✔ Practical Projects</li>
               <li class="list-group-item">✔ Lifetime Access</li>
               <li class="list-group-item">✔ Certificate After Completion</li>
            </ul>
         </div>

      </div>
   </div>
</section>

<!-- STATS -->
<section class="layout_padding bg-dark text-white text-center">
   <div class="container">
      <div class="row">

         <div class="col-md-3">
            <h2>{{ $userCount }}</h2>
            <p>Users</p>
         </div>

         <div class="col-md-3">
            <h2>{{ $courseCount }}</h2>
            <p>Courses</p>
         </div>

         <div class="col-md-3">
            <h2>{{ $enrollmentCount }}</h2>
            <p>Enrollments</p>
         </div>

         <div class="col-md-3">
            <h2>4.8⭐</h2>
            <p>Ratings</p>
         </div>

      </div>
   </div>
</section>

<!-- HOW IT WORKS -->
<section class="layout_padding">
   <div class="container text-center">

      <h2 class="mb-4">How It Works</h2>

      <div class="row">

         <div class="col-md-3">
            <h5>1. Sign Up</h5>
            <p>Create your account</p>
         </div>

         <div class="col-md-3">
            <h5>2. Choose Course</h5>
            <p>Select your desired course</p>
         </div>

         <div class="col-md-3">
            <h5>3. Enroll</h5>
            <p>Free or paid enrollment</p>
         </div>

         <div class="col-md-3">
            <h5>4. Start Learning</h5>
            <p>Watch lectures & download notes</p>
         </div>

      </div>

   </div>
</section>

<!-- CTA -->
<section class="layout_padding bg-primary text-white text-center">
   <div class="container">

      <h2>Start Learning Today 🚀</h2>
      <p>Join thousands of students improving their skills.</p>

      <a href="/courses" class="btn btn-light mt-3">
         Browse Courses
      </a>

   </div>
</section>

@endsection