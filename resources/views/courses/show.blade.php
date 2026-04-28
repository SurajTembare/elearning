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

                            @if($course->is_discount_active)

                            <!-- OFFER NAME -->
                            @if($course->offer_name)
                            <div class="badge bg-warning text-dark mb-1">
                                🎉 {{ $course->offer_name }}
                            </div>
                            @endif

                            <!-- OLD PRICE -->
                            <span class="text-muted text-decoration-line-through">
                                ₹{{ $course->price }}
                            </span>

                            <!-- DISCOUNT -->
                            <span class="badge bg-danger">
                                {{ $course->discount_percent }}% OFF
                            </span>

                            <!-- FINAL PRICE -->
                            <div class="text-success fw-bold mt-1">
                                ₹{{ $course->final_price }}
                            </div>

                            <!-- OFFER PERIOD -->
                            <small class="text-muted">
                                Offer valid:
                                {{ \Carbon\Carbon::parse($course->discount_start)->format('d M') }}
                                -
                                {{ \Carbon\Carbon::parse($course->discount_end)->format('d M Y') }}
                            </small>
                            @if($course->is_discount_active)

                            <div class="mt-2 p-2 rounded text-center" style="background:#fff3cd;">

                                <div class="fw-semibold text-dark mb-1">
                                    ⏳ Offer Ends In
                                </div>

                                <div id="countdown" class="d-flex justify-content-center gap-2">

                                    <span class="badge bg-dark" id="cd_days">00d</span>
                                    <span class="badge bg-dark" id="cd_hours">00h</span>
                                    <span class="badge bg-dark" id="cd_minutes">00m</span>
                                    <span class="badge bg-danger" id="cd_seconds">00s</span>

                                </div>

                            </div>

                            @endif
                            @else

                            <span class="badge bg-danger px-3 py-2">
                                ₹{{ $course->price }}
                            </span>

                            @endif

                            @else
                            <span class="badge bg-success px-3 py-2">
                                Free Course
                            </span>
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
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }

    .pdf-card {
        border-radius: 10px;
        transition: 0.3s;
    }

    .pdf-card:hover {
        background: #f8f9fa;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        let endDate = "{{ $course->discount_end }}";
        let endTime = new Date(endDate + " 23:59:59").getTime();

        let d = document.getElementById("cd_days");
        let h = document.getElementById("cd_hours");
        let m = document.getElementById("cd_minutes");
        let s = document.getElementById("cd_seconds");

        if (!d) return;

        let timer = setInterval(function() {

            let now = new Date().getTime();
            let distance = endTime - now;

            if (distance <= 0) {
                clearInterval(timer);
                document.getElementById("countdown").innerHTML =
                    '<span class="badge bg-secondary">Offer Expired</span>';
                return;
            }

            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            d.innerHTML = days + "d";
            h.innerHTML = hours + "h";
            m.innerHTML = minutes + "m";
            s.innerHTML = seconds + "s";

        }, 1000);

    });
</script>

@endsection