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

<table class="table table-bordered table-hover">

    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Offer</th>
            <th>Discount</th>
            <th>Final Price</th>
            <th>Period</th>
            <th>Status</th>
            <th>Type</th>
            <th>Lectures</th>
            <th>ADD</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($courses as $key => $course)

        <tr>
            <td>{{ $key + 1 }}</td>

            <!-- TITLE -->
            <td>{{ $course->title }}</td>

            <!-- DESCRIPTION -->
            <td style="max-width:250px;">
                {{ \Illuminate\Support\Str::limit($course->description, 60) }}
            </td>

            <!-- ORIGINAL PRICE -->
            <td>
                ₹{{ $course->price }}
            </td>

            <!-- OFFER NAME -->
            <td>
                {{ $course->offer_name ?? '—' }}
            </td>

            <!-- DISCOUNT -->
            <td>
                @if($course->discount_percent)
                    <span class="badge bg-success" style="color: white;">
                        {{ $course->discount_percent }}%
                    </span>
                @else
                    —
                @endif
            </td>

            <!-- FINAL PRICE -->
            <td>
                @if($course->is_discount_active)
                    <span style="text-decoration:line-through; color:#999;">
                        ₹{{ $course->price }}
                    </span><br>
                    <strong style="color:green;">
                        ₹{{ $course->final_price }}
                    </strong>
                @else
                    ₹{{ $course->price }}
                @endif
            </td>

            <!-- PERIOD -->
            <td style="font-size:12px;">
                @if($course->discount_start && $course->discount_end)
                    {{ \Carbon\Carbon::parse($course->discount_start)->format('d M') }}
                    -
                    {{ \Carbon\Carbon::parse($course->discount_end)->format('d M Y') }}
                @else
                    —
                @endif
            </td>

            <!-- STATUS -->
            <td>
                @php
                    $today = now()->toDateString();
                @endphp

                @if($course->discount_start && $today < $course->discount_start)
                    <span class="badge bg-warning text-dark">Upcoming</span>

                @elseif($course->is_discount_active)
                    <span class="badge bg-success" style="color: white;">Active</span>

                @elseif($course->discount_end && $today > $course->discount_end)
                    <span class="badge bg-primary" style="color: white;">Expired</span>

                @else
                    <span class="text-muted">—</span>
                @endif
            </td>

            <!-- TYPE -->
            <td>
                @if($course->is_paid)
                    <span class="badge bg-danger" style="color: white;">Paid</span>
                @else
                    <span class="badge bg-success" style="color: white;">Free</span>
                @endif
            </td>

            <!-- LECTURE COUNT -->
            <td>
                {{ $course->lectures->count() }}
            </td>

            <!-- ADD LECTURE -->
            <td>
                <a href="{{ route('admin.lecture.create', $course->id) }}"
                   class="btn btn-primary btn-sm mb-1">
                    Add Lecture
                </a>

                <a href="{{ route('admin.lecture.list', $course->id) }}"
                   class="btn btn-info btn-sm">
                    View
                </a>
            </td>

            <!-- ACTION -->
            <td>
                <div class="d-flex gap-1">

                    <a href="{{ route('admin.course.edit', $course->id) }}"
                       class="btn btn-primary btn-sm">
                        Edit
                    </a>

                    <a href="{{ route('admin.course.delete', $course->id) }}"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure?')">
                        Delete
                    </a>

                </div>
            </td>

        </tr>

        @endforeach
    </tbody>

</table>

@endsection