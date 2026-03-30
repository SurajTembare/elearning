@extends('master')
@section('content')
   <section class="about_section layout_padding">
   <div class="container">
      <div class="row align-items-center">

         <!-- Image -->
         <div class="col-md-6">
            <div class="img-box">
               <img src="{{ asset('front_end/images/about-edu.png') }}" alt="About Us" class="img-fluid">
            </div>
         </div>

         <!-- Content -->
         <div class="col-md-6">
            <div class="detail-box">
               <div class="heading_container">
                  <h2>
                     About Our Learning Platform
                  </h2>
               </div>

               <p>
                  Our educational platform provides high quality online courses designed
                  to help students learn new skills and advance their careers. We offer
                  structured video lectures, practical projects, and guidance from
                  experienced instructors.
               </p>

               <p>
                  Students can enroll in courses, track their learning progress, and
                  gain knowledge in various fields such as Web Development,
                  Programming, Data Science, and more.
               </p>

               <a href="/courses" class="btn btn-primary mt-3">
                  Explore Courses
               </a>
            </div>
         </div>

      </div>
   </div>
</section>
    @endsection