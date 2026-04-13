@extends('admin.master')

@section('content')

<h3>Edit Instructor</h3>

<form method="POST" action="{{ route('admin.instructor.update',$instructor->id) }}" enctype="multipart/form-data">
@csrf

<input type="text" name="name" value="{{ $instructor->name }}" class="form-control mb-3">

<input type="text" name="designation" value="{{ $instructor->designation }}" class="form-control mb-3">

<textarea name="bio" class="form-control mb-3">{{ $instructor->bio }}</textarea>

@if($instructor->image)
    <img src="{{ asset('storage/'.$instructor->image) }}" width="80" class="mb-2">
@endif

<input type="file" name="image" class="form-control mb-3">

<button class="btn btn-success">Update</button>

</form>

@endsection