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
    <div class="card shadow border-0 mb-4" style="border-radius:15px;">
        <div class="row g-0">

            <div class="col-md-4">
                <img src="{{ $course->thumbnail ? asset('storage/'.$course->thumbnail) : 'https://via.placeholder.com/400x250' }}"
                     class="img-fluid rounded-start"
                     style="height:100%; object-fit:cover;">
            </div>

            <div class="col-md-8">
                <div class="card-body d-flex flex-column justify-content-between h-100">

                    <div>
                        <h3 class="fw-bold">{{ $course->title }}</h3>

                        <p class="text-muted mb-3">
                            {{ $course->description }}
                        </p>

                        <h5>
                            @if($course->price > 0)
                                <span class="badge bg-danger px-3 py-2">₹{{ $course->price }}</span>
                            @else
                                <span class="badge bg-success px-3 py-2">Free Course</span>
                            @endif
                        </h5>
                    </div>

                    <div class="mt-3">
                        @auth
                            @if($course->is_paid && !$isEnrolled)
                                <a href="{{ route('course.payment',$course->id) }}" class="btn btn-warning">
                                    💳 Buy Now
                                </a>
                            @elseif(!$course->is_paid && !$isEnrolled)
                                <form method="POST" action="{{ route('course.enroll',$course->id) }}">
                                    @csrf
                                    <button class="btn btn-success">Enroll Now</button>
                                </form>
                            @else
                                <button class="btn btn-secondary" disabled>
                                    ✔ Already Enrolled
                                </button>
                            @endif
                        @else
                            <a href="/login" class="btn btn-primary">Login to Enroll</a>
                        @endauth
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- ===================== PDF SECTION ===================== -->
    <div class="mb-4">
        <h4 class="fw-bold">📄 Study Materials</h4>
        <p class="text-muted">Download notes for this course</p>
        <hr>
    </div>

    <div class="row">
    @php
        $pdfLectures = $course->lectures->where('type','pdf');
    @endphp

    @forelse($pdfLectures as $lecture)

        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm p-3 d-flex flex-row justify-content-between align-items-center pdf-card">

                <div>
                    <h6 class="mb-1">{{ $lecture->title }}</h6>
                    <small class="text-muted">PDF Notes</small>
                </div>

                @if($course->is_paid == 0 || $isEnrolled)
                    <a href="{{ asset('storage/'.$lecture->file_path) }}"
                       class="btn btn-sm btn-outline-primary">
                       Download
                    </a>
                @else
                    <span class="text-danger">🔒 Locked</span>
                @endif

            </div>
        </div>

    @empty
        <p>No notes available</p>
    @endforelse
    </div>


    <!-- ===================== VIDEO SECTION ===================== -->
    <div class="mt-5">
        <h4 class="fw-bold">🎥 Video Lectures</h4>
        <p class="text-muted">Watch recorded lectures</p>
        <hr>
    </div>

    <div class="row">

    @php
        $videoLectures = $course->lectures->where('type','video');
    @endphp

    @forelse($videoLectures as $lecture)

        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card border-0 shadow-sm video-card h-100">

                <!-- VIDEO -->
                @if($course->is_paid == 0 || $isEnrolled)
                    <video width="100%" height="180" controls style="border-top-left-radius:10px; border-top-right-radius:10px;">
                        <source src="{{ asset('storage/'.$lecture->video_file) }}" type="video/mp4">
                    </video>
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light"
                         style="height:180px; border-radius:10px 10px 0 0;">
                        🔒 Locked
                    </div>
                @endif

                <!-- CONTENT -->
                <div class="card-body">
                    <h6 class="mb-0">
                        {{ \Illuminate\Support\Str::limit($lecture->title, 45) }}
                    </h6>
                </div>

            </div>
        </div>

    @empty
        <div class="col-12">
            <p>No videos available</p>
        </div>
    @endforelse

    </div>

</div>

<style>
.video-card {
    border-radius: 10px;
    transition: 0.3s;
}

.video-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.1);
}

.pdf-card {
    border-radius: 10px;
    transition: 0.3s;
}

.pdf-card:hover {
    background: #f8f9fa;
}
</style>

@endsection