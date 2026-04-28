@extends('admin.master')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Add Course</h3>

    <a href="{{ route('admin.course.list') }}" class="btn btn-primary">
        View Courses
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.course.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" class="form-control mb-3" placeholder="Course Title" required>

    <textarea name="description" class="form-control mb-3" placeholder="Course Description" required></textarea>

    <label>Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control mb-3">

    <input type="number" step="0.01" name="price" class="form-control mb-3" placeholder="Price (0 = Free)" required>

    <hr>

    <h5>🎯 Offer Details</h5>

    <label>Offer Name (Optional)</label>
    <input type="text" name="offer_name" class="form-control mb-2"
        placeholder="Example: Diwali Sale">

    <label>Discount (%)</label>
    <input type="number" name="discount_percent"
        class="form-control mb-2"
        placeholder="Enter % (0-100)">

    <label>Offer Start Date</label>
    <input type="date" name="discount_start" class="form-control mb-2">

    <label>Offer End Date</label>
    <input type="date" name="discount_end" class="form-control mb-3">

    <button class="btn btn-success">Add Course</button>

</form>

@endsection