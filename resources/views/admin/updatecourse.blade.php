@extends('admin.master')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Edit Course</h3>

    <a href="{{ route('admin.course.list') }}" class="btn btn-primary">
        View Courses
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif

<form method="POST" action="{{ route('admin.course.update',$course->id) }}" enctype="multipart/form-data">
@csrf

<!-- TITLE -->
<input type="text" name="title" class="form-control mb-3"
       value="{{ $course->title }}" required>

<!-- DESCRIPTION -->
<textarea name="description" class="form-control mb-3" required>{{ $course->description }}</textarea>

<!-- CURRENT IMAGE -->
@if($course->thumbnail)
    <div class="mb-3">
        <label>Current Thumbnail</label><br>
        <img src="{{ asset('storage/'.$course->thumbnail) }}" width="120">
    </div>
@endif

<!-- NEW IMAGE -->
<label>Change Thumbnail</label>
<input type="file" name="thumbnail" class="form-control mb-3">

<!-- PRICE -->
<input type="number" step="0.01" name="price"
       class="form-control mb-3"
       value="{{ $course->price }}" required>

<button class="btn btn-success">Update Course</button>

</form>

@endsection