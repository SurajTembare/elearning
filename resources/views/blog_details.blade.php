@extends('master')

@section('content')

<div class="container mt-5">

    <!-- BLOG CONTENT -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h2 class="mb-3">{{ $blog->title }}</h2>

            @if($blog->image)
                <img src="{{ asset('storage/'.$blog->image) }}"
                     class="img-fluid mb-3"
                     style="max-height:400px; width:100%; object-fit:cover;">
            @endif

            <div class="mb-3">
                {!! $blog->content !!}
            </div>

        </div>
    </div>


    <!-- COMMENTS SECTION -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h4 class="mb-3">💬 Comments</h4>

            @forelse($blog->comments as $comment)

                <div class="mb-3 p-3 border rounded">

                    <!-- USER INFO -->
                    <div class="d-flex justify-content-between">
                        <strong>{{ $comment->user->name }}</strong>
                        <small class="text-muted">
                            {{ $comment->created_at->diffForHumans() }}
                        </small>
                    </div>

                    <!-- USER COMMENT -->
                    <p class="mt-2 mb-2">{{ $comment->comment }}</p>

                    <!-- ADMIN REPLY -->
                    @if($comment->admin_reply)
                        <div class="mt-2 p-2 bg-light border rounded">

                            <div class="d-flex align-items-center mb-1">
                                <strong class="text-primary me-2">Admin</strong>
                                <span class="badge bg-primary">Reply</span>
                            </div>

                            <p class="mb-0">{{ $comment->admin_reply }}</p>

                        </div>
                    @endif

                </div>

            @empty
                <p class="text-muted">No comments yet. Be the first to comment!</p>
            @endforelse

        </div>
    </div>


    <!-- ADD COMMENT -->
    <div class="card shadow-sm">
        <div class="card-body">

            <h5 class="mb-3">Leave a Comment</h5>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @auth
                <form method="POST" action="{{ route('comment.store') }}">
                    @csrf

                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">

                    <textarea name="comment"
                              class="form-control mb-3"
                              rows="3"
                              placeholder="Write your comment..."
                              required></textarea>

                    <button class="btn btn-primary">
                        Post Comment
                    </button>
                </form>
            @else
                <div class="alert alert-warning">
                    Please <a href="{{ route('login') }}">login</a> to post a comment.
                </div>
            @endauth

        </div>
    </div>

</div>

@endsection