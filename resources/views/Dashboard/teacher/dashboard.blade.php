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
</head>

<body>
    <div class="wrapper">

        <!--================================= preloader -->
        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>
        <!--================================= preloader -->

        @include('Dashboard.layouts.main-header')
        @include('Dashboard.layouts.main-sidebar')

        <!--================================= Main content -->
        <div class="content-wrapper">

            <!-- Page title -->
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">
                            {{ __('Students_trans.Welcome') }}:{{auth()->user()->name}}
                        </h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Widgets -->
            <div class="row">
                <!-- الطلاب -->
                <div class="col-md-4 col-sm-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{__('Students_trans.student_count')}}</p>
                                    <h4>{{$student_count}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1"></i>
                                <a href="{{route('getstds')}}" target="_blank"
                                    class="text-danger">{{__('Students_trans.Show_data')}}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- الفصول -->
                <div class="col-md-4 col-sm-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fas fa-chalkboard highlight-icon"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{ __('Students_trans.Classroom_count') }}</p>
                                    <h4>{{ $classroom_count }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1"></i>
                                <a href="{{route('getclasses')}}" target="_blank"
                                    class="text-danger">{{ __('Students_trans.Show_data') }}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- السكاشن -->
                <div class="col-md-4 col-sm-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-info">
                                        <i class="fas fa-stream highlight-icon"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{__('Students_trans.Sections_count')}}</p>
                                    <h4>{{ $section_count }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1"></i>
                                <a href="{{ route('getsectionss') }}" target="_blank"
                                    class="text-danger">{{ __('Students_trans.Show_data') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Last operations -->
            <div class="row">
                <div class="col-xl-12 mb-30" style="height: 400px;">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 style="font-family: 'Cairo', sans-serif" class="card-title">
                                            {{ trans('Students_trans.Last_operation') }}
                                        </h5>
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
                                    {{-- Students Table --}}
                                    <div class="tab-pane fade active show" id="students" role="tabpanel"
                                        aria-labelledby="students-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
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
                                                        <td class="alert-danger" colspan="8">
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
        <!-- End Main content -->

        <!-- Footer -->
        @include('Dashboard.layouts.footer')
    </div>
    <!-- End wrapper -->

    @include('Dashboard.layouts.footer-scripts')
    @stack('scripts')

</body>

</html>
