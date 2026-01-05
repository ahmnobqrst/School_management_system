@extends('Dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('sidebar_trans.Exam_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('sidebar_trans.Exam_list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('sidebar_trans.Exam_list')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('parent.dashboard')}}" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('sidebar_trans.Exam_list')}}</li>
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
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50"
                                    style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('Students_trans.quiz_name')}}</th>
                                            <th>{{trans('section_trans.Teacher_name')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($quizzes as $quizze)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{$quizze->name}}</td>
                                            <td>{{$quizze->teacher->name}}</td>
                                            <td>{{$quizze->grade->name}}</td>
                                            <td>{{$quizze->classroom->name}}</td>
                                            <td>{{$quizze->section->section_name}}</td>
                                            
                                        </tr>

                                        @endforeach
                                </table>
                                <div class="mt-3 d-flex justify-content-center">
                                    {{ $quizzes->links() }}
                                </div>
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