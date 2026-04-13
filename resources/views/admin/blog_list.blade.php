@extends('admin.master')

@section('content')

<h3>Blogs</h3>

<a href="{{ route('admin.blog.create') }}" class="btn btn-primary mb-3">Add Blog</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Action</th>
    </tr>

    @foreach($blogs as $blog)
    <tr>
        <td>{{ $blog->id }}</td>
        <td>{{ $blog->title }}</td>
        <td>
            <a href="{{ route('admin.blog.edit',$blog->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <a href="{{ route('admin.blog.delete',$blog->id) }}" class="btn btn-danger btn-sm">Delete</a>
        </td>
    </tr>
    @endforeach

</table>

@endsection