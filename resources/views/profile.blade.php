@extends('master')

@section('content')

<div class="container mt-5">

    <!-- PROFILE SECTION (TOP) -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <div class="row align-items-center">

                <!-- IMAGE -->
                <div class="col-md-2 text-center">
                    @if($user->profile)
                        <img src="{{ asset('storage/'.$user->profile) }}"
                             width="100" height="100"
                             class="rounded-circle"
                             style="object-fit:cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                             width="100" height="100"
                             class="rounded-circle">
                    @endif
                </div>

                <!-- USER INFO -->
                <div class="col-md-7">
                    <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-2">{{ $user->email }}</p>

                    <div class="d-flex gap-4">
                        <div>
                            <strong>{{ $enrollments->count() }}</strong><br>
                            <small class="text-muted">Courses</small>
                        </div>
                        <div>
                            <strong>0%</strong><br>
                            <small class="text-muted">Progress</small>
                        </div>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="col-md-3 text-end">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                        Edit Profile
                    </a>
                </div>

            </div>

        </div>
    </div>


    <!-- COURSES SECTION (BOTTOM) -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0">📚 Enrolled Courses</h4>
                <a href="/courses" class="btn btn-outline-secondary btn-sm">
                    Browse More
                </a>
            </div>

            <div class="row">

                @forelse($enrollments as $enroll)

                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">

                        <!-- IMAGE -->
                        @if($enroll->course->thumbnail)
                            <img src="{{ asset('storage/'.$enroll->course->thumbnail) }}"
                                 style="height:160px; object-fit:cover;">
                        @else
                            <img src="https://via.placeholder.com/300x160"
                                 style="height:160px; object-fit:cover;">
                        @endif

                        <!-- BODY -->
                        <div class="card-body d-flex flex-column">

                            <h6 class="fw-bold">
                                {{ $enroll->course->title }}
                            </h6>

                            <p class="text-muted" style="font-size:13px;">
                                {{ \Illuminate\Support\Str::limit($enroll->course->description, 60) }}
                            </p>

                            <!-- PROGRESS -->
                            <div class="mb-2">
                                <div class="progress" style="height:6px;">
                                    <div class="progress-bar" style="width: 0%"></div>
                                </div>
                            </div>

                            <!-- BUTTON -->
                            <a href="{{ route('course.details',$enroll->course->id) }}"
                               class="btn btn-primary btn-sm mt-auto">
                               Continue →
                            </a>

                        </div>

                    </div>
                </div>

                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <h5>No Courses Enrolled</h5>
                            <p>Start learning today 🚀</p>
                            <a href="/courses" class="btn btn-primary btn-sm">
                                Browse Courses
                            </a>
                        </div>
                    </div>
                @endforelse

            </div>

        </div>
    </div>

</div>

@endsection