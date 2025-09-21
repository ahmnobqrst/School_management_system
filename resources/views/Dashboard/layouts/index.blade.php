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
    @livewireStyles
</head>

<body>



    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('Dashboard.layouts.main-header')

        @include('Dashboard.layouts.main-sidebar')

        <!--=================================
  Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">{{__('Students_trans.Dashboard')}}
                        </h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
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
                                    <h4>{{\App\Models\Student::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{route('students.index')}}" target="_blank"><span
                                        class="text-danger">{{__('Students_trans.Show_data')}}</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{__('Students_trans.teacher_count')}}</p>
                                    <h4>{{\App\Models\Teacher::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{route('teachers.index')}}" target="_blank"><span
                                        class="text-danger">{{__('Students_trans.Show_data')}}</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-tie highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{__('Students_trans.parent_count')}}</p>
                                    <h4>{{\App\Models\MyParent::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{route('add_parent')}}" target="_blank"><span
                                        class="text-danger">{{__('Students_trans.Show_data')}}</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-book-open highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">
                                        {{ __('Students_trans.Grade_count') }}
                                    </p>
                                    <h4>{{ \App\Models\Grade::count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i>
                                <a href="{{ route('grades.index') }}" target="_blank">
                                    <span class="text-danger">{{ __('Students_trans.Show_data') }}</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-chalkboard highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{ __('Students_trans.Classroom_count') }}</p>
                                    <h4>{{ \App\Models\Classroom::count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i>
                                <a href="{{ route('classrooms.index') }}" target="_blank">
                                    <span class="text-danger">{{ __('Students_trans.Show_data') }}</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-info">
                                        <i class="fas fa-stream highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{__('Students_trans.Sections_count')}}</p>
                                    <h4>{{ \App\Models\Section::count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i>
                                <a href="{{ route('section.index') }}" target="_blank">
                                    <span class="text-danger">{{ __('Students_trans.Show_data') }}</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Orders Status widgets-->


            <div class="row">

                <div style="height: 400px;" class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 style="font-family: 'Cairo', sans-serif" class="card-title">
                                            {{trans('Students_trans.Last_operation')}}</h5>
                                    </div>
                                    <div class="d-block d-md-flex nav-tabs-custom">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link active show" id="students-tab" data-toggle="tab"
                                                    href="#students" role="tab" aria-controls="students"
                                                    aria-selected="true">{{trans('sidebar_trans.students')}}</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="teachers-tab" data-toggle="tab" href="#teachers"
                                                    role="tab" aria-controls="teachers"
                                                    aria-selected="false">{{trans('sidebar_trans.Teachers')}}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="parents-tab" data-toggle="tab" href="#parents"
                                                    role="tab" aria-controls="parents"
                                                    aria-selected="false">{{trans('sidebar_trans.Parents')}}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="fee_invoices-tab" data-toggle="tab"
                                                    href="#fee_invoices" role="tab" aria-controls="fee_invoices"
                                                    aria-selected="false">{{trans('sidebar_trans.fees_invoices')}}
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">

                                    {{--students Table--}}
                                    <div class="tab-pane fade active show" id="students" role="tabpanel"
                                        aria-labelledby="students-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
                                                        <th>#</th>
                                                        <th>{{trans('Students_trans.student_name')}}</th>
                                                        <th>{{trans('Students_trans.email')}}</th>
                                                        <th>{{trans('Students_trans.gender')}}</th>
                                                        <th>{{trans('Students_trans.Grade')}}</th>
                                                        <th>{{trans('Students_trans.classrooms')}}</th>
                                                        <th>{{trans('Students_trans.section')}}</th>
                                                        <th>{{__('Students_trans.Date_adding')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse(\App\Models\Student::latest()->take(5)->get() as $student)
                                                    <tr>
                                                        <td>{{ $loop->index+1 }}</td>
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
                                                            {{ __('Students_trans.no_data') }}</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{--teachers Table--}}
                                    <div class="tab-pane fade" id="teachers" role="tabpanel"
                                        aria-labelledby="teachers-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
                                                        <th>#</th>
                                                        <th>{{ trans('Students_trans.Teacher_name') }}</th>
                                                        <th>{{ trans('Students_trans.email') }}</th>
                                                        <th>{{ trans('Students_trans.gender') }}</th>
                                                        <th>{{ trans('Students_trans.Specializations') }}</th>
                                                        <th>{{ trans('Students_trans.date_of_job') }}</th>
                                                        <th>{{__('Students_trans.Date_adding')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse(\App\Models\Teacher::latest()->take(5)->get() as $teacher)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $teacher->name }}</td>
                                                        <td>{{ $teacher->email }}</td>
                                                        <td>{{ $teacher->Genders->name }}</td>
                                                        <td>{{ $teacher->Specializations->name }}</td>
                                                        <td>{{ $teacher->date_of_job }}</td>
                                                        <td class="text-success">{{ $teacher->created_at }}</td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td class="alert-danger" colspan="8">
                                                            {{ __('Students_trans.no_data') }}</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{--parents Table--}}
                                    <div class="tab-pane fade" id="parents" role="tabpanel"
                                        aria-labelledby="parents-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
                                                        <th>#</th>
                                                        <th>{{ trans('Parent_trans.Email') }}</th>
                                                        <th>{{ trans('Parent_trans.Name_Father') }}</th>
                                                        <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
                                                        <th>{{ trans('Parent_trans.Phone_Father') }}</th>
                                                        <th>{{ trans('Parent_trans.Job_Father') }}</th>
                                                        <th>{{__('Students_trans.Date_adding')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse(\App\Models\MyParent::latest()->take(5)->get() as $parent)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $parent->email }}</td>
                                                        <td>{{ $parent->name_of_father }}</td>
                                                        <td>{{ $parent->father_ID }}</td>
                                                        <td>{{ $parent->father_phone }}</td>
                                                        <td>{{ $parent->father_job }}</td>
                                                        <td class="text-success">{{ $parent->created_at }}</td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td class="alert-danger" colspan="8">
                                                            {{ __('Students_trans.no_data') }}</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{--Fees_invoices Table--}}
                                    <div class="tab-pane fade" id="fee_invoices" role="tabpanel"
                                        aria-labelledby="fee_invoices-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
                                                        <th>#</th>
                                                        <th>{{trans('Students_trans.invoice_date')}}</th>
                                                        <th>{{trans('Students_trans.student_name')}}</th>
                                                        <th>{{trans('fee_trans.feee_type')}}</th>
                                                        <th>{{trans('fee_trans.amount')}}</th>
                                                        <th>{{trans('Students_trans.Grade')}}</th>
                                                        <th>{{trans('Students_trans.classrooms')}}</th>
                                                        <th>{{trans('fee_trans.fee_desc')}}</th>
                                                        <th>{{__('Students_trans.Date_adding')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse(\App\Models\Fee_inovice::latest()->take(10)->get() as $fee)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $fee->invoice_date }}</td>
                                                        <td>{{ $fee->student->name }}</td>
                                                        <td>{{ $fee->fees->name }}</td>
                                                        <td>{{ number_format($fee->amount, 2) }}</td>
                                                        <td>{{ $fee->grade->name }}</td>
                                                        <td>{{ $fee->classroom->name }}</td>
                                                        <td>{{ $fee->description }}</td>
                                                        <td class="text-success">{{ $fee->created_at }}</td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td class="alert-danger" colspan="9">
                                                            {{ __('Students_trans.no_data') }}</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <livewire:calendar />

            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('Dashboard.layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('Dashboard.layouts.footer-scripts')
    @livewireScripts
    @stack('scripts')

</body>

</html>