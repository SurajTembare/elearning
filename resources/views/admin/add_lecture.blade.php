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

<!-- TYPE -->
<select name="type" class="form-control mb-3" required>
    <option value="">Select Type</option>
    <option value="pdf">PDF Notes</option>
    <option value="video">Video Lecture</option>
</select>

<!-- FILE -->
<label>Upload File</label>
<input type="file" name="file" class="form-control mb-3" required>

<button class="btn btn-success">Save Lecture</button>

</form>

@endsection