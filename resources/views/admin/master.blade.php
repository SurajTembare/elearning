<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Bootstrap Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('back_end/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('back_end/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="{{ asset('back_end/assets/css/font.css') }}">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('back_end/assets/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('back_end/assets/css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('back_end/assets/img/favicon.ico') }}">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="search-panel">
                <div class="search-inner d-flex align-items-center justify-content-center">
                    <div class="close-btn">Close <i class="fa fa-close"></i></div>
                    <form id="searchForm" action="#">
                        <div class="form-group">
                            <input type="search" name="search" placeholder="What are you searching for...">
                            <button type="submit" class="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <!-- Navbar Header--><a href="/" class="navbar-brand">
                        <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Dark</strong><strong>Admin</strong></div>
                        <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div>
                    </a>
                    <!-- Sidebar Toggle Btn-->
                    <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
                </div>

                <!-- Log out               -->
                <div class="list-inline-item logout">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <input type="submit" value="Logout" style="background:none;border:none;color:white;padding:0;font:inherit;cursor:pointer;outline:inherit;">

                    </form>
                </div>
            </div>
            <!-- </div> -->
        </nav>
    </header>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="{{ asset('back_end/assets/img/avatar-6.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h5">Mark Stephen</h1>
                    <p>Web Designer</p>
                </div>
            </div>
            <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
            <ul class="list-unstyled">
                <li class="active"><a href="{{url('admin/dashboard')}}"> <i class="icon-home"></i>Home </a></li>
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Courses </a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">

                        <a href="{{ route('admin.course.create') }}"> <i class="icon-grid"></i>
                            Add Course

                        </a>


                        <a href="{{ route('admin.course.list') }}"> <i class="icon-grid"></i>
                            View Courses

                        </a>




                    </ul>
                </li>
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Our Instructors </a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">

                        <a href="{{ route('admin.instructor.create') }}"> <i class="icon-grid"></i>
                            Add Instructor

                        </a>


                        <a href="{{ route('admin.instructor.list') }}"> <i class="icon-grid"></i>
                            View Instructors

                        </a>




                    </ul>
                </li>

                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Blogs </a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">

                        <a href="{{ route('admin.blog.create') }}"> <i class="icon-grid"></i>
                            Add Blog

                        </a>


                        <a href="{{ route('admin.blog.list') }}"> <i class="icon-grid"></i>
                            View Blogs

                        </a>




                    </ul>
                </li>

                <!-- <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Lectures </a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">

                        <li>
                            <a href="/lecture/create/{course_id}">
                                Add Lectures
                            </a>
                        </li>

                        <li>
                            <a href="" class="btn btn-info btn-sm">
                                View Lectures
                            </a>
                        </li>



                    </ul>
                </li> -->

                <!-- <li>
                    <a href=""> <i class="icon-grid"></i>
                        Orders

                    </a>

                </li> -->
                <li>
                    <a href="/admin/contactlist"> <i class="icon-grid"></i>
                        Contact

                    </a>

                </li>
                <li>
                    <a href="/admin/comments"> <i class="icon-grid"></i>
                        Comments

                    </a>

                </li>
            </ul>
        </nav>
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Dashboard</h2>
                </div>
            </div>

            @yield('content')

            <footer class="footer">
                <div class="footer__block block no-margin-bottom">
                    <div class="container-fluid text-center">
                        <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                        <p class="no-margin-bottom">2018 &copy; Your company. Download From <a target="_blank" href="https://templateshub.net">Templates Hub</a>.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('back_end/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('back_end/assets/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('back_end/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('back_end/assets/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('back_end/assets/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('back_end/assets/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('back_end/assets/js/charts-home.js')}}"></script>
    <script src="{{asset('back_end/assets/js/front.js')}}"></script>
</body>

</html>