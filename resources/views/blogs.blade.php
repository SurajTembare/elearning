@extends('master')

@section('content')

<div class="container mt-5">

    <!-- HEADING -->
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color:#6f42c1;">📝 Our Blogs</h2>
        <p class="text-muted">Latest articles, tutorials & insights</p>
    </div>

    <div class="row">

        @forelse($blogs as $blog)

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 blog-card">

                <!-- IMAGE -->
                @if($blog->image)
                    <img src="{{ asset('storage/'.$blog->image) }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/400x200"
                         class="card-img-top">
                @endif

                <!-- BODY -->
                <div class="card-body d-flex flex-column">

                    <!-- TITLE -->
                    <h5 class="fw-bold">
                        {{ \Illuminate\Support\Str::limit($blog->title, 60) }}
                    </h5>

                    <!-- SHORT DESC -->
                    <p class="text-muted" style="font-size:14px;">
                        {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 100) }}
                    </p>

                    <!-- BUTTON -->
                    <a href="{{ route('blog.details',$blog->slug) }}"
                       class="btn btn-outline-primary mt-auto">
                        Read More →
                    </a>

                </div>

                <!-- FOOTER -->
                <div class="card-footer bg-white border-0 text-muted" style="font-size:13px;">
                    {{ $blog->created_at->diffForHumans() }}
                </div>

            </div>
        </div>

        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    No blogs available yet.
                </div>
            </div>
        @endforelse

    </div>

</div>


<!-- OPTIONAL STYLING -->
<style>
.blog-card {
    transition: all 0.3s ease;
    border-radius: 10px;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
</style>

@endsection