@extends('master')
@section('content')
<!-- end header section -->
<!-- slider section -->
<section class="slider_section ">
   <div class="slider_bg_box">
      <img src="{{asset('front_end/images/edutech.jpg')}}" alt="">
   </div>
   <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active">
            <div class="container ">
               <div class="row">
                  <div class="col-md-7 col-lg-6 ">
                     <div class="detail-box">
                        <h1>
                           <span>
                              Learn New Skill
                           </span>
                           <br>
                           Anytime Anywhere
                        </h1>
                        <p>
                           Join thousands of students learning new technologies.
                           Explore our online courses and upgrade your career
                           with practical knowledge.
                        </p>
                        <div class="btn-box">
                           <a href="" class="btn1">
                              Explore Courses
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="carousel-item ">
            <div class="container ">
               <div class="row">
                  <div class="col-md-7 col-lg-6 ">
                     <div class="detail-box">
                        <h1>
                           <span>
                              Online Learning
                           </span>
                           <br>
                           From Expert Teachers
                        </h1>
                        <p>Learn from industry professionals and experienced
                           instructors through structured video lectures and
                           real world projects.
                        </p>
                        <div class="btn-box">
                           <a href="" class="btn1">
                              Start Learning
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="carousel-item">
            <div class="container ">
               <div class="row">
                  <div class="col-md-7 col-lg-6 ">
                     <div class="detail-box">
                        <h1>
                           <span>
                              Upgrade Your Career
                           </span>
                           <br>
                           On Everything
                        </h1>
                        <p>
                           Build your future with modern courses like
                           Web Development, Programming, Data Science,
                           and many more professional skills.
                        </p>
                        <div class="btn-box">
                           <a href="" class="btn1">
                              View Courses
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <ol class="carousel-indicators">
            <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
            <li data-target="#customCarousel1" data-slide-to="1"></li>
            <li data-target="#customCarousel1" data-slide-to="2"></li>
         </ol>
      </div>
   </div>
</section>
<!-- end slider section -->
</div>
<!-- why section -->
<section class="why_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
         <h2>
            Why Learn With Us
         </h2>
      </div>

      <div class="row">

         <!-- Feature 1 -->
         <div class="col-md-4">
            <div class="box">
               <div class="img-box">
                  <!-- keep same SVG icon -->
                  <!-- (no change needed) -->
               </div>
               <div class="detail-box">
                  <h5>
                     Expert Instructors
                  </h5>
                  <p>
                     Learn from experienced teachers and industry experts with practical knowledge.
                  </p>
               </div>
            </div>
         </div>

         <!-- Feature 2 -->
         <div class="col-md-4">
            <div class="box" style="height: 225px;">
               <div class="img-box">
                  <!-- keep same SVG icon -->
               </div>
               <div class="detail-box">
                  <h5>
                     Learn Anytime Anywhere
                  </h5>
                  <p>
                     Access courses online anytime from your mobile, tablet, or computer.
                  </p>
               </div>
            </div>
         </div>

         <!-- Feature 3 -->
         <div class="col-md-4">
            <div class="box">
               <div class="img-box">
                  <!-- keep same SVG icon -->
               </div>
               <div class="detail-box">
                  <h5>
                     Certification Courses
                  </h5>
                  <p>
                     Complete courses and receive certificates to boost your career opportunities.
                  </p>
               </div>
            </div>
         </div>

      </div>
   </div>
</section>
<!-- end why section -->

<!-- arrival section -->
<section class="arrival_section">
   <div class="container">
      <div class="box">
         <div class="arrival_bg_box">
            <img src="{{asset('front_end/images/arrival-bg.png')}}" alt="">
         </div>
         <div class="row">
            <div class="col-md-6 ml-auto">
               <div class="heading_container remove_line_bt">
                  <h2>
                     #NewArrivals
                  </h2>
               </div>
                <p style="margin-top: 20px;margin-bottom: 30px;">
                  Upgrade your skills with our latest courses designed by industry experts. 
                  Learn Web Development, Programming, and more with structured lessons, 
                  practical examples, and real-world projects.
               </p>
               <a href="/courses" class="btn btn-primary">
                  Explore Courses
               </a>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- end arrival section -->

