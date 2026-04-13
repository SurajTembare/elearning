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
    <h3>Edit Lecture</h3>

    <a href="{{ route('admin.lecture.list',$lectures->course_id) }}" class="btn btn-primary">
        View Lectures
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.lecture.update',$lectures->id) }}" enctype="multipart/form-data">
@csrf

<!-- TITLE -->
<input type="text" name="title" class="form-control mb-3"
       value="{{ $lectures->title }}" required>

<!-- CURRENT PDF -->
@if($lectures->file_path)
    <div class="mb-3">
        <label>Current PDF</label><br>
        <a href="{{ asset('storage/'.$lectures->file_path) }}" target="_blank">
            View PDF
        </a>
    </div>
@endif

<label>Change PDF</label>
<input type="file" name="file" class="form-control mb-3" accept=".pdf">

<!-- CURRENT THUMBNAIL -->
@if($lectures->thumbnail)
    <div class="mb-3">
        <label>Current Thumbnail</label><br>
        <img src="{{ asset('storage/'.$lectures->thumbnail) }}" width="120">
    </div>
@endif

<label>Change Thumbnail</label>
<input type="file" name="thumbnail" class="form-control mb-3">

<button class="btn btn-success">Update Lecture</button>

</form>

@endsection