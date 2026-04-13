@extends('admin.master')

@section('content')

<h3>Add Instructor</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.instructor.store') }}" enctype="multipart/form-data">
@csrf

<input type="text" name="name" class="form-control mb-3" placeholder="Name" required>

<input type="text" name="designation" class="form-control mb-3" placeholder="Designation" required>

<textarea name="bio" class="form-control mb-3" placeholder="Bio"></textarea>

<input type="file" name="image" class="form-control mb-3">

<button class="btn btn-success">Add Instructor</button>

</form>

@endsection