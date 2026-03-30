@extends('admin.master')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Courses</h3>

    <a href="{{ route('admin.course.create') }}" class="btn btn-success">
        Add Course
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <!-- <th>Thumbnail</th> -->
            <th>Title</th>
            <th>Price</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($courses as $key => $course)
        <tr>
            <td>{{ $key + 1 }}</td>

            <!-- <td>
                @if($course->thumbnail)
                    <img src="{{ asset('storage/'.$course->thumbnail) }}" width="60">
                @else
                    No Image
                @endif
            </td> -->

            <td>{{ $course->title }}</td>

            <td>₹{{ $course->price }}</td>

            <td>
                @if($course->is_paid)
                    Paid
                @else
                    Free
                @endif
            </td>

            <td>
                <a href="{{ route('admin.lecture.create', $course->id) }}" class="btn btn-primary btn-sm">
                    Add Lecture
                </a>

                <a href="{{ route('admin.lecture.list', $course->id) }}" class="btn btn-info btn-sm">
                    View Lectures
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

@endsection