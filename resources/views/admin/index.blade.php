@extends('admin.master')
@section('content')

<div class="page-content">

    <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
            <div class="row">

                <!-- USERS -->
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="statistic-block block text-center p-3 shadow-sm" style="border-radius:10px;">
                        
                        <div class="icon mb-2">
                            <i class="icon-user-1" style="font-size:28px;"></i>
                        </div>

                        <strong>Total Users</strong>

                        <h3 class="mt-2">{{ $totalUsers }}</h3>

                    </div>
                </div>

                <!-- COURSES -->
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="statistic-block block text-center p-3 shadow-sm" style="border-radius:10px;">
                        
                        <div class="icon mb-2">
                            <i class="icon-contract" style="font-size:28px;"></i>
                        </div>

                        <strong>Total Courses</strong>

                        <h3 class="mt-2">{{ $totalCourses }}</h3>

                    </div>
                </div>

                <!-- ENROLLMENTS -->
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="statistic-block block text-center p-3 shadow-sm" style="border-radius:10px;">
                        
                        <div class="icon mb-2">
                            <i class="icon-paper-and-pencil" style="font-size:28px;"></i>
                        </div>

                        <strong>Total Enrollments</strong>

                        <h3 class="mt-2">{{ $totalEnrollments }}</h3>

                    </div>
                </div>

                <!-- REPLACE DELIVERED -->
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="statistic-block block text-center p-3 shadow-sm" style="border-radius:10px;">
                        
                        <div class="icon mb-2">
                            <i class="icon-writing-whiteboard" style="font-size:28px;"></i>
                        </div>

                        <strong>Total Revenue</strong>

                        <h3 class="mt-2">₹{{ $totalRevenue ?? 0 }}</h3>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

@endsection