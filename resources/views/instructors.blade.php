@extends('master')

@section('content')

<div class="container mt-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold">Our Instructors</h2>
        <p class="text-muted">
            Learn from experienced professionals and industry experts
        </p>
    </div>

    <div class="row">

        @forelse($instructors as $ins)

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm border-0 h-100">

                <!-- Image -->
                @if($ins->image)
                    <img src="{{ asset('storage/'.$ins->image) }}"
                         class="rounded-circle mx-auto mt-3"
                         width="120" height="120"
                         style="object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/120"
                         class="rounded-circle mx-auto mt-3">
                @endif

                <div class="card-body">

                    <h5 class="card-title">{{ $ins->name }}</h5>

                    <p class="text-muted">{{ $ins->designation }}</p>

                    <p style="font-size:14px;">
                        {{ \Illuminate\Support\Str::limit($ins->bio, 100) }}
                    </p>

                </div>

            </div>
        </div>

        @empty

        <div class="col-12">
            <div class="alert alert-info text-center">
                No instructors available.
            </div>
        </div>

        @endforelse

    </div>

</div>

@endsection