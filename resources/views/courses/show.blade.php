@extends('master')

@section('content')

@php
    $isEnrolled = false;

    if(auth()->check()) {
        $isEnrolled = \App\Models\Enrollment::where('user_id', auth()->id())
                        ->where('course_id', $course->id)
                        ->exists();
    }
@endphp

<div class="container mt-4">

    <!-- COURSE HEADER -->
    <div class="card shadow-sm mb-4">
        <div class="row g-0">

            <!-- Thumbnail -->
            <div class="col-md-4">
                @if($course->thumbnail)
                    <img src="{{ asset('storage/'.$course->thumbnail) }}" 
                         class="img-fluid rounded-start" 
                         style="height:100%; object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/400x250" 
                         class="img-fluid rounded-start">
                @endif
            </div>

            <!-- Course Info -->
            <div class="col-md-8">
                <div class="card-body">

                    <h3 class="card-title">{{ $course->title }}</h3>

                    <p class="text-muted">
                        {{ $course->description }}
                    </p>

                    <h5 class="mb-3">
                        @if($course->price > 0)
                            <span class="badge bg-danger">₹{{ $course->price }}</span>
                        @else
                            <span class="badge bg-success">Free Course</span>
                        @endif
                    </h5>

                    <!-- SUCCESS MESSAGE -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @auth

                        @if($course->is_paid)

                            @if(!$isEnrolled)
                                <!-- 🔴 Paid Course -->
                                <a href="{{ route('course.payment',$course->id) }}" 
                                   class="btn btn-warning">
                                   💳 Buy Now
                                </a>
                            @else
                                <button class="btn btn-secondary" disabled>
                                    ✔ Already Purchased
                                </button>
                            @endif

                        @else

                            <!-- 🟢 Free Course -->
                            @if(!$isEnrolled)
                                <form method="POST" action="{{ route('course.enroll',$course->id) }}">
                                    @csrf
                                    <button class="btn btn-success">
                                        Enroll Now
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary" disabled>
                                    ✔ Already Enrolled
                                </button>
                            @endif

                        @endif

                    @else
                        <a href="/login" class="btn btn-primary">
                            Login to Enroll
                        </a>
                    @endauth

                </div>
            </div>

        </div>
    </div>


    <!-- LECTURES SECTION -->
    <div class="mb-3">
        <h4 class="fw-bold">Course Lectures</h4>
        <hr>
    </div>

    @forelse($course->lectures as $lecture)

    <div class="card shadow-sm mb-3">
        <div class="card-body">

            <h5 class="mb-2">{{ $lecture->title }}</h5>

            {{-- 🔐 ACCESS CONTROL --}}
            @if($course->is_paid == 0 || $isEnrolled)

                <!-- Video -->
                @if($lecture->video_url)
                    <div class="mb-3">
                        <iframe width="100%" height="300"
                            src="{{ $lecture->video_url }}"
                            frameborder="0"
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif

                <!-- PDF -->
                @if($lecture->file_path)
                    <a href="{{ asset('storage/'.$lecture->file_path) }}"
                       target="_blank"
                       class="btn btn-outline-info btn-sm">
                       📄 Download Notes
                    </a>
                @endif

            @else

                <!-- LOCKED -->
                <div class="alert alert-warning d-flex justify-content-between align-items-center">
                    <span>🔒 This lecture is locked</span>

                    <a href="{{ route('course.payment',$course->id) }}" 
                       class="btn btn-sm btn-warning">
                        Unlock Now
                    </a>
                </div>

            @endif

        </div>
    </div>

    @empty
        <div class="alert alert-info">
            No lectures available for this course.
        </div>
    @endforelse

</div>

@endsection