@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{ trans('Students_trans.Student_details') }}
@stop
@endsection

@section('page-header')
@section('PageTitle')
{{ trans('Students_trans.Student_details') }}
@stop
@endsection

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{ trans('Students_trans.Student_details') }}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{url('/teacher/dashboard')}}"
                        class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('Students_trans.Student_details') }}</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-10 offset-md-1 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="student-details-tab" data-toggle="tab" href="#student-details"
                            role="tab" aria-controls="student-details" aria-selected="true">
                            {{ trans('Students_trans.Student_details') }}
                        </a>
                    </li>
                    
                </ul>

                <div class="tab-content mt-4">
                    {{-- Tab 1: Student Details --}}
                    <div class="tab-pane fade show active" id="student-details" role="tabpanel"
                        aria-labelledby="student-details-tab">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ trans('Students_trans.name') }}</th>
                                    <td>{{ $Student->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.email') }}</th>
                                    <td>{{ $Student->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.gender') }}</th>
                                    <td>{{ $Student->Gender->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.BloodType') }}</th>
                                    <td>{{ $Student->BloodType->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.Nationality') }}</th>
                                    <td>{{ $Student->Nationality->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.Grade') }}</th>
                                    <td>{{ $Student->Grade->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.classrooms') }}</th>
                                    <td>{{ $Student->Classroom->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.section') }}</th>
                                    <td>{{ $Student->Section->section_name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.Date_of_Birth') }}</th>
                                    <td>{{ $Student->birth_of_date }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.parent') }}</th>
                                    <td>{{ $Student->Parents->name_of_father }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('Students_trans.academic_year') }}</th>
                                    <td>{{ $Student->academic_year }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@toastr_js
@toastr_render
@endsection