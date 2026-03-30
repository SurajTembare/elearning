@extends('master')

@section('content')

<div class="container mt-4">

    <div class="text-center mb-4">
        <h2 class="fw-bold">All Courses</h2>
        <p class="text-muted">Explore and start learning today</p>
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

</div>

@endsection