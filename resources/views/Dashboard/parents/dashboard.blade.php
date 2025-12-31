<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('Dashboard.layouts.head')
    @livewireStyles
    <style>
        body {
            background: #f7f9fc;
            font-family: 'Cairo', sans-serif;
        }

        .page-title h4 {
            font-weight: 700;
            color: #34495e;
        }

        .card-statistics {
            border: none;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card-statistics:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card-statistics .highlight-icon {
            font-size: 42px;
            padding: 22px;
            border-radius: 50%;
            color: white;
        }

        .text-success .highlight-icon {
            background: linear-gradient(135deg, #28a745, #20c997);
        }

        .text-primary .highlight-icon {
            background: linear-gradient(135deg, #007bff, #17a2b8);
        }

        .text-info .highlight-icon {
            background: linear-gradient(135deg, #36b9cc, #11cdef);
        }

        .text-warning .highlight-icon {
            background: linear-gradient(135deg, #f6c23e, #f4b619);
        }

        .text-danger .highlight-icon {
            background: linear-gradient(135deg, #e74a3b, #be2617);
        }

        .card-body p.card-text {
            font-size: 17px;
            font-weight: 600;
            color: #333;
        }

        .card-body a {
            text-decoration: none;
            font-weight: 600;
            color: #e74a3b;
            transition: color 0.3s;
        }

        .card-body a:hover {
            color: #c0392b;
        }

        .border-top {
            border-top: 1px solid #eaeaea !important;
        }

        .card-body h4 {
            font-size: 22px;
            font-weight: bold;
            color: #2d3436;
        }

        /* spacing adjustments */
        .row > div {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- preloader -->
        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        @include('Dashboard.layouts.main-header')
        @include('Dashboard.layouts.main-sidebar')

        <!-- main content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0">{{ __('Students_trans.Welcome') }} : {{ auth()->user()->name_of_father }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right"></ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- الطلاب -->
                <div class="col-md-4 col-sm-12">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix mb-3">
                                <div class="float-left text-success">
                                    <i class="fas fa-user-graduate highlight-icon"></i>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text">{{ __('Students_trans.Grade') }}</p>
                                    <h4></h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-eye mr-1"></i>
                                
                                <a href="#" target="_blank">{{ __('Students_trans.Show_data') }}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- الفصول -->
                <div class="col-md-4 col-sm-12">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix mb-3">
                                <div class="float-left text-primary">
                                    <i class="fas fa-chalkboard highlight-icon"></i>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text">{{ __('Students_trans.classrooms') }}</p>
                                    <h4></h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-eye mr-1"></i>
                                <a href="#" target="_blank">{{ __('Students_trans.Show_data') }}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- السكاشن -->
                <div class="col-md-4 col-sm-12">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix mb-3">
                                <div class="float-left text-info">
                                    <i class="fas fa-stream highlight-icon"></i>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text">{{ __('Students_trans.section') }}</p>
                                    <h4></h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-eye mr-1"></i>
                                <a href="#" target="_blank">{{ __('Students_trans.Show_data') }}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- المواد -->
                <div class="col-md-4 col-sm-12">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix mb-3">
                                <div class="float-left text-warning">
                                    <i class="fas fa-book-open highlight-icon"></i>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text">{{ __('Students_trans.subjects') }}</p>
                                    <h4></h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-eye mr-1"></i>
                                <a href="#" target="_blank">{{ __('Students_trans.Show_data') }}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- المعلمين -->
                <div class="col-md-4 col-sm-12">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix mb-3">
                                <div class="float-left text-danger">
                                    <i class="fas fa-chalkboard-teacher highlight-icon"></i>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text">{{ __('Students_trans.teachers') }}</p>
                                    <h4></h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-eye mr-1"></i>
                                <a href="#" target="_blank">{{ __('Students_trans.Show_data') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            

           
            @include('Dashboard.layouts.footer')
        </div>
    </div>

     @include('Dashboard.layouts.footer-scripts')

     @livewireScripts
     @stack('scripts')
</body>
</html>
