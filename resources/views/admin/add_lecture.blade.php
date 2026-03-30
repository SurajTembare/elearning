@extends('admin.master')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="d-flex justify-content-between mb-3">
    <h3>Add Lecture</h3>

    <a href="{{ route('admin.lecture.list',$course_id) }}" class="btn btn-primary">
        View Lectures
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.lecture.store') }}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="course_id" value="{{ $course_id }}">

<input type="text" name="title" class="form-control mb-3" placeholder="Lecture Title" required>

<label>Upload PDF Notes</label>
<input type="file" name="file" class="form-control mb-3" accept=".pdf">

<label>Thumbnail</label>
<input type="file" name="thumbnail" class="form-control mb-3">

<button class="btn btn-success">Save Lecture</button>

</form>

@endsection