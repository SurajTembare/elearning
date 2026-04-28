@extends('master')

@section('content')

<div class="container mt-5 text-center">

    <div class="card p-4 shadow-sm">

        <h3>{{ $course->title }}</h3>

        <!-- PRICE SECTION -->
        @if($course->is_discount_active)

            <!-- OFFER -->
            @if($course->offer_name)
                <div class="badge bg-warning text-dark mb-2">
                    🎉 {{ $course->offer_name }}
                </div>
            @endif

            <!-- ORIGINAL PRICE -->
            <p class="text-muted text-decoration-line-through">
                ₹{{ $course->price }}
            </p>

            <!-- FINAL PRICE -->
            <h4 class="text-success">
                Pay ₹{{ $course->final_price }}
            </h4>

            <!-- DISCOUNT -->
            <small class="text-danger">
                {{ $course->discount_percent }}% OFF applied
            </small>

        @else

            <!-- NORMAL PRICE -->
            <h4 class="text-danger mt-3">
                Pay ₹{{ $course->price }}
            </h4>

        @endif

        <p class="text-muted mt-2">
            Complete payment to unlock this course
        </p>

        <!-- PAYMENT BUTTON -->
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