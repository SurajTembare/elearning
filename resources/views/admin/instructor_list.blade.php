@extends('admin.master')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Instructor List</h3>
    <a href="{{ route('admin.instructor.create') }}" class="btn btn-primary">Add</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Image</th>
    <th>Name</th>
    <th>Designation</th>
    <th>Action</th>
</tr>

@foreach($instructors as $ins)
<tr>
    <td>{{ $ins->id }}</td>

    <td>
        @if($ins->image)
            <img src="{{ asset('storage/'.$ins->image) }}" width="50">
        @endif
    </td>

    <td>{{ $ins->name }}</td>
    <td>{{ $ins->designation }}</td>

    <td>
        <a href="{{ route('admin.instructor.edit',$ins->id) }}" class="btn btn-warning btn-sm">Edit</a>

        <a href="{{ route('admin.instructor.delete',$ins->id) }}" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Delete?')">
           Delete
        </a>
    </td>
</tr>
@endforeach

</table>

@endsection