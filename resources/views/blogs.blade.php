@extends('master')

@section('content')

<div class="container mt-5">
    <h2 style="text-align: center;color:blueviolet;font-weight: bolder;">Blogs</h2>

    <div class="row mt-4">

    @foreach($blogs as $blog)
    <div class="col-md-4 mb-3">
        <div class="card">

            @if($blog->image)
                <img src="{{ asset('storage/'.$blog->image) }}" height="200">
            @endif

            <div class="card-body">
                <h5>{{ $blog->title }}</h5>

                <a href="{{ route('blog.details',$blog->slug) }}" class="btn btn-primary">
                    Read More
                </a>
            </div>
        </div>
    </div>
    @endforeach

    </div>
</div>

@endsection