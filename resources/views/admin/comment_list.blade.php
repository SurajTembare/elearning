@extends('admin.master')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">All Comments</h3>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach($comments as $comment)

    <div class="card mb-3 shadow-sm">
        <div class="card-body">

            <!-- USER + BLOG -->
            <div class="mb-2">
                <strong>User:</strong> {{ $comment->user->name }} <br>
                <strong>Blog:</strong> {{ $comment->blog->title }}
            </div>

            <!-- STATUS -->
            <div class="mb-2">
                @if($comment->status == 0)
                    <span class="badge bg-warning text-dark">Pending</span>
                @else
                    <span class="badge bg-danger">Approved</span>
                @endif
            </div>

            <!-- COMMENT -->
            <div class="mb-2">
                <strong>Comment:</strong>
                <p class="mb-1">{{ $comment->comment }}</p>
            </div>

            <!-- ADMIN REPLY -->
            <form method="POST" action="{{ route('admin.comment.reply',$comment->id) }}">
                @csrf

                <textarea name="admin_reply"
                          class="form-control mb-2"
                          placeholder="Write reply...">{{ $comment->admin_reply }}</textarea>

                <button class="btn btn-success btn-sm">
                    Reply
                </button>
            </form>

            <!-- ACTION BUTTONS -->
            <div class="d-flex gap-2 mt-2">

                <!-- APPROVE BUTTON -->
                @if($comment->status == 0)
                    <form method="POST" action="{{ route('admin.comment.approve',$comment->id) }}">
                        @csrf
                        <button class="btn btn-primary btn-sm">
                            Approve
                        </button>
                    </form>
                @endif

                <!-- DELETE BUTTON -->
                <form method="POST"
                      action="{{ route('admin.comment.delete',$comment->id) }}">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this comment?')">
                        Delete
                    </button>
                </form>

            </div>

        </div>
    </div>

    @endforeach

</div>

@endsection