<!-- product section -->
<section class="product_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
         <h2>
            Our <span>Courses</span>
         </h2>
      </div>
      <div class="row">


         @forelse($courses as $course)

         <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">

               <!-- Thumbnail -->
               @if($course->thumbnail)
               <img src="{{ asset('storage/'.$course->thumbnail) }}" height="200">
               @endif

               <div class="card-body d-flex flex-column">

                  <h5 class="card-title">
                     {{ $course->title }}
                  </h5>

                  <p class="card-text text-muted" style="font-size:14px;">
                     {{ \Illuminate\Support\Str::limit($course->description, 80) }}
                  </p>

                  <!-- Price -->
                  <div class="mb-3">
                     @if($course->price > 0)
                     <span class="badge bg-danger">₹{{ $course->price }}</span>
                     @else
                     <span class="badge bg-success">Free</span>
                     @endif
                  </div>

                  <!-- Button -->
                  <a href="{{ route('course.details',$course->id) }}"
                     class="btn btn-primary mt-auto">
                     View Course
                  </a>

               </div>

            </div>
         </div>

         @empty
         <div class="col-12">
            <div class="alert alert-info text-center">
               No courses available right now.
            </div>
         </div>
         @endforelse


      </div>

      <div class="btn-box">
         <a href="/courses">
            View All Courses
         </a>
      </div>
   </div>
</section>
<!-- end product section -->

<!-- subscribe section -->
<section class="subscribe_section">
   <div class="container-fuild">
      <div class="box">
         <div class="row">
            <div class="col-md-6 offset-md-3">
               <div class="subscribe_form ">
                  <div class="heading_container heading_center">
                     <h3>Subscribe To Get Discount Offers</h3>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                  <form action="">
                     <input type="email" placeholder="Enter your email">
                     <button>
                        subscribe
                     </button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- end subscribe section -->
<!-- client section -->
<!-- <section class="client_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
         <h2>
            Customer's Testimonial
         </h2>
      </div>
      <div id="carouselExample3Controls" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="box col-lg-10 mx-auto">
                  <div class="img_container">
                     <div class="img-box">
                        <div class="img_box-inner">
                           <img src="{{asset('front_end/images/client.jpg')}}" alt="">
                        </div>
                     </div>
                  </div>
                  <div class="detail-box">
                     <h5>
                        Anna Trevor
                     </h5>
                     <h6>
                        Customer
                     </h6>
                     <p>
                        Dignissimos reprehenderit repellendus nobis error quibusdam? Atque animi sint unde quis reprehenderit, et, perspiciatis, debitis totam est deserunt eius officiis ipsum ducimus ad labore modi voluptatibus accusantium sapiente nam! Quaerat.
                     </p>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="box col-lg-10 mx-auto">
                  <div class="img_container">
                     <div class="img-box">
                        <div class="img_box-inner">
                           <img src="{{asset('front_end/images/client.jpg')}}" alt="">
                        </div>
                     </div>
                  </div>
                  <div class="detail-box">
                     <h5>
                        Anna Trevor
                     </h5>
                     <h6>
                        Customer
                     </h6>
                     <p>
                        Dignissimos reprehenderit repellendus nobis error quibusdam? Atque animi sint unde quis reprehenderit, et, perspiciatis, debitis totam est deserunt eius officiis ipsum ducimus ad labore modi voluptatibus accusantium sapiente nam! Quaerat.
                     </p>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="box col-lg-10 mx-auto">
                  <div class="img_container">
                     <div class="img-box">
                        <div class="img_box-inner">
                           <img src="{{asset('front_end/images/client.jpg')}}" alt="">
                        </div>
                     </div>
                  </div>
                  <div class="detail-box">
                     <h5>
                        Anna Trevor
                     </h5>
                     <h6>
                        Customer
                     </h6>
                     <p>
                        Dignissimos reprehenderit repellendus nobis error quibusdam? Atque animi sint unde quis reprehenderit, et, perspiciatis, debitis totam est deserunt eius officiis ipsum ducimus ad labore modi voluptatibus accusantium sapiente nam! Quaerat.
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <div class="carousel_btn_box">
            <a class="carousel-control-prev" href="#carouselExample3Controls" role="button" data-slide="prev">
               <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
               <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample3Controls" role="button" data-slide="next">
               <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
               <span class="sr-only">Next</span>
            </a>
         </div>
      </div>
   </div>
</section> -->
<!-- end client section -->
<!-- footer start -->
@endsection