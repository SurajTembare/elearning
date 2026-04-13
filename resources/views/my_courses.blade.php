@extends('master')

@section('content')

<div class="container mt-5">

    <h2>My Courses</h2>

    <div class="row">

        @forelse($enrollments as $enroll)

        <div class="col-md-4 mb-3">
            <div class="card">

                <img src="{{ asset('storage/'.$enroll->course->thumbnail) }}" height="200">

                <div class="card-body">

                    <h5>{{ $enroll->course->title }}</h5>

                    <a href="{{ route('course.details',$enroll->course->id) }}"
                       class="btn btn-primary">
                       Continue Learning
                    </a>

                </div>
            </div>
        </div>

        @empty
            <div class="alert alert-info">
                No courses enrolled yet.
            </div>
        @endforelse

    </div>

</div>

@endsection