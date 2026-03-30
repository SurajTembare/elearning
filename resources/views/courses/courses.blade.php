@extends('master')

@section('content')

<div class="container mt-5">

    <!-- Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Latest Courses</h2>

        <!-- View All Button (optional) -->
        <a href="" class="btn btn-outline-primary">
            View All
        </a>
    </div>

    <div class="row">

        @forelse($courses as $course)

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">

                <!-- Thumbnail -->
                @if($course->thumbnail)
                    <img src="{{ asset('storage/'.$course->thumbnail) }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/400x200"
                         class="card-img-top">
                @endif

                <div class="card-body d-flex flex-column">

                    <!-- Title -->
                    <h5 class="card-title">
                        {{ $course->title }}
                    </h5>

                    <!-- Description -->
                    <p class="text-muted" style="font-size:14px;">
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
                    No courses available.
                </div>
            </div>
        @endforelse

    </div>

</div>

@endsection