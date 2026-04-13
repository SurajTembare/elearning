@extends('admin.master')

@section('content')

<h3>Add Blog</h3>

<form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
@csrf

<input type="text" name="title" class="form-control mb-3" placeholder="Title">

<textarea name="content" class="form-control mb-3" rows="5" placeholder="Content"></textarea>

<input type="file" name="image" class="form-control mb-3">

<button class="btn btn-success">Add Blog</button>

</form>

@endsection