@extends('admin.master')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Lectures - {{ $course->title }}</h3>

    <a href="{{ route('admin.lecture.create', $course->id) }}" class="btn btn-success">
        Add Lecture
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>PDF</th>
            <th>Thumbnail</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($lectures as $key => $lecture)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $lecture->title }}</td>
            <td>
                @if($lecture->file_path)
                    <a href="{{ asset('storage/'.$lecture->file_path) }}" target="_blank" class="btn btn-info btn-sm">
                        View PDF
                    </a>
                @else
                    No File
                @endif
            </td>
            <td>
                @if($lecture->thumbnail)
                    <img src="{{ asset('storage/'.$lecture->thumbnail) }}" alt="Thumbnail" class="img-thumbnail" style="max-width: 100px;">
                @else
                    No Thumbnail
                @endif
            </td>
            <td>
                <a href="{{ route('admin.lecture.edit', $lecture->id) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>
                <a href="{{ route('admin.lecture.delete', $lecture->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                    Delete
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

@endsection