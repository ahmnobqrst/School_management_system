@extends('Dashboard.layouts.master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@toastr_css
@section('title')
{{trans('Students_trans.subject_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.subject_list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('Students_trans.subject_list')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{url('/teacher/dashboard')}}" class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.subject_list')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                @if($studentSubjects)
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50"
                                    style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Students_trans.subject_name')}}</th>
                                            <th>{{trans('section_trans.Grade_id')}}</th>
                                            <th>{{trans('section_trans.Class_id')}}</th>
                                            <th>{{trans('section_trans.Teacher_name')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($studentSubjects as $subject)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$subject->name}}</td>
                                            <td>{{$subject->grades->name}}</td>
                                            <td>{{$subject->classrooms->name}}</td>
                                            <td>{{$subject->teachers->name}}</td>

                                        </tr>

                                        @endforeach
                                </table>
                                @else
                                <div class="alert alert-warning text-center mt-3">
                                    {{ __('Students_trans.no_data') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->


@endsection
@section('js')
@toastr_js
@toastr_render
@endsection