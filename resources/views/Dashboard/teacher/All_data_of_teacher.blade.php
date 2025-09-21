@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{ trans('Students_trans.teacher_details') }}
@stop
@endsection

@section('page-header')
@section('PageTitle')
{{ trans('Students_trans.teacher_details') }}
@stop
@endsection

@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{ trans('Students_trans.teacher_details') }}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('teachers.index')}}"
                        class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('Students_trans.teacher_details') }}</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 offset-md-2 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">{{ trans('Students_trans.teacher_details') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>{{ trans('Students_trans.Teacher_name') }}</th>
                            <td>{{ $teacher->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('Students_trans.email') }}</th>
                            <td>{{ $teacher->email }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('Students_trans.age') }}</th>
                            <td>{{ $teacher->age }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('teacher_trans.phone') }}</th>
                            <td>{{ $teacher->phone ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('Students_trans.address') }}</th>
                            <td>{{ $teacher->address }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('Students_trans.date_of_job') }}</th>
                            <td>{{ $teacher->date_of_job }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('Students_trans.gender') }}</th>
                            <td>{{ $teacher->Genders->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('Students_trans.Specializations') }}</th>
                            <td>{{ $teacher->Specializations->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('Students_trans.Nationality') }}</th>
                            <td>{{ $teacher->Nationality->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('Students_trans.BloodType') }}</th>
                            <td>{{ $teacher->BloodType->name ?? ''}}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('Students_trans.Sections') }}</th>
                            <td>
                                @foreach($teacher->Sections as $section)
                                <span class="badge bg-info text-white">{{ $section->section_name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@toastr_js
@toastr_render
@endsection