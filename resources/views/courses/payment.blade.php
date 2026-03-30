@extends('master')

@section('content')

<div class="container mt-5 text-center">

    <div class="card p-4 shadow-sm">

        <h3>{{ $course->title }}</h3>

        <h4 class="text-danger mt-3">
            Pay ₹{{ $course->price }}
        </h4>

        <p class="text-muted">
            Complete payment to unlock this course
        </p>

        <!-- FAKE PAYMENT BUTTON (for now) -->
        <form method="POST" action="{{ route('course.payment.success', $course->id) }}">
            @csrf
            <button class="btn btn-success">
                Pay Now
            </button>
        </form>

        <br>

        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            Cancel
        </a>

    </div>

</div>

@endsection