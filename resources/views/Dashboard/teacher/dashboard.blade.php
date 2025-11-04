<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('Dashboard.layouts.head')

    <style>
        body {
            background: #f7f9fc;
            font-family: 'Cairo', sans-serif;
        }

        .page-title h4 {
            font-weight: 700;
            color: #34495e;
        }

        .card.card-statistics {
            border: none;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card.card-statistics:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .highlight-icon {
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

        /* جدول العمليات الأخيرة */
        .card-title {
            font-size: 22px;
            font-weight: bold;
            color: #2d3436;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #555;
            font-weight: 600;
        }

        .nav-tabs .nav-link.active {
            color: #e74a3b;
            border-bottom: 3px solid #e74a3b;
            background-color: transparent;
        }

        .table thead tr {
            background: linear-gradient(135deg, #f8d7da, #f1a7a7);
            color: #a71d2a;
        }

        .table tbody tr:hover {
            background-color: #fdf3f3;
        }

        .table td,
        .table th {
            vertical-align: middle;
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

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page title -->
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">
                            {{ __('Students_trans.Welcome') }}: {{ auth()->user()->name }}
                        </h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right"></ol>
                    </div>
                </div>
            </div>

            <!-- Widgets -->
            <div class="row">
                <!-- الطلاب -->
                <div class="col-md-4 col-sm-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix mb-3">
                                <div class="float-left text-success">
                                    <i class="fas fa-user-graduate highlight-icon"></i>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text">{{ __('Students_trans.student_count') }}</p>
                                    <h4>{{ $student_count }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-eye mr-1"></i>
                                <a href="{{ route('getstds') }}" target="_blank">{{ __('Students_trans.Show_data') }}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- الفصول -->
                <div class="col-md-4 col-sm-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix mb-3">
                                <div class="float-left text-primary">
                                    <i class="fas fa-chalkboard highlight-icon"></i>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text">{{ __('Students_trans.Classroom_count') }}</p>
                                    <h4>{{ $classroom_count }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-eye mr-1"></i>
                                <a href="{{ route('getclasses') }}" target="_blank">{{ __('Students_trans.Show_data') }}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- السكاشن -->
                <div class="col-md-4 col-sm-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix mb-3">
                                <div class="float-left text-info">
                                    <i class="fas fa-stream highlight-icon"></i>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text">{{ __('Students_trans.Sections_count') }}</p>
                                    <h4>{{ $section_count }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-eye mr-1"></i>
                                <a href="{{ route('getsectionss') }}" target="_blank">{{ __('Students_trans.Show_data') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- العمليات الأخيرة -->
            <div class="row">
                <div class="col-xl-12 mb-30" style="height: 400px;">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 class="card-title">{{ trans('Students_trans.Last_operation') }}</h5>
                                    </div>
                                    <div class="d-block d-md-flex nav-tabs-custom">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active show" id="students-tab" data-toggle="tab"
                                                    href="#students" role="tab" aria-controls="students"
                                                    aria-selected="true">
                                                    {{ trans('sidebar_trans.students') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Tab content -->
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="students" role="tabpanel"
                                        aria-labelledby="students-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table table-hover table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ trans('Students_trans.student_name') }}</th>
                                                        <th>{{ trans('Students_trans.email') }}</th>
                                                        <th>{{ trans('Students_trans.gender') }}</th>
                                                        <th>{{ trans('Students_trans.Grade') }}</th>
                                                        <th>{{ trans('Students_trans.classrooms') }}</th>
                                                        <th>{{ trans('Students_trans.section') }}</th>
                                                        <th>{{ __('Students_trans.Date_adding') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse(\App\Models\Student::latest()->take(5)->get() as $student)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $student->name }}</td>
                                                            <td>{{ $student->email }}</td>
                                                            <td>{{ $student->Gender->name }}</td>
                                                            <td>{{ $student->Grade->name }}</td>
                                                            <td>{{ $student->Classroom->name }}</td>
                                                            <td>{{ $student->Section->section_name }}</td>
                                                            <td class="text-success">{{ $student->created_at }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="alert-danger text-center" colspan="8">
                                                                {{ __('Students_trans.no_data') }}
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Tab content -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('Dashboard.layouts.footer')
    </div>

    @include('Dashboard.layouts.footer-scripts')
    @stack('scripts')

</body>

</html>
