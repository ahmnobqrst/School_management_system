@extends('Dashboard.layouts.master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @toastr_css
@section('title')
    {{trans('teacher_trans.teacher_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{trans('teacher_trans.teacher_list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('teacher_trans.teacher_list')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{url('/teacher/dashboard')}}" class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('teacher_trans.teacher_list')}}</li>
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
                                            <th>{{trans('teacher_trans.teacher_name')}}</th>
                                            <th>{{trans('Students_trans.email')}}</th>
                                            <th>{{trans('teacher_trans.sepcailists')}}</th>
                                            <th>{{trans('teacher_trans.phone')}}</th>
                                            <th>{{trans('Students_trans.gender')}}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($teachers as $teacher)
                                            <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$teacher->name}}</td>
                                            <td>{{$teacher->email}}</td>
                                            <td scope="col">{{$teacher->Specializations->name}}</td>
                                            <td>{{$teacher->phone}}</td>
                                            <td>{{$teacher->Genders->name}}</td>

                                            </tr>   

                                        @endforeach
                                    </table>
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